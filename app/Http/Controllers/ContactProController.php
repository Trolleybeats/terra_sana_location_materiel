<?php

namespace App\Http\Controllers;

use App\Models\Contact_pro;
use App\Models\Fonction;
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
            'professionnel_id' => 'required|integer|unique:contact_pros,professionnel_id',
            'fonction_id' => 'required|integer',
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

        return redirect()->route('professionnels.show', ['professionnel' => $contactPro->professionnel->user_id])->with('success', 'Contact professionnel créé avec succès.');
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
