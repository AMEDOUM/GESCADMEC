@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen items-center justify-center px-4">
    <div class="w-full max-w-md">

        <div class="card bg-white/10 backdrop-blur-xl rounded-2xl p-8 shadow-xl border border-white/10 animate-fadeIn">

            <h2 class="text-2xl font-bold text-white text-center mb-6">
                📩 Vérifiez votre email
            </h2>

            <p class="text-gray-300 text-sm text-center mb-6 leading-relaxed">
                Un lien de réinitialisation de mot de passe vient d’être envoyé à votre adresse email.<br>
                Cliquez dessus pour réinitialiser votre mot de passe.
            </p>

            {{-- Message de succès --}}
            @if (session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Bouton renvoi email --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-primary w-full">
                    🔁 Renvoyer l’email
                </button>
            </form>

            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-blue-300 hover:text-blue-400">
                    ⬅ Retour à la connexion
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
