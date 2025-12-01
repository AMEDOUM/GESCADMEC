@extends('layouts.app')

@section('content')
<div class="animate-fadeIn">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Liste des Étudiants</h2>
        <a href="{{ route('etudiants.create') }}" class="btn-primary">+ Ajouter un étudiant</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="card p-4">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($etudiants as $etudiant)
                <tr>
                    <td>{{ $etudiant->id }}</td>
                    <td>{{ $etudiant->nom }}</td>
                    <td>{{ $etudiant->prenom }}</td>
                    <td>{{ $etudiant->telephone }}</td>
                    <td>{{ $etudiant->email }}</td>
                    <td class="action-buttons">
                        <a href="{{ route('etudiants.edit', $etudiant) }}" class="btn-warning">Modifier</a>
                        <form action="{{ route('etudiants.destroy', $etudiant) }}" method="POST" onsubmit="return confirm('Supprimer cet étudiant ?')">
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


