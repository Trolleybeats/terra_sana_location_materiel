<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FonctionController extends Controller
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
    public function create()
    {
        return Inertia::render('fonctions/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fonction' => 'required|string|max:255',
        ]);

        Fonction::create([
            'fonction' => $request->fonction,
        ]);

        return redirect()->route('parametres.index')->with('success', 'Fonction créée avec succès.');
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
