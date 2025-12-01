@extends('layouts.app')

@section('content')
<div class="animate-fadeIn">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Liste des Inscriptions</h2>
        <a href="{{ route('inscriptions.create') }}" class="btn-primary">+ Nouvelle inscription</a>
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
                    <th>Niveau</th>
                    <th>Montant total</th>
                    <th>Versé</th>
                    <th>Reste</th>
                    <th>Période</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inscriptions as $inscription)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $inscription->etudiant->nom }} {{ $inscription->etudiant->prenom }}</td>
                    <td>{{ $inscription->niveau->nom }}</td>
                    <td>{{ number_format($inscription->montant_total,0,',',' ') }} FCFA</td>
                    <td>{{ number_format($inscription->montant_paye,0,',',' ') }} FCFA</td>
                    <td>{{ number_format($inscription->montant_restant,0,',',' ') }} FCFA</td>
                    <td>{{ $inscription->date_debut }} → {{ $inscription->date_fin }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('inscriptions.edit', $inscription) }}" class="btn-warning">Modifier</a>
                        <form action="{{ route('inscriptions.destroy', $inscription) }}" method="POST" onsubmit="return confirm('Supprimer cette inscription ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Supprimer</button>
                        </form>
                        <a href="{{ route('inscriptions.receipt', $inscription->id) }}" class="btn-info" target="_blank" rel="noopener">Reçu</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
