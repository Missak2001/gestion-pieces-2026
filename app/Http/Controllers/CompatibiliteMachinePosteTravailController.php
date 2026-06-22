<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\PosteTravail;
use Illuminate\Http\Request;
use App\Models\CompatibiliteMachinePosteTravail;

class CompatibiliteMachinePosteTravailController extends Controller
{
    public function index()
    {
        $compatibilites = CompatibiliteMachinePosteTravail::with([
            'posteTravail',
            'machine'
        ])->get();

        $postes = PosteTravail::orderBy('libelle')->get();

        $machines = Machine::orderBy('libelle')->get();

        return view(
            'compatibilites.index',
            compact(
                'compatibilites',
                'postes',
                'machines'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'poste_travail_id' => 'required',
            'machine_id' => 'required',
        ]);

        CompatibiliteMachinePosteTravail::create([
            'poste_travail_id' => $request->poste_travail_id,
            'machine_id' => $request->machine_id,
        ]);

        return redirect()
            ->route('compatibilites.index')
            ->with('success', 'Compatibilité ajoutée.');
    }

    public function destroy(
        CompatibiliteMachinePosteTravail $compatibilite
    )
    {
        $compatibilite->delete();

        return back()
            ->with('success', 'Compatibilité supprimée.');
    }
}
