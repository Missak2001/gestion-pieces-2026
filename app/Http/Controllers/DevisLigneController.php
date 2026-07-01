<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Piece;
use App\Models\DevisLigne;
use Illuminate\Http\Request;

class DevisLigneController extends Controller
{
    public function index(Devis $devis)
    {
        $devis->load(['client', 'lignes.piece']);

        $pieces = Piece::whereNotNull('prix_vente')
            ->orderBy('libelle')
            ->get();

        return view('devis_lignes.index', compact('devis', 'pieces'));
    }

    public function store(Request $request, Devis $devis)
    {
        $validated = $request->validate([
            'piece_id' => 'required|exists:pieces,id',
            'quantite' => 'required|integer|min:1',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        $piece = Piece::findOrFail($validated['piece_id']);

        if ($piece->prix_vente === null) {
            return back()->with('success', 'Cette pièce ne possède pas de prix de vente.');
        }

        DevisLigne::create([
            'devis_id' => $devis->id,
            'piece_id' => $validated['piece_id'],
            'quantite' => $validated['quantite'],
            'prix_unitaire' => $validated['prix_unitaire'],
        ]);

        return redirect()
            ->route('devis-lignes.index', $devis)
            ->with('success', 'Ligne ajoutée au devis.');
    }

    public function destroy(DevisLigne $devisLigne)
    {
        $devis = $devisLigne->devis;

        $devisLigne->delete();

        return redirect()
            ->route('devis-lignes.index', $devis)
            ->with('success', 'Ligne supprimée.');
    }
}
