<?php

namespace App\Http\Controllers;

use App\Models\PosteTravail;
use Illuminate\Http\Request;

class PosteTravailController extends Controller
{
    public function index()
    {
        $postes = PosteTravail::orderBy('libelle')->get();

        return view('postes_travail.index', compact('postes'));
    }

    public function create()
    {
        return view('postes_travail.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        PosteTravail::create($validated);

        return redirect()
            ->route('postes-travail.index')
            ->with('success', 'Poste créé avec succès.');
    }

    public function edit(PosteTravail $postes_travail)
    {
        return view('postes_travail.edit', [
            'poste' => $postes_travail
        ]);
    }

    public function update(Request $request, PosteTravail $postes_travail)
    {
        $validated = $request->validate([
            'libelle' => 'required|string|max:255',
        ]);

        $postes_travail->update($validated);

        return redirect()
            ->route('postes-travail.index')
            ->with('success', 'Poste modifié avec succès.');
    }

    public function destroy(PosteTravail $postes_travail)
    {
        $postes_travail->delete();

        return redirect()
            ->route('postes-travail.index')
            ->with('success', 'Poste supprimé avec succès.');
    }
}
