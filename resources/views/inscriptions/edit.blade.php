@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier une inscription</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inscriptions.update', $inscription) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Étudiant :</label>
            <select name="etudiant_id" class="form-control">
                @foreach ($etudiants as $etudiant)
                    <option value="{{ $etudiant->id }}" {{ $inscription->etudiant_id == $etudiant->id ? 'selected' : '' }}>
                        {{ $etudiant->nom }} {{ $etudiant->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Niveau :</label>
            <select name="niveau_id" class="form-control">
                @foreach ($niveaux as $niveau)
                    <option value="{{ $niveau->id }}" {{ $inscription->niveau_id == $niveau->id ? 'selected' : '' }}>
                        {{ $niveau->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Montant total :</label>
            <input type="number" name="montant_total" class="form-control" value="{{ $inscription->montant_total }}">
        </div>

        <div class="mb-3">
            <label>Montant versé :</label>
            <input type="number" name="montant_paye" class="form-control" value="{{ $inscription->montant_paye }}">
        </div>

        <div class="mb-3">
            <label>Date début :</label>
            <input type="date" name="date_debut" class="form-control" value="{{ $inscription->date_debut }}">
        </div>

        <div class="mb-3">
            <label>Date fin :</label>
            <input type="date" name="date_fin" class="form-control" value="{{ $inscription->date_fin }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('inscriptions.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
