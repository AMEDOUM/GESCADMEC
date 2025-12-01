@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center py-16">

    <div class="card-dark p-8 w-full max-w-md animate-fadeIn">

        <h2 class="text-3xl font-bold mb-6 text-center text-white">
            📝 Création de compte
        </h2>

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="list-disc px-4">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nom --}}
            <div class="form-group">
                <label class="form-label text-white">Nom complet</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label text-white">Adresse email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label text-white">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            {{-- Confirm Password --}}
            <div class="form-group">
                <label class="form-label text-white">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            {{-- Submit --}}
            <button class="btn-primary w-full mt-4">
                Créer un compte
            </button>
        </form>

        <p class="text-center text-gray-300 mt-6 text-sm">
            Déjà un compte ?
            <a href="{{ route('login') }}" class="text-blue-400 hover:text-blue-300">
                Se connecter
            </a>
        </p>

    </div>

</div>
@endsection
