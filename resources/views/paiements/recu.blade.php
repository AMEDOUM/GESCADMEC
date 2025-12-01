<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Reçu de paiement - {{ $paiement->inscription->etudiant->nom }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 40px;
            color: #333;
        }
        header {
            text-align: center;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        header img {
            width: 80px;
            float: left;
        }
        h1 {
            font-size: 22px;
            color: #2563eb;
            margin-bottom: 0;
        }
        .recu-info {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            font-size: 14px;
        }
        th {
            background-color: #2563eb;
            color: white;
            text-align: left;
        }
        footer {
            text-align: center;
            font-size: 13px;
            margin-top: 40px;
            color: #555;
        }
        .signature {
            margin-top: 60px;
            text-align: right;
            font-size: 14px;
        }
        .signature img {
            width: 120px;
            display: block;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <header>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        <h1>Centre de Formation - GESCAD MEC</h1>
        <p class="recu-info">Reçu officiel de paiement</p>
    </header>

    <p><strong>Date d’émission :</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

    <table>
        <tr>
            <th>Nom de l’étudiant</th>
            <td>{{ $paiement->inscription->etudiant->nom }} {{ $paiement->inscription->etudiant->prenom }}</td>
        </tr>
        <tr>
            <th>Niveau</th>
            <td>{{ $paiement->inscription->niveau->nom }}</td>
        </tr>
        <tr>
            <th>Date du paiement</th>
            <td>{{ \Carbon\Carbon::parse($paiement->date_paiement)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <th>Montant versé</th>
            <td><strong>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</strong></td>
        </tr>
        <tr>
            <th>Mode de paiement</th>
            <td>{{ ucfirst($paiement->mode_paiement) }}</td>
        </tr>
        <tr>
            <th>Numéro de reçu</th>
            <td>#{{ str_pad($paiement->id, 5, '0', STR_PAD_LEFT) }}</td>
        </tr>
    </table>

    <div class="signature">
        <p>Signature du comptable :</p>
        <img src="{{ public_path('images/signature.png') }}" alt="Signature">
        <p><strong>Responsable Financier</strong></p>
    </div>

    <footer>
        <p>Ce reçu est émis automatiquement par le système GESCAD MEC.</p>
        <p>© {{ date('Y') }} — Tous droits réservés.</p>
    </footer>
</body>
</html>
