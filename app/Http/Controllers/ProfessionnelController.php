<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Langue;
use App\Models\Pays;
use App\Models\Professionnel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfessionnelController extends Controller
{
    /**
     * Display a listing of the resource.
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
        return Inertia::render('professionnels/Create',[
        
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
            'user_id' => 'required|integer|unique:professionnels,user_id',
            'nom_societe' => 'required|string|max:255',
            'nom_rue_siege' => 'required|string|max:255',
            'numero_rue_siege' => 'required|integer',
            'nom_commune_siege_id' => 'required|integer',
            'numero_commune_siege_id' => 'required|integer',
            'nom_rue_livraison' => 'required|string|max:255',
            'numero_rue_livraison' => 'required|integer',
            'nom_commune_livraison_id' => 'required|integer',
            'numero_commune_livraison_id' => 'required|integer',
            'pays_id' => 'required|integer',
            'heure_ouverture' => 'required|integer',
            'minute_ouverture' => 'required|integer',
            'heure_fermeture' => 'required|integer',
            'minute_fermeture' => 'required|integer',
            'langue_id' => 'required|integer',
        ]);
        Professionnel::create([
            'user_id' => $request->user_id,
            'nom_societe' => $request->nom_societe,
            'nom_rue_siege' => $request->nom_rue_siege,
            'numero_rue_siege' => $request->numero_rue_siege,
            'nom_commune_siege_id' => $request->nom_commune_siege_id,
            'numero_commune_siege_id' => $request->numero_commune_siege_id,
            'nom_rue_livraison' => $request->nom_rue_livraison,
            'numero_rue_livraison' => $request->numero_rue_livraison,
            'nom_commune_livraison_id' => $request->nom_commune_livraison_id,
            'numero_commune_livraison_id' => $request->numero_commune_livraison_id,
            'pays_id' => $request->pays_id,
            'heure_ouverture' => $request->heure_ouverture,
            'minute_ouverture' => $request->minute_ouverture,
            'heure_fermeture' => $request->heure_fermeture,
            'minute_fermeture' => $request->minute_fermeture,
            'langue_id' => $request->langue_id,
        ]);
        return redirect()->route('utilisateurs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $professionnel = Professionnel::where('user_id', $id)
            ->with(['pays', 'langue'])
            ->firstOrFail();
        
        // Charger les communes
        $professionnel->load(['communeSiegeNom', 'communeSiegeNumero', 'communeLivraisonNom', 'communeLivraisonNumero']);
            
        return Inertia::render('professionnels/Show', [
            'professionnel' => $professionnel,
        ]);
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
