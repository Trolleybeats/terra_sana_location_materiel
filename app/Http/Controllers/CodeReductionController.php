<?php

namespace App\Http\Controllers;

use App\Models\Code_reduction;
use App\Models\Reduction_client;
use App\Models\Type_reduction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Inertia\Inertia;

class CodeReductionController extends Controller
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
        $type_reductions = Type_reduction::all();
        $users = User::all(['id', 'name', 'email']);
        return Inertia::render('code_reductions/Create', [
            'type_reductions' => $type_reductions,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:code_reductions,code',
            'type_reduction_id' => 'required|exists:type_reductions,id',
            'montant' => 'required|numeric|min:0',
            'hors_tva' => 'boolean',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after:date_debut',
            'utilisation_max' => 'required|integer|min:1',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $codeReduction = Code_reduction::create([
            'code' => $request->code,
            'type_reduction_id' => $request->type_reduction_id,
            'montant' => $request->montant,
            'hors_tva' => $request->hors_tva ?? false,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'utilisation_max' => $request->utilisation_max,
            'utilisation_actuelles' => 0,
        ]);

        // Si un utilisateur spécifique est sélectionné, créer une entrée dans reduction_clients
        if ($request->user_id) {
            $typeReduction = Type_reduction::find($request->type_reduction_id);
            
            // Déterminer si c'est un montant fixe ou un pourcentage
            $montantFixe = null;
            $pourcentage = null;
            
            if ($typeReduction->reduction === 'fixe') {
                $montantFixe = $request->montant;
            } elseif ($typeReduction->reduction === 'pourcentage') {
                $pourcentage = $request->montant;
            }
            
            Reduction_client::create([
                'user_id' => $request->user_id,
                'code_reduction_id' => $codeReduction->id,
                'date_attribution' => now(),
                'date_expiration' => $request->date_fin,
                'montant_fixe' => $montantFixe,
                'pourcentage' => $pourcentage,
            ]);
        }

        return redirect()->route('parametres.index')->with('success', 'Code de réduction créé avec succès.');
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
