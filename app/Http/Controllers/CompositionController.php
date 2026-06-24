<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use App\Models\Composition;
use Illuminate\Http\Request;

class CompositionController extends Controller
{
    public function index(Piece $piece)
    {
        if ($piece->typePiece && $piece->typePiece->libelle === 'Matière Première') {
            return redirect()
                ->route('pieces.index')
                ->with('success', 'Une matière première ne peut pas avoir de composition.');
        }

        $compositions = $piece->composants()
            ->with('pieceEnfant')
            ->get();

        $pieces = Piece::where('id', '!=', $piece->id)
            ->whereHas('typePiece', function ($query) {
                $query->whereIn('libelle', [
                    'Matière Première',
                    'Sous-ensemble',
                    'Pièce achetée'
                ]);
            })
            ->orderBy('libelle')
            ->get();

        return view('compositions.index', compact('piece', 'compositions', 'pieces'));
    }

    public function store(Request $request, Piece $piece)
    {
        if ($piece->typePiece && $piece->typePiece->libelle === 'Matière Première') {
            return redirect()
                ->route('pieces.index')
                ->with('success', 'Une matière première ne peut pas avoir de composition.');
        }

        $request->validate([
            'piece_enfant_id' => 'required|exists:pieces,id',
            'quantite' => 'required|integer|min:1',
        ]);

        Composition::firstOrCreate(
            [
                'piece_parent_id' => $piece->id,
                'piece_enfant_id' => $request->piece_enfant_id,
            ],
            [
                'quantite' => $request->quantite,
            ]
        );

        return back()->with('success', 'Composant ajouté.');
    }

    public function destroy(Composition $composition)
    {
        $composition->delete();

        return back()->with('success', 'Composant supprimé.');
    }
}
