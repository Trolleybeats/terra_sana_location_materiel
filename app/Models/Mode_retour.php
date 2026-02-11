<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode_retour extends Model
{
    /** @use HasFactory<\Database\Factories\ModeRetourFactory> */
    use HasFactory;

    protected $fillable = [
        'libelle',
        'description',
    ];

    public function commandes()
    {
        return $this->hasMany(Commande::class);
    }
}
