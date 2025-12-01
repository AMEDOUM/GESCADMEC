@extends('layouts.app')

@section('content')
<div class="animate-fadeIn">
    <h1 class="text-3xl font-bold mb-6">Ajouter un besoin</h1>

    <div class="card p-6">
        <form method="POST" action="{{ route('besoins.store') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Étudiant :</label>
                <select name="etudiant_id" class="form-control">
                    @foreach ($etudiants as $etudiant)
                        <option value="{{ $etudiant->id }}">{{ $etudiant->nom }} {{ $etudiant->prenoms }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Description :</label>
                <input type="text" name="description" class="form-control" required>
            </div>

            <button class="btn-primary">Enregistrer</button>
        </form>
    </div>
</div>
@endsection
