<?php

namespace App\Policies;

use App\Models\Commande;
use App\Models\User;

class CommandePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view any commandes (index).
     * Tous les utilisateurs authentifiés peuvent accéder à leur panier.
     */
    public function viewAny(User $user)
    {
        return true;
    }
}
