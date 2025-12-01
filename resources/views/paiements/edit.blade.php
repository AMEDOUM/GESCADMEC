@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier un Paiement</h2>

    <form action="{{ route('paiements.update', $paiement) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Inscription :</label>
            <select name="inscription_id" class="form-control">
                @foreach ($inscriptions as $inscription)
                    <option value="{{ $inscription->id }}" {{ $paiement->inscription_id == $inscription->id ? 'selected' : '' }}>
                        {{ $inscription->etudiant->nom }} {{ $inscription->etudiant->prenom }} — {{ $inscription->niveau->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Montant :</label>
            <input type="number" name="montant" class="form-control" value="{{ $paiement->montant }}" required>
        </div>

        <div class="mb-3">
            <label>Date de paiement :</label>
            <input type="date" name="date_paiement" class="form-control" value="{{ $paiement->date_paiement }}" required>
        </div>

        <div class="mb-3">
            <label>Mode de paiement :</label>
            <select name="mode_paiement" class="form-control">
                <option value="espèces" {{ $paiement->mode_paiement == 'espèces' ? 'selected' : '' }}>Espèces</option>
                <option value="mobile money" {{ $paiement->mode_paiement == 'mobile money' ? 'selected' : '' }}>Mobile Money</option>
                <option value="virement" {{ $paiement->mode_paiement == 'virement' ? 'selected' : '' }}>Virement</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
