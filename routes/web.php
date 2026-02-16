<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::resource('materiels', App\Http\Controllers\MaterielController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('contact_pro', App\Http\Controllers\ContactProController::class);
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('commandes', App\Http\Controllers\CommandeController::class);
    Route::post('panier/ajouter', [App\Http\Controllers\CommandeController::class, 'ajouterAuPanier'])->name('panier.ajouter');
    Route::delete('panier/{detail}', [App\Http\Controllers\CommandeController::class, 'retirerDuPanier'])->name('panier.retirer');
    Route::put('panier/{detail}', [App\Http\Controllers\CommandeController::class, 'mettreAJourQuantite'])->name('panier.update');
    Route::delete('panier', [App\Http\Controllers\CommandeController::class, 'viderPanier'])->name('panier.vider');
});

require __DIR__.'/settings.php';
