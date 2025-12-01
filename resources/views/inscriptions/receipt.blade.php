<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reçu d'inscription</title>
    <style>
        /* Dompdf-friendly minimal styles */
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; color: #222; margin: 0; padding: 0; }
        .page { padding: 28px; }
        .header { display: flex; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 12px; margin-bottom: 18px; }
        .brand { font-weight: 800; color: #0f172a; font-size: 18px; }
        .brand-sub { color: #475569; font-size: 12px; }
        .logo { width: 64px; height: 64px; background: #0f172a; border-radius: 8px; display: inline-block; margin-right: 12px; }

        .section { margin-bottom: 14px; }
        .title { font-size: 16px; font-weight: 700; color: #0b2545; margin-bottom: 6px; }

        .info { font-size: 13px; color: #0f172a; }
        .info td { padding: 4px 8px; vertical-align: top; }

        .table { width: 100%; border-collapse: collapse; margin-top: 8px; }
        .table th, .table td { border: 1px solid #e6eef8; padding: 8px 10px; font-size: 13px; }
        .table th { background: #f1f5f9; text-align: left; font-weight: 700; }

        .totals { margin-top: 12px; width: 100%; }
        .totals td { padding: 6px 8px; font-size: 13px; }
        .totals .label { text-align: left; color: #475569; }
        .totals .value { text-align: right; font-weight: 700; }

        .foot { margin-top: 22px; font-size: 12px; color: #64748b; }
        .signature { margin-top: 28px; display: flex; justify-content: space-between; }
        .sig-box { width: 200px; text-align: center; }
        .small { font-size: 11px; color: #94a3b8; }

        @media print {
            .page { padding: 12mm; }
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="header">
            {{-- Render logo if uploaded to public/images/logo.png; embed as base64 for dompdf --}}
            @php
                // Try multiple possible logo filenames and embed the first one found as base64
                $possible = ['logo.png', 'logo.jpg', 'logo.jpeg', 'logo.webp', 'logo.svg'];
                $logoData = null;
                foreach ($possible as $fname) {
                    $p = public_path('images/' . $fname);
                    if (file_exists($p)) {
                        $type = strtolower(pathinfo($p, PATHINFO_EXTENSION));
                        $data = file_get_contents($p);
                        $mime = $type === 'svg' ? 'image/svg+xml' : 'image/' . $type;
                        $logoData = 'data:' . $mime . ';base64,' . base64_encode($data);
                        break;
                    }
                }
            @endphp

            @if($logoData)
                <img src="{{ $logoData }}" alt="Logo" style="width:120px; height:60px; border-radius:6px; margin-right:12px; object-fit:cover">
            @else
                <div class="logo" style="width:120px; height:60px; border-radius:6px; margin-right:12px"></div>
            @endif

            <div>
                <div class="brand">PRIMA ACADEMIE</div>
                <div class="brand-sub">Reçu d'inscription</div>
                <div class="small" style="margin-top:6px">
                    @php
                        $addr = trim(env('APP_ADDRESS', 'Votre adresse ici'));
                        $phone = trim(env('APP_PHONE', '00 00 00 00'));
                        $email = trim(env('APP_EMAIL', 'contact@prima.local'));
                    @endphp
                    {{ $addr }} • Tél: {{ $phone }} • {{ $email }}
                </div>
            </div>

            <div style="margin-left:auto; text-align:right;">
                <div class="small">Date: {{ now()->format('Y-m-d') }}</div>
                <div class="small">Réf: INS-{{ $inscription->id }}</div>
            </div>
        </div>

        <div class="section">
            <div class="title">Informations Étudiant</div>
            <table class="info">
                <tr>
                    <td style="width:130px"><strong>Nom</strong></td>
                    <td>{{ $inscription->etudiant->nom }} {{ $inscription->etudiant->prenom }}</td>
                </tr>
                <tr>
                    <td><strong>Téléphone</strong></td>
                    <td>{{ $inscription->etudiant->telephone ?? '-' }}</td>
                </tr>
                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{ $inscription->etudiant->email ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <div class="title">Détails de l'inscription</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Niveau</th>
                        <th>Période</th>
                        <th>Montant total</th>
                        <th>Montant payé</th>
                        <th>Reste</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $inscription->niveau->nom }}</td>
                        <td>{{ $inscription->date_debut }} → {{ $inscription->date_fin }}</td>
                        <td>{{ number_format($inscription->montant_total,0,',',' ') }} FCFA</td>
                        <td>{{ number_format($inscription->montant_paye,0,',',' ') }} FCFA</td>
                        <td>{{ number_format($inscription->montant_restant,0,',',' ') }} FCFA</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <table class="totals">
            <tr>
                <td class="label">Mode de paiement</td>
                <td class="value">{{ $inscription->paiements->last()->mode ?? 'N/A' }}</td>
            </tr>
        </table>

        <div class="signature">
            <div class="sig-box">
                <div class="small">Émis par :</div>
                <div style="margin-top:28px">______________________</div>
            </div>
            <div class="sig-box" style="text-align:right">
                <div class="small">Signature parent / Responsable</div>
                <div style="margin-top:28px">______________________</div>
            </div>
        </div>

        <div class="foot">
            Merci pour votre confiance. Pour toute question, contactez l'administration.
        </div>
    </div>
</body>
</html>
