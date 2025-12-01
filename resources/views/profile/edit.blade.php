<x-app-layout>
    <h1 class="text-xl font-bold">Mon Profil</h1>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <label>Nom :</label>
        <input type="text" name="name" value="{{ auth()->user()->name }}" class="border p-2">

        <button class="bg-blue-500 text-white px-4 py-2 mt-2">Mettre à jour</button>
    </form>
</x-app-layout>
