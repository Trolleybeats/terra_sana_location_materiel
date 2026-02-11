<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo_materiel extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoMaterielFactory> */
    use HasFactory;

    protected $fillable = [
        'url',
        'materiel_id',
    ];

    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }
}
