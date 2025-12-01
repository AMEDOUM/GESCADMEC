<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\BesoinEtudiantController;


// 👉 Redirige la page d'accueil vers login
Route::get('/', function () {
    return redirect()->route('login');
});

// Temporary debug route — remove after verifying GD
Route::get('/_debug/php-gd', function () {
    return response()->json([
        'gd' => extension_loaded('gd'),
        'php_sapi' => php_sapi_name(),
        'php_ini' => php_ini_loaded_file(),
    ]);
});

// 👉 Charge toutes les routes d'authentification Breeze
require __DIR__.'/auth.php';

// 👉 Toutes les routes protégées
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('etudiants', EtudiantController::class);
    Route::resource('inscriptions', InscriptionController::class);
    Route::resource('paiements', PaiementController::class);

    Route::get('/paiements/{id}/recu', [PaiementController::class, 'recu'])
        ->name('paiements.recu');

    Route::get('/inscriptions/{id}/receipt', [InscriptionController::class, 'receipt'])
        ->name('inscriptions.receipt');

    Route::resource('besoins', BesoinEtudiantController::class)->only([
        'index', 'create', 'store', 'update'
    ]);

});
