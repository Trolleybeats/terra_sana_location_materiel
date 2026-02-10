<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    /** @use HasFactory<\Database\Factories\FonctionFactory> */
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function contact_pros()
    {
        return $this->hasMany(Contact_pro::class, 'fonction_id');
    }
}
