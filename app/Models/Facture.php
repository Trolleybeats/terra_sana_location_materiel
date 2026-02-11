<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    /** @use HasFactory<\Database\Factories\FactureFactory> */
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        'status',
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
