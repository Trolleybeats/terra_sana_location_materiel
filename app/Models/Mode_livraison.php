<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode_livraison extends Model
{
    /** @use HasFactory<\Database\Factories\ModeLivraisonFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
