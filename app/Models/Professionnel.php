<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professionnel extends Model
{
    /** @use HasFactory<\Database\Factories\ProfessionnelFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nom_societe',
        'nom_rue_siege',
        'numero_rue_siege',
        'nom_commune_siege_id',
        'numero_commune_siege_id',
        'nom_rue_livraison',
        'numero_rue_livraison',
        'nom_commune_livraison_id',
        'numero_commune_livraison_id',
        'pays_id',
        'heure_ouverture',
        'minute_ouverture',
        'heure_fermeture',
        'minute_fermeture',
        'langue_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }

    public function communeSiegeNom()
    {
        return $this->belongsTo(Commune::class, 'nom_commune_siege_id');
    }

    public function communeSiegeNumero()
    {
        return $this->belongsTo(Commune::class, 'numero_commune_siege_id');
    }

    public function communeLivraisonNom()
    {
        return $this->belongsTo(Commune::class, 'nom_commune_livraison_id');
    }

    public function communeLivraisonNumero()
    {
        return $this->belongsTo(Commune::class, 'numero_commune_livraison_id');
    }

    public function langue()
    {
        return $this->belongsTo(Langue::class);
    }

    public function contactPros()
    {
        return $this->hasMany(Contact_pro::class);
    }
}
