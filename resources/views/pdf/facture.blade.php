<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $facture->numero_facture }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .header {
            margin-bottom: 30px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #4CAF50;
            font-size: 28px;
            margin-bottom: 5px;
        }
        .header .company-info {
            color: #666;
            font-size: 11px;
        }
        .facture-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .facture-info .left,
        .facture-info .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .facture-info .right {
            text-align: right;
        }
        .info-block {
            margin-bottom: 15px;
        }
        .info-block h3 {
            font-size: 14px;
            color: #4CAF50;
            margin-bottom: 5px;
        }
        .info-block p {
            margin: 3px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table thead {
            background-color: #4CAF50;
            color: white;
        }
        table th,
        table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            font-weight: bold;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .totals {
            width: 40%;
            margin-left: auto;
            margin-top: 20px;
        }
        .totals table {
            margin: 0;
        }
        .totals .total-row {
            background-color: #4CAF50 !important;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 10px;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }
        .status-en-attente {
            background-color: #FFC107;
            color: #000;
        }
        .status-payee {
            background-color: #4CAF50;
            color: white;
        }
        .status-non-payee {
            background-color: #F44336;
            color: white;
        }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <h1>FACTURE</h1>
        <div class="company-info">
            <strong>Terra Sana Location Matériel</strong><br>
            Location de matériel écologique<br>
            contact@terrasana.be | www.terrasana.be
        </div>
    </div>

    <!-- Informations facture et client -->
    <div class="facture-info">
        <div class="left">
            <div class="info-block">
                <h3>Facturé à :</h3>
                <p><strong>{{ $commande->user->name ?? $commande->user->email }}</strong></p>
                <p>{{ $commande->nom_rue }} {{ $commande->numero_rue }}</p>
                <p>{{ $commande->commune->numero_commune ?? '' }} {{ $commande->commune->nom_commune ?? '' }}</p>
                <p>{{ $commande->pays->nom_pays ?? '' }}</p>
                <p>Email: {{ $commande->user->email }}</p>
            </div>
        </div>
        <div class="right">
            <div class="info-block">
                <p><strong>N° Facture:</strong> {{ $facture->numero_facture }}</p>
                <p><strong>Date d'émission:</strong> {{ \Carbon\Carbon::parse($facture->date_emission)->format('d/m/Y') }}</p>
                <p><strong>Date d'échéance:</strong> {{ \Carbon\Carbon::parse($facture->date_echeance)->format('d/m/Y') }}</p>
                <p><strong>N° Commande:</strong> {{ $commande->numero_commande }}</p>
                <p>
                    <strong>Statut:</strong> 
                    <span class="status-badge status-{{ str_replace(' ', '-', strtolower($facture->statut_paiement->statut ?? 'en-attente')) }}">
                        {{ $facture->statut_paiement->statut ?? 'En attente' }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Détails de la location -->
    <div class="info-block">
        <h3>Période de location</h3>
        <p><strong>Du:</strong> {{ \Carbon\Carbon::parse($commande->date_debut)->format('d/m/Y') }} <strong>au:</strong> {{ \Carbon\Carbon::parse($commande->date_fin)->format('d/m/Y') }}</p>
        <p><strong>Mode de livraison:</strong> {{ $commande->mode_livraison->mode_livraison ?? '-' }}</p>
        <p><strong>Mode de retour:</strong> {{ $commande->mode_retour->mode_retour ?? '-' }}</p>
        <p><strong>Frais de livraison:</strong> {{ number_format($commande->frais_livraison ?? 0, 2, ',', ' ') }} €</p>
    </div>

    <!-- Tableau des matériels -->
    <table>
        <thead>
            <tr>
                <th>Matériel</th>
                <th>Catégorie</th>
                <th class="text-right">Quantité</th>
                <th class="text-right">Prix unitaire HT</th>
                <th class="text-right">Total HT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($detailsCommandes as $detail)
            <tr>
                <td>
                    <strong>{{ $detail->materiel->nom ?? '-' }}</strong><br>
                    <small>Réf: #{{ $detail->materiel->id }}</small>
                </td>
                <td>{{ $detail->materiel->categorie->nom ?? '-' }}</td>
                <td class="text-right">{{ $detail->quantite ?? 1 }}</td>
                <td class="text-right">{{ number_format($detail->prix_unitaire ?? 0, 2, ',', ' ') }} €</td>
                <td class="text-right">{{ number_format($detail->sous_total ?? 0, 2, ',', ' ') }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totaux -->
    <div class="totals">
        <table>
            <tr>
                <td><strong>Montant HT:</strong></td>
                <td class="text-right">{{ number_format($facture->montant_ht, 2, ',', ' ') }} €</td>
            </tr>
            <tr>
                <td><strong>TVA (21%):</strong></td>
                <td class="text-right">{{ number_format($facture->montant_tva, 2, ',', ' ') }} €</td>
            </tr>
            <tr class="total-row">
                <td><strong>TOTAL TTC:</strong></td>
                <td class="text-right"><strong>{{ number_format($facture->montant_ttc, 2, ',', ' ') }} €</strong></td>
            </tr>
        </table>
    </div>

    <!-- Pied de page -->
    <div class="footer">
        <p><strong>Conditions de paiement:</strong> Paiement sous 30 jours à réception de facture</p>
        <p>TVA BE 0XXX.XXX.XXX - RC Bruxelles XXX.XXX</p>
        <p>Terra Sana Location Matériel - Tous droits réservés © {{ now()->year }}</p>
    </div>
</body>
</html>
