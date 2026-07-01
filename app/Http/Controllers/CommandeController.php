<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\CommandeLigne;
use App\Models\DevisLigne;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['client', 'lignes.piece', 'lignes.devisLigne.devis'])
            ->latest()
            ->get();

        return view('commandes.index', compact('commandes'));
    }

    public function create()
    {
        $clients = Client::orderBy('nom')->get();

        return view('commandes.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_commande' => 'required|date',
            'devis_ligne_ids' => 'required|array|min:1',
            'devis_ligne_ids.*' => 'exists:devis_lignes,id',
        ]);

        $lignes = DevisLigne::with(['devis', 'piece.composants.pieceEnfant'])
            ->whereIn('id', $validated['devis_ligne_ids'])
            ->get();

        foreach ($lignes as $ligne) {
            if ($ligne->devis->client_id != $validated['client_id']) {
                return back()->with('success', 'Toutes les lignes doivent appartenir au même client.');
            }

            if (Carbon::parse($validated['date_commande'])->gt(Carbon::parse($ligne->devis->date_limite))) {
                return back()->with('success', 'Une ligne appartient à un devis expiré.');
            }
        }

        $pieces = $lignes->pluck('piece_id');

        if ($pieces->count() !== $pieces->unique()->count()) {
            return back()->with('success', 'Une pièce ne peut apparaître qu’une seule fois dans une commande.');
        }

        return DB::transaction(function () use ($validated, $lignes) {
            $commande = Commande::create([
                'client_id' => $validated['client_id'],
                'date_commande' => $validated['date_commande'],
            ]);

            foreach ($lignes as $ligne) {
                $piece = $ligne->piece;

                if ($piece->stock < $ligne->quantite) {
                    return back()->with('success', 'Stock insuffisant pour : ' . $piece->libelle);
                }

                $piece->decrement('stock', $ligne->quantite);

                CommandeLigne::create([
                    'commande_id' => $commande->id,
                    'devis_ligne_id' => $ligne->id,
                    'piece_id' => $ligne->piece_id,
                    'quantite' => $ligne->quantite,
                    'prix_unitaire' => $ligne->prix_unitaire,
                ]);
            }

            return redirect()
                ->route('commandes.index')
                ->with('success', 'Commande créée à partir des lignes de devis.');
        });
    }

    public function devisLignesValides(Client $client)
    {
        $lignes = DevisLigne::with(['devis', 'piece'])
            ->whereHas('devis', function ($query) use ($client) {
                $query->where('client_id', $client->id)
                    ->whereDate('date_limite', '>=', now()->toDateString());
            })
            ->get()
            ->map(function ($ligne) {
                return [
                    'id' => $ligne->id,
                    'devis_id' => $ligne->devis->id,
                    'piece' => $ligne->piece->reference . ' - ' . $ligne->piece->libelle,
                    'piece_id' => $ligne->piece_id,
                    'quantite' => $ligne->quantite,
                    'prix_unitaire' => $ligne->prix_unitaire,
                    'total' => $ligne->total(),
                ];
            });

        return response()->json($lignes);
    }

    public function destroy(Commande $commande)
    {
        $commande->lignes()->delete();
        $commande->delete();

        return redirect()
            ->route('commandes.index')
            ->with('success', 'Commande supprimée.');
    }
}
