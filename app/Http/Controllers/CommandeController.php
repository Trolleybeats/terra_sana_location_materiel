<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Details_commande;
use App\Models\Materiel;
use App\Models\Statut;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CommandeController extends Controller
{
    /**
     * Récupérer ou créer la commande brouillon de l'utilisateur
     */
    private function getOrCreateCommandeBrouillon()
    {
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
        return Inertia::render('commandes/Create', [
            'materiels' => Materiel::with('categorie')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_commande' => 'required|unique:commandes,numero_commande',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'date_commande' => 'required|date',
            'statut_id' => 'required|exists:statuts,id',
            'mode_livraison_id' => 'required|exists:modes_livraison,id',
            'mode_retour_id' => 'required|exists:modes_retour,id',
            'nom_rue' => 'required|string|max:255',
            'numero_rue' => 'required|string|max:50',
            'nom_commune_id' => 'required|exists:communes,id',
            'numero_commune' => 'required|string|max:50',
            'pays_id' => 'required|exists:pays,id',
            'montant_total' => 'required|numeric|min:0',
            'frais_livraison' => 'required|numeric|min:0',
        ]);

        // Logique de création de la commande et de ses détails ici
        

        Commande::create($validated);

        return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès.');
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
