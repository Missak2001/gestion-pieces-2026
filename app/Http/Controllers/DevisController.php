<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Client;
use Illuminate\Http\Request;

class DevisController extends Controller
{
    public function index()
    {
        $devis = Devis::with(['client', 'lignes'])
            ->latest()
            ->get();

        return view('devis.index', compact('devis'));
    }

    public function create()
    {
        $clients = Client::orderBy('nom')->get();

        return view('devis.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_devis' => 'required|date',
            'date_limite' => 'required|date|after_or_equal:date_devis',
        ]);

        Devis::create($validated);

        return redirect()
            ->route('devis.index')
            ->with('success', 'Devis créé avec succès.');
    }

    public function destroy(Devis $devis)
    {
        $devis->delete();

        return redirect()
            ->route('devis.index')
            ->with('success', 'Devis supprimé avec succès.');
    }
}
