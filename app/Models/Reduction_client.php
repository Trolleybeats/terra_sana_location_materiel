<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reduction_client extends Model
{
    /** @use HasFactory<\Database\Factories\ReductionClientFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'pourcentage',
        'date_expiration',
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
