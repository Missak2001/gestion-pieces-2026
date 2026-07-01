<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Facture FAC-{{ date('Y') }}-{{ str_pad($commande->id, 4, '0', STR_PAD_LEFT) }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
            margin: 35px;
        }

        .header {
            border-bottom: 2px solid #1f2937;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .company {
            font-size: 22px;
            font-weight: bold;
            color: #1f2937;
        }

        .subtitle {
            font-size: 11px;
            color: #666;
        }

        .title {
            text-align: right;
            font-size: 26px;
            font-weight: bold;
            margin-top: -45px;
        }

        .invoice-number {
            text-align: right;
            color: #555;
            margin-top: 5px;
        }

        .section {
            margin-top: 25px;
        }

        .box {
            border: 1px solid #ddd;
            padding: 12px;
            width: 45%;
        }

        .left {
            float: left;
        }

        .right-box {
            float: right;
        }

        .clear {
            clear: both;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th {
            background: #1f2937;
            color: white;
            padding: 8px;
            border: 1px solid #1f2937;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        .text-right {
            text-align: right;
        }

        .total-box {
            width: 35%;
            float: right;
            margin-top: 25px;
        }

        .total-box td {
            border: none;
            padding: 6px;
        }

        .grand-total td {
            border-top: 2px solid #1f2937;
            font-weight: bold;
            font-size: 15px;
        }

        .footer {
            position: fixed;
            bottom: 20px;
            left: 35px;
            right: 35px;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 8px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="company">GESTION PIÈCES 2026</div>
        <div class="subtitle">
            Fabrication, assemblage et vente de pièces de ping-pong
        </div>

        <div class="title">FACTURE</div>
        <div class="invoice-number">
            FAC-{{ date('Y') }}-{{ str_pad($commande->id, 4, '0', STR_PAD_LEFT) }}
        </div>
    </div>

    <div class="section">
        <div class="box left">
            <strong>Émetteur</strong><br><br>
            Gestion Pièces 2026<br>
            175 chemin des Jonquilles<br>
            13013 Marseille<br>
            Tél : 04 91 00 00 00
        </div>

        <div class="box right-box">
            <strong>Client</strong><br><br>
            {{ $commande->client->nom }}<br>
            {{ $commande->client->adresse }}<br>
            {{ $commande->client->email }}
        </div>

        <div class="clear"></div>
    </div>

    <div class="section">
        <strong>Commande n° :</strong> {{ $commande->id }}<br>
        <strong>Date de commande :</strong> {{ $commande->date_commande }}<br>
        <strong>Date d'émission :</strong> {{ date('Y-m-d') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Référence</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total ligne</th>
            </tr>
        </thead>

        <tbody>
            @foreach($commande->lignes as $ligne)
                <tr>
                    <td>{{ $ligne->piece->reference }}</td>
                    <td>{{ $ligne->piece->libelle }}</td>
                    <td class="text-right">{{ $ligne->quantite }}</td>
                    <td class="text-right">{{ number_format($ligne->prix_unitaire, 2, ',', ' ') }} EUR</td>
                    <td class="text-right">{{ number_format($ligne->total(), 2, ',', ' ') }} EUR</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="total-box">
        <tr>
            <td>Sous-total</td>
            <td class="text-right">{{ number_format($commande->total(), 2, ',', ' ') }} EUR</td>
        </tr>
        <tr>
            <td>TVA</td>
            <td class="text-right">Non applicable</td>
        </tr>
        <tr class="grand-total">
            <td>Total TTC</td>
            <td class="text-right">{{ number_format($commande->total(), 2, ',', ' ') }} EUR</td>
        </tr>
    </table>

    <div class="footer">
        Merci pour votre confiance — Document généré automatiquement par Gestion Pièces 2026.
    </div>

</body>
</html>
