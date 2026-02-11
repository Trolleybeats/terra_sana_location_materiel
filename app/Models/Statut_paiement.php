<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statut_paiement extends Model
{
    /** @use HasFactory<\Database\Factories\StatutPaiementFactory> */
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
    ];

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
}
