<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Details_commande extends Model
{
    /** @use HasFactory<\Database\Factories\DetailsCommandeFactory> */
    use HasFactory;

    protected $fillable = [
        'commande_id',
        'materiel_id',
        'quantite',
        'prix_unitaire',
        'sous_total',
    ];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }
}
