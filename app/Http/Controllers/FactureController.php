<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Barryvdh\DomPDF\Facade\Pdf;

class FactureController extends Controller
{
    public function show(Commande $commande)
    {
        $commande->load(['client', 'lignes.piece']);

        $pdf = Pdf::loadView('factures.show', compact('commande'));

        return $pdf->download('facture-commande-' . $commande->id . '.pdf');
    }
}
