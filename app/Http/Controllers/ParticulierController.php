<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Langue;
use App\Models\Particulier;
use App\Models\Pays;
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
            'pays' => Pays::all(),
            'communes' => Commune::all(),
            'langues' => Langue::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        Particulier::create([
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $particulier = Particulier::where('user_id', $id)
            ->with(['pays', 'langue'])
            ->firstOrFail();
        
        // Charger les communes séparément car il y a deux relations
        $particulier->load(['communeNom', 'communeNumero']);
            
        return Inertia::render('particuliers/Show', [
            'particulier' => $particulier,
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
