<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reduction_client extends Model
{
    /** @use HasFactory<\Database\Factories\ReductionClientFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code_reduction_id',
        'date_attribution',
        'date_expiration',
        'montant_fixe',
        'pourcentage',
    ];

    protected $casts = [
        'date_attribution' => 'date',
        'date_expiration' => 'date',
        'montant_fixe' => 'decimal:2',
        'pourcentage' => 'decimal:2',
    ];

    public function code_reduction()
    {
        return $this->belongsTo(Code_reduction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
