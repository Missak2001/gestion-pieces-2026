<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function index()
    {
        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('fournisseurs.index', compact('fournisseurs'));
    }

    public function create()
    {
        return view('fournisseurs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string|max:30',
            'adresse' => 'nullable|string',
        ]);

        Fournisseur::create($validated);

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur créé avec succès.');
    }

    public function edit(Fournisseur $fournisseur)
    {
        return view('fournisseurs.edit', compact('fournisseur'));
    }

    public function update(Request $request, Fournisseur $fournisseur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'nullable|email',
            'telephone' => 'nullable|string|max:30',
            'adresse' => 'nullable|string',
        ]);

        $fournisseur->update($validated);

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur modifié.');
    }

    public function destroy(Fournisseur $fournisseur)
    {
        $fournisseur->delete();

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur supprimé.');
    }
}
