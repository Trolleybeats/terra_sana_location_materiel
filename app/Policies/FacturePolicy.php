<?php

namespace App\Policies;

use App\Models\Facture;
use App\Models\User;

class FacturePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Déterminer si l'utilisateur peut voir la facture
     */
    public function view(User $user, Facture $facture)
    {
        // Les admins peuvent voir toutes les factures
        if ($user->hasType('admin')) {
            return true;
        }
        
        // Les utilisateurs peuvent voir uniquement leurs propres factures
        return $facture->commande->user_id === $user->id;
    }
}
