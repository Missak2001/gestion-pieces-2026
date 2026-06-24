<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\CompositionController;
use App\Http\Controllers\GammeController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\GammeOperationController;
use App\Http\Controllers\PosteTravailController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\CompatibiliteMachinePosteTravailController;
use App\Http\Controllers\UserQualificationController;
use App\Http\Controllers\RealisationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\DevisLigneController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('pieces', PieceController::class);

    Route::resource('gammes', GammeController::class);

    Route::resource('operations', OperationController::class);

    Route::resource('postes-travail', PosteTravailController::class);

    Route::resource('machines', MachineController::class);

    Route::get('/gammes/{gamme}/operations', [GammeOperationController::class, 'index'])
    ->name('gamme-operations.index');

    Route::post('/gammes/{gamme}/operations', [GammeOperationController::class, 'store'])
        ->name('gamme-operations.store');

    Route::delete('/gamme-operations/{gammeOperation}', [GammeOperationController::class, 'destroy'])
        ->name('gamme-operations.destroy');

    Route::get('/pieces/{piece}/composition', [CompositionController::class, 'index'])
        ->name('compositions.index');

    Route::post('/pieces/{piece}/composition', [CompositionController::class, 'store'])
        ->name('compositions.store');

    Route::delete('/composition/{composition}', [CompositionController::class, 'destroy'])
        ->name('compositions.destroy');

    Route::get('/compatibilites', [CompatibiliteMachinePosteTravailController::class, 'index'])
    ->name('compatibilites.index');

    Route::post('/compatibilites', [CompatibiliteMachinePosteTravailController::class, 'store'])
        ->name('compatibilites.store');

    Route::delete('/compatibilites/{compatibilite}', [CompatibiliteMachinePosteTravailController::class, 'destroy'])
        ->name('compatibilites.destroy');


    Route::get('/qualifications', [UserQualificationController::class, 'index'])
    ->name('qualifications.index');

    Route::post('/qualifications', [UserQualificationController::class, 'store'])
        ->name('qualifications.store');

    Route::delete('/qualifications/{qualification}', [UserQualificationController::class, 'destroy'])
        ->name('qualifications.destroy');

    Route::get('/realisations', [RealisationController::class, 'index'])
    ->name('realisations.index');

    Route::post('/realisations', [RealisationController::class, 'store'])
        ->name('realisations.store');

    Route::delete('/realisations/{realisation}', [RealisationController::class, 'destroy'])
        ->name('realisations.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('clients', ClientController::class);

    Route::resource('devis', DevisController::class);


    Route::get(
    '/devis/{devis}/lignes',
    [DevisLigneController::class, 'index']
        )->name('devis-lignes.index');

        Route::post(
            '/devis/{devis}/lignes',
            [DevisLigneController::class, 'store']
        )->name('devis-lignes.store');

        Route::delete(
            '/devis-lignes/{devisLigne}',
            [DevisLigneController::class, 'destroy']
        )->name('devis-lignes.destroy');

});

require __DIR__.'/auth.php';
