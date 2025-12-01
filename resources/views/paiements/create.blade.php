@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un Paiement</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('paiements.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Inscription :</label>
            <select name="inscription_id" class="form-control" required>
                <option value="">-- Sélectionner --</option>
                @foreach ($inscriptions as $inscription)
                    <option value="{{ $inscription->id }}">
                        {{ $inscription->etudiant->nom }} {{ $inscription->etudiant->prenom }} — {{ $inscription->niveau->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Montant :</label>
            <input type="number" name="montant" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date de paiement :</label>
            <input type="date" name="date_paiement" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mode de paiement :</label>
            <select name="mode_paiement" class="form-control">
                <option value="espèces">Espèces</option>
                <option value="mobile money">Mobile Money</option>
                <option value="virement">Virement</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
