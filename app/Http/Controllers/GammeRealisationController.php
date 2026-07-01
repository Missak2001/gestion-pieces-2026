<?php

namespace App\Http\Controllers;

use App\Models\Gamme;
use App\Models\Realisation;
use Illuminate\Support\Facades\Auth;

class GammeRealisationController extends Controller
{
    public function store(Gamme $gamme)
    {
        $gamme->load([
            'operations.posteTravailPrevu',
            'operations.machinePrevue'
        ]);

        foreach ($gamme->operations as $gammeOperation) {
            Realisation::create([
                'gamme_operation_id' => $gammeOperation->id,
                'user_id' => Auth::id(),
                'poste_travail_reel_id' => $gammeOperation->poste_travail_prevu_id,
                'machine_reelle_id' => $gammeOperation->machine_prevue_id,
                'date_realisation' => now()->toDateString(),
                'temps_reel' => $gammeOperation->temps_prevu,
                'terminee' => false,
            ]);
        }

        return redirect()
            ->route('realisations.index')
            ->with('success', 'Réalisations générées pour la gamme.');
    }
}
