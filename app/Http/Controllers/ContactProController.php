<?php

namespace App\Http\Controllers;

use App\Models\Contact_pro;
use App\Models\Fonction;
use App\Models\Professionnel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactProController extends Controller
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
        $professionnelId = $request->query('professionnel_id', '');
        
      
        
        return Inertia::render('contactpro/Create', [
            'fonctions' => Fonction::all(),
            'professionnelId' => $professionnelId,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'professionnel_id' => 'required|integer|exists:professionnels,id',
            'fonction_id' => 'required|integer|exists:fonctions,id',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        $contactPro = Contact_pro::create([
            'professionnel_id' => $request->professionnel_id,
            'fonction_id' => $request->fonction_id,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
        ]);

        $professionnel = Professionnel::findOrFail($contactPro->professionnel_id);
        return redirect()->route('professionnels.show', ['professionnel' => $professionnel->user_id])->with('success', 'Contact professionnel créé avec succès.');
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
        return Inertia::render('contactpro/Edit', [
            'contactPro' => Contact_pro::findOrFail($id),
            'fonctions' => Fonction::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'fonction_id' => 'required|integer',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telephone' => 'required|string|max:20',
        ]);

        $contactPro = Contact_pro::findOrFail($id);
        $contactPro->update([
            'fonction_id' => $request->fonction_id,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
        ]);

        $professionnel = Professionnel::findOrFail($contactPro->professionnel_id);
        return redirect()->route('professionnels.show', ['professionnel' => $professionnel->user_id])->with('success', 'Contact professionnel mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contactPro = Contact_pro::findOrFail($id);
        $professionnelId = $contactPro->professionnel_id;
        $contactPro->delete();

        $professionnel = Professionnel::findOrFail($professionnelId);
        return redirect()->route('professionnels.show', ['professionnel' => $professionnel->user_id])->with('success', 'Contact professionnel supprimé avec succès.');
    }
}
