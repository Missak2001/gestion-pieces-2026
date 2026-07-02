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
use App\Http\Controllers\GammeRealisationController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\AchatLigneController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserRoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | ADMINISTRATION
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::get('/users/roles', [UserRoleController::class, 'index'])
            ->name('users.roles');

        Route::put('/users/{user}/roles', [UserRoleController::class, 'update'])
            ->name('users.roles.update');
    });

    /*
    |--------------------------------------------------------------------------
    | ATELIER
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:atelier')->group(function () {
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

        Route::post('/gammes/{gamme}/realiser', [GammeRealisationController::class, 'store'])
            ->name('gammes.realiser');

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

        Route::get('/realisations/{realisation}/edit', [RealisationController::class, 'edit'])
            ->name('realisations.edit');

        Route::put('/realisations/{realisation}', [RealisationController::class, 'update'])
            ->name('realisations.update');

        Route::delete('/realisations/{realisation}', [RealisationController::class, 'destroy'])
            ->name('realisations.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | COMMERCIAL
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:commercial')->group(function () {
        Route::resource('clients', ClientController::class);

        Route::delete('/devis/{id}/supprimer', [DevisController::class, 'destroy'])
            ->name('devis.destroy.custom');

        Route::resource('devis', DevisController::class);

        Route::get('/devis/{devis}/lignes', [DevisLigneController::class, 'index'])
            ->name('devis-lignes.index');

        Route::post('/devis/{devis}/lignes', [DevisLigneController::class, 'store'])
            ->name('devis-lignes.store');

        Route::delete('/devis-lignes/{devisLigne}', [DevisLigneController::class, 'destroy'])
            ->name('devis-lignes.destroy');

        Route::get('/clients/{client}/devis-lignes-valides', [CommandeController::class, 'devisLignesValides'])
            ->name('clients.devis-lignes-valides');

        Route::get('/commandes', [CommandeController::class, 'index'])
            ->name('commandes.index');

        Route::get('/commandes/create', [CommandeController::class, 'create'])
            ->name('commandes.create');

        Route::post('/commandes', [CommandeController::class, 'store'])
            ->name('commandes.store');

        Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])
            ->name('commandes.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | COMPTABILITÉ
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:comptabilite')->group(function () {
        Route::resource('fournisseurs', FournisseurController::class);

        Route::get('/achats', [AchatController::class, 'index'])
            ->name('achats.index');

        Route::get('/achats/create', [AchatController::class, 'create'])
            ->name('achats.create');

        Route::post('/achats', [AchatController::class, 'store'])
            ->name('achats.store');

        Route::delete('/achats/{achat}', [AchatController::class, 'destroy'])
            ->name('achats.destroy');

        Route::get('/achats/{achat}/lignes', [AchatLigneController::class, 'index'])
            ->name('achat-lignes.index');

        Route::post('/achats/{achat}/lignes', [AchatLigneController::class, 'store'])
            ->name('achat-lignes.store');

        Route::delete('/achat-lignes/{achatLigne}', [AchatLigneController::class, 'destroy'])
            ->name('achat-lignes.destroy');

        Route::post('/achats/{achat}/reception', [AchatController::class, 'reception'])
            ->name('achats.reception');

        Route::get('/commandes/{commande}/facture', [FactureController::class, 'show'])
            ->name('factures.show');

        Route::get('/exports/factures', [ExportController::class, 'factures'])
            ->name('exports.factures');

        Route::get('/exports/achats', [ExportController::class, 'achats'])
            ->name('exports.achats');
    });
});

require __DIR__.'/auth.php';
