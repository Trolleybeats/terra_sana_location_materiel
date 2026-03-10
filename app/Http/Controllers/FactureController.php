<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Facture;
use App\Models\Statut_paiement;
use App\Models\Type_document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $factures = Facture::with(['commande.user', 'type_document', 'statut_paiement'])
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('factures/Index', [
            'factures' => $factures,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('factures/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $facture = Facture::with(['commande.user', 'type_document', 'statut_paiement'])
            ->findOrFail($id);

        $commande = $facture->commande->load([
            'user',
            'commune',
            'pays',
            'statut',
            'mode_livraison',
            'mode_retour',
        ]);

        // Charger les détails de commande avec les matériels et leurs catégories
        $detailsCommandes = $commande->details_commandes()->with([
            'materiel.categorie',
            'materiel.photos'
        ])->get();

        return Inertia::render('factures/Show', [
            'facture' => $facture->load(['type_document', 'statut_paiement']),
            'commande' => $commande,
            'detailsCommandes' => $detailsCommandes,
        ]);
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

    /**
     * Créer une facture pour une commande
     */
    public function creerFacture(Commande $commande)
    {
        // Récupérer le type de document "Facture"
        $typeDocument = Type_document::where('document', 'Facture')->first();
        if (!$typeDocument) {
            throw new \Exception('Le type de document "Facture" n\'existe pas. Veuillez exécuter les seeders.');
        }

        // Récupérer le statut de paiement "En attente" ou "Non payée"
        $statutPaiement = Statut_paiement::where('statut', 'En attente')
            ->orWhere('statut', 'Non payée')
            ->first();
        if (!$statutPaiement) {
            throw new \Exception('Aucun statut de paiement disponible. Veuillez exécuter les seeders.');
        }

        // Générer un numéro de facture unique
        $numeroFacture = 'FACT-' . date('Ymd') . '-' . strtoupper(Str::random(6));

        // Calculer les montants (TVA à 21%)
        $tauxTVA = 0.21;
        $montantHT = $commande->montant_total / (1 + $tauxTVA);
        $montantTVA = $commande->montant_total - $montantHT;
        $montantTTC = $commande->montant_total;

        // Créer la facture
        return Facture::create([
            'commande_id' => $commande->id,
            'numero_facture' => $numeroFacture,
            'type_document_id' => $typeDocument->id,
            'date_emission' => now(),
            'date_echeance' => now()->addDays(30), // Échéance à 30 jours
            'montant_ht' => round($montantHT, 2),
            'montant_tva' => round($montantTVA, 2),
            'montant_ttc' => round($montantTTC, 2),
            'statut_paiement_id' => $statutPaiement->id,
            'url_pdf' => null, // À générer ultérieurement
        ]);
    }

    /**
     * Télécharger la facture en PDF
     */
    public function downloadPdf(string $id)
    {
        $facture = Facture::with([
            'commande.user',
            'commande.commune',
            'commande.pays',
            'commande.statut',
            'commande.mode_livraison',
            'commande.mode_retour',
            'type_document',
            'statut_paiement'
        ])->findOrFail($id);

        // Charger les détails de commande avec les matériels et leurs catégories
        $detailsCommandes = $facture->commande->details_commandes()->with([
            'materiel.categorie',
            'materiel.photos'
        ])->get();

        // Générer le PDF
        $pdf = Pdf::loadView('pdf.facture', [
            'facture' => $facture,
            'commande' => $facture->commande,
            'detailsCommandes' => $detailsCommandes,
        ]);

        // Télécharger le PDF
        return $pdf->download('facture-' . $facture->numero_facture . '.pdf');
    }
}
