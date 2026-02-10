<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_pro extends Model
{
    /** @use HasFactory<\Database\Factories\ContactProFactory> */
    use HasFactory;

    protected $fillable = [
        'professionnel_id',
        'nom',
        'prenom',
        'email',
        'telephone',
        'fonction_id',
    ];

    public function professionnel()
    {
        return $this->belongsTo(Professionnel::class, 'professionnel_id');
    }

    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'fonction_id');
    }
}
