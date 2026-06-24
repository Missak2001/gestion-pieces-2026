<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\PosteTravail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

        $couplesExistants = CompatibiliteMachinePosteTravail::select(
            'poste_travail_id',
            'machine_id'
        )->get();

        return view(
            'compatibilites.index',
            compact(
                'compatibilites',
                'postes',
                'machines',
                'couplesExistants'
            )
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'poste_travail_id' => 'required|exists:postes_travail,id',
            'machine_id' => [
                'required',
                'exists:machines,id',
                Rule::unique('compatibilite_machine_poste_travails')
                    ->where('poste_travail_id', $request->poste_travail_id),
            ],
        ]);

        CompatibiliteMachinePosteTravail::create($validated);

        return redirect()
            ->route('compatibilites.index')
            ->with('success', 'Compatibilité ajoutée.');
    }

    public function destroy(
        CompatibiliteMachinePosteTravail $compatibilite
    ) {
        $compatibilite->delete();

        return back()
            ->with('success', 'Compatibilité supprimée.');
    }
}
