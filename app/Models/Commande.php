<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    /** @use HasFactory<\Database\Factories\CommandeFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'numero_commande',
        'date_debut',
        'date_fin',
        'date_commande',
        'statut_id',
        'mode_livraison_id',
        'mode_retour_id',
        'nom_rue',
        'numero_rue',
        'nom_commune_id',
        'numero_commune_id',
        'pays_id',
        'montant_total',
        'frais_livraison',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details_commandes()
    {
        return $this->hasMany(Details_commande::class);
    }
}
