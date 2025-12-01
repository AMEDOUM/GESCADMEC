@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nouvelle inscription</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oups !</strong> Corrige les erreurs ci-dessous :
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inscriptions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Étudiant :</label>
            <select name="etudiant_id" class="form-control" required>
                <option value="">-- Sélectionner --</option>
                @foreach ($etudiants as $etudiant)
                    <option value="{{ $etudiant->id }}">{{ $etudiant->nom }} {{ $etudiant->prenom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Niveau :</label>
            <select name="niveau_id" class="form-control" required>
                <option value="">-- Sélectionner --</option>

                @foreach ($niveaux as $niveau)
                    <option value="{{ $niveau->id }}">{{ $niveau->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Montant total :</label>
            <input type="number" name="montant_total" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Montant versé :</label>
            <input type="number" name="montant_paye" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date début :</label>
            <input type="date" name="date_debut" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date fin :</label>
            <input type="date" name="date_fin" class="form-control" required>
        </div>

        <button type="submit" class="btn-primary">Enregistrer</button>
        <a href="{{ route('inscriptions.index') }}" class="btn-gray">Annuler</a>
    </form>
</div>
@endsection
