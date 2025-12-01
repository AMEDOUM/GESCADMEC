
<div class="w-64 bg-slate-900 text-slate-200 flex flex-col min-h-screen border-r border-slate-800">

    {{-- LOGO --}}
    <div class="px-6 py-6 flex items-center gap-3 border-b border-slate-800">
        <img src="images/logo.png" alt="Logo" class="w-10 h-10 rounded-lg object-cover shadow-md" width="200" height=auto >
        <h1 class="text-xl font-bold tracking-wide">GESCADMEC</h1>
    </div>

    {{-- MENU --}}
    <nav class="flex-1 px-4 py-6 space-y-1">

        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 3v18h18V3H3zm9 14a4 4 0 100-8 4 4 0 000 8z" />
            </svg>
            Dashboard
        </a>

        <a href="{{ route('etudiants.index') }}"
           class="nav-link {{ request()->routeIs('etudiants.*') ? 'active' : '' }}">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
              <path d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 8a7 7 0 0114 0H5z" />
           </svg>
           Étudiants
        </a>

        <a href="{{ route('inscriptions.index') }}"
           class="nav-link {{ request()->routeIs('inscriptions.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 4h16v2H4zm0 4h16v12H4z"/>
            </svg>
            Inscriptions
        </a>

        <a href="{{ route('paiements.index') }}"
           class="nav-link {{ request()->routeIs('paiements.*') ? 'active' : '' }}">
           <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-5 w-5" viewBox="0 0 24 24">
              <path d="M2 7h20v10H2z"/>
           </svg>
           Paiements
        </a>

        <a href="{{ route('besoins.index') }}"
           class="nav-link {{ request()->routeIs('besoins.*') ? 'active' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M4 4h16v16H4z"/>
            </svg>
            Besoins
        </a>

    </nav>


    <form method="POST" action="{{ route('logout') }}" class="mt-auto">
        @csrf
        <button type="submit" class="w-full px-6 py-4 bg-slate-800 hover:bg-red-600 transition flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 16l4-4m0 0l-4-4m4 4H7"/>
            </svg>
            Déconnexion
        </button>
    </form>
</div>
