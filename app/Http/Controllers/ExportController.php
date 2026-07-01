<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use App\Models\Commande;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function factures(Request $request)
    {
        $mois = $request->input('mois', now()->format('Y-m'));

        $commandes = Commande::with('client', 'lignes')
            ->whereYear('date_commande', substr($mois, 0, 4))
            ->whereMonth('date_commande', substr($mois, 5, 2))
            ->get();

        $filename = "factures-$mois.csv";

        return response()->streamDownload(function () use ($commandes) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Facture', 'Commande', 'Client', 'Date', 'Total']);

            foreach ($commandes as $commande) {
                fputcsv($file, [
                    'FAC-' . date('Y') . '-' . str_pad($commande->id, 4, '0', STR_PAD_LEFT),
                    $commande->id,
                    $commande->client->nom,
                    $commande->date_commande,
                    $commande->total(),
                ]);
            }

            fclose($file);
        }, $filename);
    }

    public function achats(Request $request)
    {
        $mois = $request->input('mois', now()->subMonth()->format('Y-m'));

        $achats = Achat::with('fournisseur', 'lignes')
            ->whereYear('date_commande', substr($mois, 0, 4))
            ->whereMonth('date_commande', substr($mois, 5, 2))
            ->get();

        $filename = "achats-a-payer-$mois.csv";

        return response()->streamDownload(function () use ($achats) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Achat', 'Fournisseur', 'Date commande', 'Livraison prévue', 'Livraison réelle', 'Total']);

            foreach ($achats as $achat) {
                fputcsv($file, [
                    $achat->id,
                    $achat->fournisseur->nom,
                    $achat->date_commande,
                    $achat->date_livraison_prevue,
                    $achat->date_livraison_reelle ?? '',
                    $achat->total(),
                ]);
            }

            fclose($file);
        }, $filename);
    }
}
