<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::orderBy('libelle')->get();

        return view('machines.index', compact('machines'));
    }

    public function create()
    {
        return view('machines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        Machine::create($validated);

        return redirect()->route('machines.index')
            ->with('success', 'Machine créée avec succès.');
    }

    public function edit(Machine $machine)
    {
        return view('machines.edit', compact('machine'));
    }

    public function update(Request $request, Machine $machine)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        $machine->update($validated);

        return redirect()->route('machines.index')
            ->with('success', 'Machine modifiée avec succès.');
    }

    public function destroy(Machine $machine)
    {
        $machine->delete();

        return redirect()->route('machines.index')
            ->with('success', 'Machine supprimée avec succès.');
    }
}
