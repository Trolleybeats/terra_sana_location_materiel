<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    /** @use HasFactory<\Database\Factories\CommuneFactory> */
    use HasFactory;

    public function particuliers()
    {
        return $this->hasMany(Particulier::class, 'nom_commune_id' && 'numero_commune_id');
    }
    public function professionnels()
    {
        return $this->hasMany(Professionnel::class, 'nom_commune_id' && 'numero_commune_id');
    }
}
