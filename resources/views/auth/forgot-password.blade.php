@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen items-center justify-center px-4">
    <div class="w-full max-w-md">

        {{-- Card --}}
        <div class="card bg-white/10 backdrop-blur-xl rounded-2xl p-8 shadow-xl border border-white/10 animate-fadeIn">

            <h2 class="text-2xl font-bold text-white text-center mb-6">
                🔐 Mot de passe oublié
            </h2>

            <p class="text-gray-300 text-sm text-center mb-6">
                Entrez votre adresse email et nous vous enverrons un lien de réinitialisation.
            </p>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-4">
                    <label class="form-label text-white">Adresse email</label>
                    <input type="email" name="email" required autofocus
                        class="form-control bg-white/20 text-white border-white/30 placeholder-gray-300"
                        placeholder="exemple@gmail.com">
                    @error('email')
                        <div class="text-red-400 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-primary w-full">
                    📩 Envoyer le lien
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
