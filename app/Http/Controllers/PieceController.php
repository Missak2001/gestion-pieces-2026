<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use App\Models\TypePiece;
use Illuminate\Http\Request;
use App\Models\Fournisseur;

class PieceController extends Controller
{
    public function index(Request $request)
    {
        $types = TypePiece::orderBy('libelle')->get();

        $pieces = Piece::with(['typePiece', 'fournisseur'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('reference', 'like', "%{$search}%")
                    ->orWhere('libelle', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('type_piece_id'), function ($query) use ($request) {
                $query->where('type_piece_id', $request->type_piece_id);
            })
            ->orderBy('libelle')
            ->get();

        return view('pieces.index', compact('pieces', 'types'));
    }

    public function create()
    {
        $types = TypePiece::orderBy('libelle')->get();
        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('pieces.create', compact('types', 'fournisseurs'));
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
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
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
        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('pieces.edit', compact('piece', 'types', 'fournisseurs'));
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
            'fournisseur_id' => 'nullable|exists:fournisseurs,id',
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
