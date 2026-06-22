<?php

namespace App\Http\Controllers;

use App\Models\Gamme;
use App\Models\Piece;
use Illuminate\Http\Request;

class GammeController extends Controller
{
    public function index()
    {
        $gammes = Gamme::with('piece')->orderBy('nom')->get();

        return view('gammes.index', compact('gammes'));
    }

    public function create()
    {
        $pieces = Piece::orderBy('libelle')->get();

        return view('gammes.create', compact('pieces'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'piece_id' => 'required|exists:pieces,id',
            'nom' => 'required|string',
            'responsable' => 'nullable|string',
        ]);

        Gamme::create($validated);

        return redirect()->route('gammes.index')
            ->with('success', 'Gamme créée avec succès.');
    }

    public function edit(Gamme $gamme)
    {
        $pieces = Piece::orderBy('libelle')->get();

        return view('gammes.edit', compact('gamme', 'pieces'));
    }

    public function update(Request $request, Gamme $gamme)
    {
        $validated = $request->validate([
            'piece_id' => 'required|exists:pieces,id',
            'nom' => 'required|string',
            'responsable' => 'nullable|string',
        ]);

        $gamme->update($validated);

        return redirect()->route('gammes.index')
            ->with('success', 'Gamme modifiée avec succès.');
    }

    public function destroy(Gamme $gamme)
    {
        $gamme->delete();

        return redirect()->route('gammes.index')
            ->with('success', 'Gamme supprimée avec succès.');
    }
}
