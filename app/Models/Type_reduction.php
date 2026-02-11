<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_reduction extends Model
{
    /** @use HasFactory<\Database\Factories\TypeReductionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function code_reductions()
    {
        return $this->hasMany(Code_reduction::class);
    }
}
