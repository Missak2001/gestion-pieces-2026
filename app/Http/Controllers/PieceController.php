<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use App\Models\TypePiece;
use Illuminate\Http\Request;

class PieceController extends Controller
{
    public function index()
    {
        $pieces = Piece::with('typePiece')->orderBy('libelle')->get();

        return view('pieces.index', compact('pieces'));
    }

    public function create()
    {
        $types = TypePiece::orderBy('libelle')->get();

        return view('pieces.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'required|string|unique:pieces,reference',
            'libelle' => 'required|string',
            'stock' => 'required|integer|min:0',
            'prix_vente' => 'nullable|numeric|min:0',
            'prix_catalogue' => 'nullable|numeric|min:0',
            'type_piece_id' => 'required|exists:type_pieces,id',
        ]);

        Piece::create($validated);

        return redirect()->route('pieces.index')
            ->with('success', 'Pièce créée avec succès.');
    }

    public function show(Piece $piece)
    {
        return view('pieces.show', compact('piece'));
    }

    public function edit(Piece $piece)
    {
        $types = TypePiece::orderBy('libelle')->get();

        return view('pieces.edit', compact('piece', 'types'));
    }

    public function update(Request $request, Piece $piece)
    {
        $validated = $request->validate([
            'reference' => 'required|string|unique:pieces,reference,' . $piece->id,
            'libelle' => 'required|string',
            'stock' => 'required|integer|min:0',
            'prix_vente' => 'nullable|numeric|min:0',
            'prix_catalogue' => 'nullable|numeric|min:0',
            'type_piece_id' => 'required|exists:type_pieces,id',
        ]);

        $piece->update($validated);

        return redirect()->route('pieces.index')
            ->with('success', 'Pièce modifiée avec succès.');
    }

    public function destroy(Piece $piece)
    {
        $piece->delete();

        return redirect()->route('pieces.index')
            ->with('success', 'Pièce supprimée avec succès.');
    }
}
