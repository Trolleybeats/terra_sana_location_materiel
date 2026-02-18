<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    /** @use HasFactory<\Database\Factories\FactureFactory> */
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'numero_facture',
        'type_document_id',
        'date_emission',
        'date_echeance',
        'montant_ht',
        'montant_tva',
        'montant_ttc',
        'statut_paiement_id',
        'url_pdf',
    ];

    protected $casts = [
        'date_emission' => 'date',
        'date_echeance' => 'date',
        'montant_ht' => 'decimal:2',
        'montant_tva' => 'decimal:2',
        'montant_ttc' => 'decimal:2',
    ];

    public function type_document()
    {
        return $this->belongsTo(Type_document::class);
    }
    public function statut_paiement()
    {
        return $this->belongsTo(statut_paiement::class);
    }
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
