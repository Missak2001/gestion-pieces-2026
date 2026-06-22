<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function index()
    {
        $operations = Operation::orderBy('nom')->get();

        return view('operations.index', compact('operations'));
    }

    public function create()
    {
        return view('operations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'description' => 'nullable|string',
        ]);

        Operation::create($validated);

        return redirect()->route('operations.index')
            ->with('success', 'Opération créée avec succès.');
    }

    public function edit(Operation $operation)
    {
        return view('operations.edit', compact('operation'));
    }

    public function update(Request $request, Operation $operation)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $operation->update($validated);

        return redirect()->route('operations.index')
            ->with('success', 'Opération modifiée avec succès.');
    }

    public function destroy(Operation $operation)
    {
        $operation->delete();

        return redirect()->route('operations.index')
            ->with('success', 'Opération supprimée avec succès.');
    }
}
