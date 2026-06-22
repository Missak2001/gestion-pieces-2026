<?php

namespace App\Http\Controllers;

use App\Models\Gamme;
use App\Models\Operation;
use App\Models\GammeOperation;
use App\Models\PosteTravail;
use App\Models\Machine;
use Illuminate\Http\Request;

class GammeOperationController extends Controller
{
    public function index(Gamme $gamme)
    {
        $operations = Operation::orderBy('nom')->get();
        $postesTravail = PosteTravail::orderBy('libelle')->get();
        $machines = Machine::orderBy('libelle')->get();

        $gammeOperations = GammeOperation::with([
            'operation',
            'posteTravailPrevu',
            'machinePrevue'
        ])
            ->where('gamme_id', $gamme->id)
            ->orderBy('ordre')
            ->get();

        return view('gamme_operations.index', compact(
            'gamme',
            'operations',
            'postesTravail',
            'machines',
            'gammeOperations'
        ));
    }

    public function store(Request $request, Gamme $gamme)
    {
        $validated = $request->validate([
            'operation_id' => 'required|exists:operations,id',

            'poste_travail_prevu_id' =>
                'nullable|exists:postes_travail,id',

            'machine_prevue_id' =>
                'nullable|exists:machines,id',

            'ordre' => 'required|integer|min:1',

            'temps_prevu' => 'required|integer|min:1',
        ]);

        $validated['gamme_id'] = $gamme->id;

        GammeOperation::create($validated);

        return redirect()
            ->route('gamme-operations.index', $gamme)
            ->with('success', 'Opération ajoutée à la gamme.');
    }

    public function destroy(GammeOperation $gammeOperation)
    {
        $gamme = $gammeOperation->gamme;

        $gammeOperation->delete();

        return redirect()
            ->route('gamme-operations.index', $gamme)
            ->with('success', 'Opération supprimée.');
    }
}
