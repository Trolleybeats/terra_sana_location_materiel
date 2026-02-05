<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UtilisateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return Inertia::render('utilisateurs/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('utilisateurs/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'type_id' => 'required|integer',
        ]);
        $newUser = $user->create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type_id' => $request->type_id,
        ]);
        
        // Si c'est un particulier, rediriger vers le formulaire de création de particulier
        if ($newUser->type_id == 1) {
            return redirect()->route('particuliers.create', ['user_id' => $newUser->id]);
        }
        // Si c'est un professionnel, rediriger vers le formulaire de création de professionnel
        elseif ($newUser->type_id == 2) {
            return redirect()->route('professionnels.create', ['user_id' => $newUser->id]);
        }
        else {
            // Pour l'administrateur ou autres types, rediriger vers la liste des utilisateurs
        return redirect()->route('utilisateurs.index');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
