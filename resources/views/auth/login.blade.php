@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center py-16">

    <div class="card-dark p-8 w-full max-w-md animate-fadeIn">

        <h2 class="text-3xl font-bold mb-6 text-center text-white">
            🔐 Connexion
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

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label class="form-label text-white">Adresse email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label class="form-label text-white">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            {{-- Remember --}}
            <div class="flex items-center mb-4 gap-2">
                <input type="checkbox" name="remember" class="rounded">
                <span class="text-sm text-gray-300">Se souvenir de moi</span>
            </div>

            {{-- Submit --}}
            <button class="btn-primary w-full">
                Se connecter
            </button>
        </form>

        <p class="text-center text-gray-300 mt-6 text-sm">
            Pas de compte ?
            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300">
                Créer un compte
            </a>
        </p>

    </div>

</div>
@endsection
