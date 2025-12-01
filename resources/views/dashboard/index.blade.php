@extends('layouts.app')
@section('content')

<x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Tableau de bord</h2>
            <div class="flex items-center gap-3">
                <a href="{{ route('besoins.create') }}" class="btn-primary">+ Nouveau besoin</a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="stat-card">
                <div class="stat-title">Étudiants</div>
                <div class="stat-value text-3xl">{{ $total_etudiants }}</div>
                <div class="text-sm text-gray-500 mt-1">Total des étudiants inscrits</div>
            </div>

            <div class="stat-card">
                <div class="stat-title">Inscriptions</div>
                <div class="stat-value text-3xl">{{ $total_inscriptions }}</div>
                <div class="text-sm text-gray-500 mt-1">Inscriptions totales</div>
            </div>

            <div class="stat-card">
                <div class="stat-title">Paiements (FCFA)</div>
                <div class="stat-value text-3xl">{{ number_format($total_paiements, 0, ',', ' ') }}</div>
                <div class="text-sm text-gray-500 mt-1">Somme reçue</div>
            </div>

            <div class="stat-card">
                <div class="stat-title">Besoins</div>
                <div class="stat-value text-3xl">{{ $total_besoins }}</div>
                <div class="text-sm text-gray-500 mt-1">Demandes enregistrées</div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="card">
                <h3 class="text-lg font-semibold mb-4">Évolution des paiements</h3>
                <div class="h-64">
                    <canvas id="paiementsChart"></canvas>
                </div>
            </div>

            <div class="card">
                <h3 class="text-lg font-semibold mb-4">Inscriptions par mois</h3>
                <div class="h-64">
                    <canvas id="inscriptionsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent besoins + table d'exemples -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="card lg:col-span-2">
                <h3 class="text-lg font-semibold mb-4">Derniers besoins</h3>

                @if($recent_besoins->isEmpty())
                    <p class="text-sm text-gray-500">Aucun besoin récent.</p>
                @else
                    <ul class="space-y-3">
                        @foreach($recent_besoins as $b)
                            <li class="flex items-start gap-4 p-3 rounded-md hover:bg-gray-50">
                                <div class="flex-1">
                                    <div class="font-semibold">{{ $b->etudiant ? $b->etudiant->nom . ' ' . $b->etudiant->prenoms : 'Étudiant supprimé' }}</div>
                                    <div class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($b->description, 120) }}</div>
                                </div>
                                <div>
                                    <span class="badge {{ $b->etat == 'validé' ? 'badge-success' : ($b->etat == 'refusé' ? 'badge-danger' : 'badge-warning') }}">
                                        {{ ucfirst($b->etat) }}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="card">
                <h3 class="text-lg font-semibold mb-4">Actions rapides</h3>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('etudiants.create') }}" class="btn-gray">Ajouter étudiant</a>
                    <a href="{{ route('inscriptions.create') }}" class="btn-gray">Nouvelle inscription</a>
                    <a href="{{ route('paiements.create') }}" class="btn-gray">Enregistrer paiement</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>
    <script>
        // Data passed from controller
        const paiementLabels = @json($paiementLabels);
        const paiementData = @json($paiementData);
        const inscriptionLabels = @json($inscriptionLabels);
        const inscriptionData = @json($inscriptionData);

        // Paiements chart
        const ctxP = document.getElementById('paiementsChart').getContext('2d');
        new Chart(ctxP, {
            type: 'bar',
            data: {
                labels: paiementLabels,
                datasets: [{
                    label: 'Montant (FCFA)',
                    data: paiementData,
                    backgroundColor: 'rgba(37, 99, 235, 0.15)',
                    borderColor: 'rgba(37, 99, 235, 1)',
                    borderWidth: 2,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true } }
            }
        });

        // Inscriptions chart
        const ctxI = document.getElementById('inscriptionsChart').getContext('2d');
        new Chart(ctxI, {
            type: 'line',
            data: {
                labels: inscriptionLabels,
                datasets: [{
                    label: 'Inscriptions',
                    data: inscriptionData,
                    borderColor: 'rgba(16, 185, 129, 1)',
                    backgroundColor: 'rgba(16, 185, 129, 0.12)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true } }
            }
        });
    </script>
@endsection