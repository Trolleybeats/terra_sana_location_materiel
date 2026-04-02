<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Utilisateurs
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('utilisateurs', App\Http\Controllers\UtilisateurController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('particuliers', App\Http\Controllers\ParticulierController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('professionnels', App\Http\Controllers\ProfessionnelController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('contact_pro', App\Http\Controllers\ContactProController::class);
});

// Matériels
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('materiels', App\Http\Controllers\MaterielController::class);
    Route::post('photos-materiel', [App\Http\Controllers\PhotoMaterielController::class, 'store'])->name('photos-materiel.store');
    Route::delete('photos-materiel/{id}', [App\Http\Controllers\PhotoMaterielController::class, 'destroy'])->name('photos-materiel.destroy');
});

// Commandes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('commandes', App\Http\Controllers\CommandeController::class);
    Route::post('panier/ajouter', [App\Http\Controllers\CommandeController::class, 'ajouterAuPanier'])->name('panier.ajouter');
    Route::delete('panier/{detail}', [App\Http\Controllers\CommandeController::class, 'retirerDuPanier'])->name('panier.retirer');
    Route::put('panier/{detail}', [App\Http\Controllers\CommandeController::class, 'mettreAJourQuantite'])->name('panier.update');
    Route::delete('panier', [App\Http\Controllers\CommandeController::class, 'viderPanier'])->name('panier.vider');
    Route::post('code-reduction/verifier', [App\Http\Controllers\CommandeController::class, 'verifierCodeReduction'])->name('code-reduction.verifier');
});

// Factures
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('factures', App\Http\Controllers\FactureController::class);
    Route::get('factures/{id}/download-pdf', [App\Http\Controllers\FactureController::class, 'downloadPdf'])->name('factures.download-pdf');
});

// Paramètres généraux
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('parametres', App\Http\Controllers\ParametreController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('code_reductions', App\Http\Controllers\CodeReductionController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('types', App\Http\Controllers\TypeController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('langues', App\Http\Controllers\LangueController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pays', App\Http\Controllers\PaysController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('communes', App\Http\Controllers\CommuneController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('categories_materiel', App\Http\Controllers\CategorieMaterielController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('fonctions', App\Http\Controllers\FonctionController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('statuts_paiement', App\Http\Controllers\StatutPaiementController::class);
});

require __DIR__.'/settings.php';
