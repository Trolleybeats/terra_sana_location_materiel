<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Commune;
use App\Models\Details_commande;
use App\Models\Frais_livraison;
use App\Models\Materiel;
use App\Models\Mode_livraison;
use App\Models\Mode_retour;
use App\Models\Pays;
use App\Models\Statut;
use App\Models\Code_reduction;
use App\Models\Type_reduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CommandeController extends Controller
{
    /**
     * Récupérer ou créer la commande brouillon de l'utilisateur
     */
    private function getOrCreateCommandeBrouillon()
    {
        Gate::authorize('viewAny', Commande::class);
        $user = auth()->user();
        
        // Récupérer le statut "brouillon"
        $statutBrouillon = Statut::where('statut', 'brouillon')->first();
        
        if (!$statutBrouillon) {
            throw new \Exception('Le statut "brouillon" n\'existe pas. Veuillez exécuter les seeders.');
        }
        
        // Chercher une commande brouillon existante
        $commande = Commande::where('user_id', $user->id)
            ->where('statut_id', $statutBrouillon->id)
            ->first();
        
        // Si pas de commande brouillon, en créer une
        if (!$commande) {
            $commande = Commande::create([
                'user_id' => $user->id,
                'numero_commande' => 'DRAFT-' . Str::upper(Str::random(10)),
                'date_debut' => null,
                'date_fin' => null,
                'date_commande' => now(),
                'statut_id' => $statutBrouillon->id,
                'mode_livraison_id' => null,
                'mode_retour_id' => null,
                'nom_rue' => null,
                'numero_rue' => null,
                'nom_commune_id' => null,
                'numero_commune_id' => null,
                'pays_id' => null,
                'montant_total' => 0,
                'frais_livraison' => 0,
            ]);
        }
        
        return $commande;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Commande::class);
        $user = auth()->user();
        $statutBrouillon = Statut::where('statut', 'brouillon')->first();
        
        // Récupérer la commande brouillon avec ses détails
        $commande = Commande::where('user_id', $user->id)
            ->where('statut_id', $statutBrouillon->id)
            ->with(['details_commandes.materiel.categorie'])
            ->first();
        
        $panierDetails = [];
        $montantTotal = 0;
        
        if ($commande) {
            foreach ($commande->details_commandes as $detail) {
                $panierDetails[] = [
                    'id' => $detail->id,
                    'materiel' => $detail->materiel,
                    'quantite' => $detail->quantite,
                    'sous_total' => $detail->sous_total,
                ];
                $montantTotal += $detail->sous_total;
            }
        }
        
        return Inertia::render('commandes/Index', [
            'panier' => $panierDetails,
            'montantTotal' => $montantTotal,
        ]);
    }

    /**
     * Ajouter un matériel au panier
     */
    public function ajouterAuPanier(Request $request)
    {
        $request->validate([
            'materiel_id' => 'required|exists:materiels,id',
            'quantite' => 'integer|min:1',
        ]);

        $materielId = $request->materiel_id;
        $quantite = $request->quantite ?? 1;

        // Vérifier le stock disponible
        $materiel = Materiel::find($materielId);
        if ($materiel->stock_disponible < $quantite) {
            return back()->with('error', 'Stock insuffisant pour ce matériel.');
        }

        // Récupérer ou créer la commande brouillon
        $commande = $this->getOrCreateCommandeBrouillon();

        // Vérifier si le matériel existe déjà dans les détails de la commande
        $detailExistant = Details_commande::where('commande_id', $commande->id)
            ->where('materiel_id', $materielId)
            ->first();

        if ($detailExistant) {
            // Augmenter la quantité
            $nouvelleQuantite = $detailExistant->quantite + $quantite;
            
            // Vérifier à nouveau le stock
            if ($materiel->stock_disponible < $nouvelleQuantite) {
                return back()->with('error', 'Stock insuffisant pour ajouter cette quantité.');
            }
            
            $detailExistant->quantite = $nouvelleQuantite;
            $detailExistant->sous_total = $materiel->prix_journalier * $nouvelleQuantite;
            $detailExistant->save();
        } else {
            // Créer un nouveau détail de commande
            Details_commande::create([
                'commande_id' => $commande->id,
                'materiel_id' => $materielId,
                'quantite' => $quantite,
                'prix_unitaire' => $materiel->prix_journalier,
                'sous_total' => $materiel->prix_journalier * $quantite,
            ]);
        }

        // Mettre à jour le montant total de la commande
        $this->updateMontantTotal($commande);

        return back()->with('success', 'Matériel ajouté à la commande avec succès.');
    }

    /**
     * Retirer un matériel du panier
     */
    public function retirerDuPanier($detailId)
    {
        $user = auth()->user();
        $statutBrouillon = Statut::where('statut', 'brouillon')->first();
        
        // Vérifier que le détail appartient bien à la commande brouillon de l'utilisateur
        $detail = Details_commande::whereHas('commande', function ($query) use ($user, $statutBrouillon) {
            $query->where('user_id', $user->id)
                  ->where('statut_id', $statutBrouillon->id);
        })->find($detailId);
        
        if (!$detail) {
            return back()->with('error', 'Élément non trouvé dans votre commande.');
        }
        
        $commande = $detail->commande;
        $detail->delete();
        
        // Mettre à jour le montant total
        $this->updateMontantTotal($commande);
        
        return back()->with('success', 'Matériel retiré de la commande.');
    }

    /**
     * Mettre à jour la quantité d'un matériel dans le panier
     */
    public function mettreAJourQuantite(Request $request, $detailId)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        $user = auth()->user();
        $statutBrouillon = Statut::where('statut', 'brouillon')->first();
        
        // Vérifier que le détail appartient bien à la commande brouillon de l'utilisateur
        $detail = Details_commande::with('materiel')
            ->whereHas('commande', function ($query) use ($user, $statutBrouillon) {
                $query->where('user_id', $user->id)
                      ->where('statut_id', $statutBrouillon->id);
            })->find($detailId);
        
        if (!$detail) {
            return back()->with('error', 'Élément non trouvé dans votre commande.');
        }
        
        $materiel = $detail->materiel;
        
        if ($materiel->stock_disponible < $request->quantite) {
            return back()->with('error', 'Stock insuffisant pour cette quantité.');
        }
        
        $detail->quantite = $request->quantite;
        $detail->sous_total = $materiel->prix_journalier * $request->quantite;
        $detail->save();
        
        // Mettre à jour le montant total de la commande
        $this->updateMontantTotal($detail->commande);
        
        return back()->with('success', 'Quantité mise à jour avec succès.');
    }

    /**
     * Vider le panier (supprimer la commande brouillon)
     */
    public function viderPanier()
    {
        $user = auth()->user();
        $statutBrouillon = Statut::where('statut', 'brouillon')->first();
        
        $commande = Commande::where('user_id', $user->id)
            ->where('statut_id', $statutBrouillon->id)
            ->first();
        
        if ($commande) {
            // Supprimer tous les détails et la commande
            $commande->details_commandes()->delete();
            $commande->delete();
        }
        
        return back()->with('success', 'Commande vidée avec succès.');
    }

    /**
     * Mettre à jour le montant total de la commande
     */
    private function updateMontantTotal(Commande $commande)
    {
        $montantTotal = $commande->details_commandes()->sum('sous_total');
        $commande->montant_total = $montantTotal;
        $commande->save();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $commande = $this->getOrCreateCommandeBrouillon();
        $commande->load('details_commandes.materiel.categorie');

        $modeLivraison = Mode_livraison::all();
        $modeRetour = Mode_retour::all();
        $communes = Commune::all();
        $pays = Pays::all();
        $fraisLivraison = Frais_livraison::all();
        
        
        return Inertia::render('commandes/Create', [
            'commande' => $commande,
            'detailsCommandes' => $commande->details_commandes,
            'materiels' => Materiel::with('categorie')->get(),
            'modeLivraison' => $modeLivraison,
            'modeRetour' => $modeRetour,
            'communes' => $communes,
            'pays' => $pays,
            'fraisLivraison' => $fraisLivraison,
        ]);
    }

    /**
     * Vérifier et appliquer un code de réduction
     */
    public function verifierCodeReduction(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $code = strtoupper(trim($request->code));
        $codeReduction = Code_reduction::with('typeReduction')
            ->where('code', $code)
            ->first();

        if (!$codeReduction) {
            return response()->json([
                'valid' => false,
                'message' => 'Code de réduction invalide.',
            ]);
        }

        // Vérifier les dates de validité
        $now = now();
        if ($codeReduction->date_debut && $now->lt($codeReduction->date_debut)) {
            return response()->json([
                'valid' => false,
                'message' => 'Ce code n\'est pas encore actif.',
            ]);
        }

        if ($codeReduction->date_fin && $now->gt($codeReduction->date_fin)) {
            return response()->json([
                'valid' => false,
                'message' => 'Ce code a expiré.',
            ]);
        }

        // Vérifier le nombre d'utilisations
        if ($codeReduction->utilisation_max && $codeReduction->utilisation_actuelles >= $codeReduction->utilisation_max) {
            return response()->json([
                'valid' => false,
                'message' => 'Ce code a atteint sa limite d\'utilisation.',
            ]);
        }

        // Déterminer le type de réduction
        $typeReduction = $codeReduction->typeReduction->reduction;
        
        return response()->json([
            'valid' => true,
            'code_reduction_id' => $codeReduction->id,
            'type' => $typeReduction,
            'montant' => $codeReduction->montant,
            'hors_tva' => $codeReduction->hors_tva,
            'message' => 'Code de réduction appliqué avec succès!',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'mode_livraison_id' => 'required|exists:mode_livraisons,id',
            'mode_retour_id' => 'required|exists:mode_retours,id',
            'nom_rue' => 'required|string|max:255',
            'numero_rue' => 'required|integer',
            'nom_commune_id' => 'required|exists:communes,id',
            'numero_commune_id' => 'required|exists:communes,id',
            'pays_id' => 'required|exists:pays,id',
            'frais_livraison' => 'required|numeric|min:0',
            'code_reduction_id' => 'nullable|exists:code_reductions,id',
            'montant_reduction' => 'nullable|numeric|min:0',
            'montant_total' => 'required|numeric|min:0',
        ]);

        $user = auth()->user();
        $statutBrouillon = Statut::where('statut', 'brouillon')->first();
        $statutConfirmee = Statut::where('statut', 'confirmée')->first();

        // Récupérer la commande brouillon existante avec ses détails
        $commande = Commande::where('user_id', $user->id)
            ->where('statut_id', $statutBrouillon->id)
            ->with('details_commandes')
            ->first();

        if (!$commande) {
            return back()->with('error', 'Aucune commande brouillon trouvée.');
        }

        // Vérifier que la commande contient des articles
        if ($commande->details_commandes->isEmpty()) {
            return back()->with('error', 'Veuillez ajouter au moins un article à votre commande.');
        }

        // Générer un numéro de commande unique
        $numeroCommande = 'CMD-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        // Calculer le montant total (détails + frais de livraison - réduction)
        $montantDetailsCommandes = $validated['montant_total'];
        $montantReduction = isset($validated['montant_reduction']) && $validated['montant_reduction'] > 0 
            ? $validated['montant_reduction'] 
            : 0;
        $montantTotal = $montantDetailsCommandes + $validated['frais_livraison'] - $montantReduction;

        // S'assurer que le montant total ne soit pas négatif
        $montantTotal = max(0, $montantTotal);

        // Mettre à jour la commande brouillon avec les informations de livraison
        $commande->update([
            'numero_commande' => $numeroCommande,
            'date_debut' => $validated['date_debut'],
            'date_fin' => $validated['date_fin'],
            'date_commande' => now(),
            'statut_id' => $statutConfirmee->id, // Commande validée directement
            'mode_livraison_id' => $validated['mode_livraison_id'],
            'mode_retour_id' => $validated['mode_retour_id'],
            'nom_rue' => $validated['nom_rue'],
            'numero_rue' => $validated['numero_rue'],
            'nom_commune_id' => $validated['nom_commune_id'],
            'numero_commune_id' => $validated['numero_commune_id'],
            'pays_id' => $validated['pays_id'],
            'montant_total' => $montantTotal,
            'frais_livraison' => $validated['frais_livraison'],
            'code_reduction_id' => $validated['code_reduction_id'] ?? null,
            'montant_reduction' => $montantReduction,
        ]);

        // Incrémenter le compteur d'utilisation du code de réduction
        if (isset($validated['code_reduction_id']) && $validated['code_reduction_id']) {
            $codeReduction = Code_reduction::find($validated['code_reduction_id']);
            if ($codeReduction) {
                $codeReduction->utilisation_actuelles = ($codeReduction->utilisation_actuelles ?? 0) + 1;
                $codeReduction->save();
            }
        }

        // Créer la facture associée à la commande
        (new FactureController())->creerFacture($commande);

        // Créer une nouvelle commande brouillon vide pour les prochains achats
        $this->getOrCreateCommandeBrouillon();

        return redirect()->route('factures.index')->with('success', 'Commande et facture créées avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
