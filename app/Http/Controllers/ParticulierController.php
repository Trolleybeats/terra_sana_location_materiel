<?php

namespace App\Http\Controllers;

use App\Models\Particulier;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ParticulierController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return Inertia::render('particuliers/Create', [
            'user_id' => $request->query('user_id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Particulier $particulier, Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|unique:particuliers,user_id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'nom_rue' => 'required|string|max:255',
            'numero_rue' => 'required|integer',
            'nom_commune_id' => 'required|integer',
            'numero_commune_id' => 'required|integer',
            'pays_id' => 'required|integer',
            'langue_id' => 'required|integer',
        ]);
        $particulier->particulier()->create([
            'user_id' => $request->user_id,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'nom_rue' => $request->nom_rue,
            'numero_rue' => $request->numero_rue,
            'nom_commune_id' => $request->nom_commune_id,
            'numero_commune_id' => $request->numero_commune_id,
            'pays_id' => $request->pays_id,
            'langue_id' => $request->langue_id,
        ]);
        return redirect()->route('utilisateurs.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
