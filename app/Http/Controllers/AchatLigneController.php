<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Piece;
use App\Models\AchatLigne;
use Illuminate\Http\Request;

class AchatLigneController extends Controller
{
    public function index(Achat $achat)
    {
        $achat->load(['fournisseur', 'lignes.piece']);

        $pieces = Piece::where('fournisseur_id', $achat->fournisseur_id)
            ->orderBy('libelle')
            ->get();

        return view('achat_lignes.index', compact('achat', 'pieces'));
    }

    public function store(Request $request, Achat $achat)
    {
        $validated = $request->validate([
            'piece_id' => 'required|exists:pieces,id',
            'quantite' => 'required|integer|min:1',
            'prix_achat' => 'required|numeric|min:0',
        ]);

        AchatLigne::create([
            'achat_id' => $achat->id,
            'piece_id' => $validated['piece_id'],
            'quantite' => $validated['quantite'],
            'prix_achat' => $validated['prix_achat'],
        ]);

        return redirect()
            ->route('achat-lignes.index', $achat)
            ->with('success', 'Ligne d’achat ajoutée.');
    }

    public function destroy(AchatLigne $achatLigne)
    {
        $achat = $achatLigne->achat;

        $achatLigne->delete();

        return redirect()
            ->route('achat-lignes.index', $achat)
            ->with('success', 'Ligne d’achat supprimée.');
    }
}
