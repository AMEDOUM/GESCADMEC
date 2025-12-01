@extends('layouts.app')

@section('content')
<div class="animate-fadeIn">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Historique des Paiements</h2>
        <a href="{{ route('paiements.create') }}" class="btn-primary">+ Nouveau paiement</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="card p-4">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Étudiant</th>
                    <th>Montant</th>
                    <th>Date paiement</th>
                    <th>Mode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paiements as $paiement)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $paiement->inscription->etudiant->nom }} {{ $paiement->inscription->etudiant->prenom }}</td>
                    <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $paiement->date_paiement }}</td>
                    <td>{{ ucfirst($paiement->mode_paiement) }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('paiements.edit', $paiement) }}" class="btn-warning">Modifier</a>
                        <form action="{{ route('paiements.destroy', $paiement) }}" method="POST" onsubmit="return confirm('Supprimer ce paiement ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
