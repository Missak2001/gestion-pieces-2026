<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AchatController extends Controller
{
    public function index()
    {
        $achats = Achat::with('fournisseur')
            ->latest()
            ->get();

        return view('achats.index', compact('achats'));
    }

    public function create()
    {
        $fournisseurs = Fournisseur::orderBy('nom')->get();

        return view('achats.create', compact('fournisseurs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fournisseur_id' => 'required|exists:fournisseurs,id',
            'date_commande' => 'required|date',
            'date_livraison_prevue' => 'required|date|after_or_equal:date_commande',
        ]);

        Achat::create($validated);

        return redirect()
            ->route('achats.index')
            ->with('success', 'Commande fournisseur créée.');
    }

    public function destroy(Achat $achat)
    {
        $achat->delete();

        return redirect()
            ->route('achats.index')
            ->with('success', 'Commande fournisseur supprimée.');
    }

    public function reception(Achat $achat)
    {
        if ($achat->date_livraison_reelle) {
            return back()->with(
                'success',
                'Cette commande est déjà réceptionnée.'
            );
        }

        foreach ($achat->lignes as $ligne) {

            $piece = $ligne->piece;

            $piece->increment(
                'stock',
                $ligne->quantite
            );
        }

        $achat->update([
            'date_livraison_reelle' => Carbon::today(),
        ]);

        return back()->with(
            'success',
            'Commande réceptionnée et stock mis à jour.'
        );
    }
}
