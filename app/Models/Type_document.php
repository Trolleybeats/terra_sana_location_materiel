<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_document extends Model
{
    /** @use HasFactory<\Database\Factories\TypeDocumentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
}
