<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    /** @use HasFactory<\Database\Factories\MaterielFactory> */
    use HasFactory;

    protected $fillable = [
        'categorie_id',
        'nom',
        'description',
        'prix_journalier',
        'dimensions',
        'stock_total',
        'stock_disponible',
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie_materiel::class, 'categorie_id');
    }
}
