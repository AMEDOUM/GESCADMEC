<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'PRIMA ACADEMIE') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>


<body class="font-sans antialiased bg-[var(--bg)] text-[var(--text-dark)]">

<div class="flex min-h-screen">

    {{-- SIDEBAR PRO --}}
    @include('layouts.navigation')

    {{-- CONTENU --}}
    <main class="flex-1 p-10 overflow-y-auto fade-in">
        @yield('content')
    </main>

</div>

</body>
</html>
