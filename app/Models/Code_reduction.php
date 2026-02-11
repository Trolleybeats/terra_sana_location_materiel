<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code_reduction extends Model
{
    /** @use HasFactory<\Database\Factories\CodeReductionFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'type_reduction_id',
        'valeur_reduction',
        'date_expiration',
    ];

    public function typeReduction()
    {
        return $this->belongsTo(Type_reduction::class);
    }
    public function reduction_clients()
    {
        return $this->hasMany(Reduction_client::class);
    }
}
