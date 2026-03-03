<?php

namespace App\Http\Controllers;

use App\Models\Photo_materiel;
use App\Models\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoMaterielController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'materiel_id' => 'required|exists:materiels,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            // Stocker la photo dans le storage public
            $path = $request->file('photo')->store('photos/materiels', 'public');

            // Créer l'enregistrement dans la base de données
            Photo_materiel::create([
                'materiel_id' => $request->materiel_id,
                'url_photo' => '/storage/' . $path,
            ]);

            return back()->with('success', 'Photo ajoutée avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'ajout de la photo : ' . $e->getMessage());
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
        try {
            $photo = Photo_materiel::findOrFail($id);
            
            // Supprimer le fichier du storage
            $path = str_replace('/storage/', '', $photo->url_photo);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            // Supprimer l'enregistrement de la base de données
            $photo->delete();

            return back()->with('success', 'Photo supprimée avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression de la photo : ' . $e->getMessage());
        }
    }
}
