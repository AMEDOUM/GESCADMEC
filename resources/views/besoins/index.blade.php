@extends('layouts.app')

@section('content')
<div class="animate-fadeIn">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">Gestion des besoins étudiants</h1>
        <a href="{{ route('besoins.create') }}" class="btn-primary">+ Nouveau besoin</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="card p-4">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Description</th>
                    <th>État</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($besoins as $besoin)
                <tr>
                    <td>{{ $besoin->etudiant->nom }} {{ $besoin->etudiant->prenoms }}</td>
                    <td>{{ $besoin->description }}</td>
                    <td>
                        <span class="badge {{ $besoin->etat == 'validé' ? 'badge-success' : ($besoin->etat == 'refusé' ? 'badge-danger' : 'badge-warning') }}">
                            {{ ucfirst($besoin->etat) }}
                        </span>
                    </td>

                    <td>
                        <form action="{{ route('besoins.update', $besoin) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <select name="etat" class="form-control" onchange="this.form.submit()">
                                <option value="en attente" {{ $besoin->etat == 'en attente' ? 'selected' : '' }}>En attente</option>
                                <option value="validé" {{ $besoin->etat == 'validé' ? 'selected' : '' }}>Validé</option>
                                <option value="refusé" {{ $besoin->etat == 'refusé' ? 'selected' : '' }}>Refusé</option>
                            </select>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
