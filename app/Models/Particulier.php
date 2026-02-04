<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Particulier extends Model
{
    /** @use HasFactory<\Database\Factories\ParticulierFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'nom_rue',
        'numero_rue',
        'nom_commune_id',
        'numero_commune_id',
        'pays_id',
        'langue_id',
    ];

    /**
     * Get the user that owns the particulier.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
