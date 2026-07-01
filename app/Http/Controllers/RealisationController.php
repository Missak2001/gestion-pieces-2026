<?php

namespace App\Http\Controllers;

use App\Models\Realisation;
use App\Models\GammeOperation;
use App\Models\User;
use App\Models\PosteTravail;
use App\Models\Machine;
use Illuminate\Http\Request;

class RealisationController extends Controller
{
    public function index()
    {
        $realisations = Realisation::with([
            'gammeOperation.operation',
            'gammeOperation.gamme',
            'user',
            'posteTravailReel',
            'machineReelle'
        ])->latest()->get();

        $gammeOperations = GammeOperation::with([
            'gamme',
            'operation',
            'posteTravailPrevu',
            'machinePrevue'
        ])->get();

        $users = User::orderBy('name')->get();

        $postes = PosteTravail::orderBy('libelle')->get();

        $machines = Machine::orderBy('libelle')->get();

        return view('realisations.index', compact(
            'realisations',
            'gammeOperations',
            'users',
            'postes',
            'machines'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gamme_operation_id' => 'required',
            'user_id' => 'required',
            'poste_travail_reel_id' => 'required',
            'machine_reelle_id' => 'required',
            'date_realisation' => 'required',
            'temps_reel' => 'required|numeric'
        ]);

        Realisation::create($request->all());

        return redirect()
            ->route('realisations.index')
            ->with('success', 'Réalisation enregistrée.');
    }

    public function destroy(Realisation $realisation)
    {
        $realisation->delete();

        return back()->with(
            'success',
            'Réalisation supprimée.'
        );
    }

    public function edit(Realisation $realisation)
    {
        $postes = PosteTravail::orderBy('libelle')->get();
        $machines = Machine::orderBy('libelle')->get();

        $realisation->load([
            'gammeOperation.gamme',
            'gammeOperation.operation',
            'gammeOperation.posteTravailPrevu',
            'gammeOperation.machinePrevue'
        ]);

        return view('realisations.edit', compact(
            'realisation',
            'postes',
            'machines'
        ));
    }

    public function update(Request $request, Realisation $realisation)
    {
        $validated = $request->validate([
            'poste_travail_reel_id' => 'required|exists:postes_travail,id',
            'machine_reelle_id' => 'required|exists:machines,id',
            'temps_reel' => 'required|numeric|min:1',
            'terminee' => 'nullable|boolean',
        ]);

        $validated['terminee'] = $request->has('terminee');

        $realisation->update($validated);

        return redirect()
            ->route('realisations.index')
            ->with('success', 'Réalisation modifiée.');
    }
}
