@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier un étudiant</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Oups !</strong> Il y a des erreurs dans le formulaire :<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form action="{{ route('etudiants.update', $etudiant) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom :</label>
            <input type="text" name="nom" class="form-control" value="{{ $etudiant->nom }}" required>
        </div>
        <div class="mb-3">
            <label>Prénom :</label>
            <input type="text" name="prenom" class="form-control" value="{{ $etudiant->prenom }}" required>
        </div>
        <div class="mb-3">
            <label>Téléphone :</label>
            <input type="text" name="telephone" class="form-control" value="{{ $etudiant->telephone }}" required>
        </div>
        <div class="mb-3">
            <label>Email :</label>
            <input type="email" name="email" class="form-control" value="{{ $etudiant->email }}">
        </div>
        <div class="mb-3">
            <label>Date de naissance :</label>
            <input type="date" name="date_naissance" class="form-control" value="{{ $etudiant->date_naissance }}">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
