<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use App\Models\Composition;
use Illuminate\Http\Request;

class CompositionController extends Controller
{
    public function index(Piece $piece)
    {
        $compositions = $piece->composants()
            ->with('pieceEnfant')
            ->get();

        $pieces = Piece::where('id', '!=', $piece->id)
            ->orderBy('libelle')
            ->get();

        return view(
            'compositions.index',
            compact('piece', 'compositions', 'pieces')
        );
    }

    public function store(Request $request, Piece $piece)
    {
        $request->validate([
            'piece_enfant_id' => 'required|exists:pieces,id',
            'quantite' => 'required|integer|min:1',
        ]);

        Composition::create([
            'piece_parent_id' => $piece->id,
            'piece_enfant_id' => $request->piece_enfant_id,
            'quantite' => $request->quantite,
        ]);

        return back();
    }

    public function destroy(Composition $composition)
    {
        $composition->delete();

        return back();
    }
}
