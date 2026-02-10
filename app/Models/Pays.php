<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    /** @use HasFactory<\Database\Factories\PaysFactory> */
    use HasFactory;

    protected $fillable = ['nom_pays'];

    public function particuliers()
    {
        return $this->hasMany(Particulier::class);
    }
    public function professionnels()
    {
        return $this->hasMany(Professionnel::class);
    }
}
