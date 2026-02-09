<?php

namespace App\Http\Controllers;

use App\Models\Categorie_materiel;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MaterielController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Materiel::with('categorie');

        if ($request->filled('categorie')) {
            $query->where('categorie_id', $request->input('categorie'));
        }

        if ($request->filled('prix')) {
            match ($request->input('prix')) {
                '0-50' => $query->whereBetween('prix_journalier', [0, 50]),
                '50-100' => $query->whereBetween('prix_journalier', [50, 100]),
                '100-200' => $query->whereBetween('prix_journalier', [100, 200]),
                '200+' => $query->where('prix_journalier', '>=', 200),
                default => null,
            };
        }

        return Inertia::render('materiels/Index', [
            'materiels' => $query->get(),
            'categories' => Categorie_materiel::all(),
            'filters' => $request->only(['categorie', 'prix']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('materiels/Create', [
            'categories' => Categorie_materiel::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'categorie_id' => 'required|exists:categorie_materiels,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix_journalier' => 'required|numeric|min:0',
            'dimensions' => 'nullable|string|max:255',
            'stock_total' => 'required|integer|min:0',
            'stock_disponible' => 'required|integer|min:0|max:' . $request->input('stock_total'),
        ]);

        Materiel::create($validated);

        return redirect()->route('materiels.index')->with('success', 'Matériel créé avec succès.');
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
        $materiel = Materiel::findOrFail($id);
        $materiel->delete();

        return redirect()->route('materiels.index')->with('success', 'Matériel supprimé avec succès.');
    }
}
