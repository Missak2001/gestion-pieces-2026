@php
    $isAdmin = auth()->user()->hasRole('admin');
    $isAtelier = auth()->user()->hasRole('atelier');
    $isCommercial = auth()->user()->hasRole('commercial');
    $isCompta = auth()->user()->hasRole('comptabilite');
@endphp

<nav x-data="{ open: false }" class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/85 backdrop-blur">

    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="flex h-16 justify-between">

            <div class="flex">

                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('dashboard') }}">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-cyan-700 text-white shadow-sm shadow-cyan-900/20">
                            <x-application-logo class="h-5 w-5 fill-current" />
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden gap-1 sm:ms-10 sm:flex sm:items-center">

                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>

                    @if ($isAdmin)
                        <div class="relative" x-data="{ openMenu: false }" @click.outside="openMenu = false">
                            <button @click="openMenu = !openMenu" class="inline-flex items-center gap-1 rounded-lg border border-transparent px-3 py-2 text-sm font-medium text-slate-600 transition hover:border-slate-200 hover:bg-slate-50 hover:text-slate-900">
                                Production
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 011.08 1.04l-4.25 4.51a.75.75 0 01-1.08 0l-4.25-4.51a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="openMenu" x-transition class="absolute left-0 z-50 mt-2 w-60 rounded-xl border border-slate-200 bg-white p-2 shadow-lg" style="display: none;">
                                <x-dropdown-link :href="route('pieces.index')">Pièces</x-dropdown-link>
                                <x-dropdown-link :href="route('gammes.index')">Gammes</x-dropdown-link>
                                <x-dropdown-link :href="route('operations.index')">Opérations</x-dropdown-link>
                                <x-dropdown-link :href="route('postes-travail.index')">Postes de travail</x-dropdown-link>
                                <x-dropdown-link :href="route('machines.index')">Machines</x-dropdown-link>
                                <x-dropdown-link :href="route('compatibilites.index')">Compatibilités</x-dropdown-link>
                                <x-dropdown-link :href="route('qualifications.index')">Qualifications</x-dropdown-link>
                                <x-dropdown-link :href="route('realisations.index')">Réalisations</x-dropdown-link>
                            </div>
                        </div>

                        <div class="relative" x-data="{ openMenu: false }" @click.outside="openMenu = false">
                            <button @click="openMenu = !openMenu" class="inline-flex items-center gap-1 rounded-lg border border-transparent px-3 py-2 text-sm font-medium text-slate-600 transition hover:border-slate-200 hover:bg-slate-50 hover:text-slate-900">
                                Commercial
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 011.08 1.04l-4.25 4.51a.75.75 0 01-1.08 0l-4.25-4.51a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="openMenu" x-transition class="absolute left-0 z-50 mt-2 w-56 rounded-xl border border-slate-200 bg-white p-2 shadow-lg" style="display: none;">
                                <x-dropdown-link :href="route('clients.index')">Clients</x-dropdown-link>
                                <x-dropdown-link :href="route('devis.index')">Devis</x-dropdown-link>
                                <x-dropdown-link :href="route('commandes.index')">Commandes</x-dropdown-link>
                            </div>
                        </div>

                        <div class="relative" x-data="{ openMenu: false }" @click.outside="openMenu = false">
                            <button @click="openMenu = !openMenu" class="inline-flex items-center gap-1 rounded-lg border border-transparent px-3 py-2 text-sm font-medium text-slate-600 transition hover:border-slate-200 hover:bg-slate-50 hover:text-slate-900">
                                Achats
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 011.08 1.04l-4.25 4.51a.75.75 0 01-1.08 0l-4.25-4.51a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="openMenu" x-transition class="absolute left-0 z-50 mt-2 w-56 rounded-xl border border-slate-200 bg-white p-2 shadow-lg" style="display: none;">
                                <x-dropdown-link :href="route('fournisseurs.index')">Fournisseurs</x-dropdown-link>
                                <x-dropdown-link :href="route('achats.index')">Commandes fournisseurs</x-dropdown-link>
                            </div>
                        </div>

                        <div class="relative" x-data="{ openMenu: false }" @click.outside="openMenu = false">
                            <button @click="openMenu = !openMenu" class="inline-flex items-center gap-1 rounded-lg border border-transparent px-3 py-2 text-sm font-medium text-slate-600 transition hover:border-slate-200 hover:bg-slate-50 hover:text-slate-900">
                                Administration
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 011.08 1.04l-4.25 4.51a.75.75 0 01-1.08 0l-4.25-4.51a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="openMenu" x-transition class="absolute left-0 z-50 mt-2 w-56 rounded-xl border border-slate-200 bg-white p-2 shadow-lg" style="display: none;">
                                <x-dropdown-link :href="route('users.roles')">Utilisateurs & rôles</x-dropdown-link>
                            </div>
                        </div>
                    @else
                        @if ($isAtelier)
                            <x-nav-link :href="route('pieces.index')" :active="request()->routeIs('pieces.*')">Pièces</x-nav-link>
                            <x-nav-link :href="route('gammes.index')" :active="request()->routeIs('gammes.*')">Gammes</x-nav-link>
                            <x-nav-link :href="route('operations.index')" :active="request()->routeIs('operations.*')">Opérations</x-nav-link>
                            <x-nav-link :href="route('postes-travail.index')" :active="request()->routeIs('postes-travail.*')">Postes</x-nav-link>
                            <x-nav-link :href="route('machines.index')" :active="request()->routeIs('machines.*')">Machines</x-nav-link>
                            <x-nav-link :href="route('compatibilites.index')" :active="request()->routeIs('compatibilites.*')">Compatibilités</x-nav-link>
                            <x-nav-link :href="route('qualifications.index')" :active="request()->routeIs('qualifications.*')">Qualifications</x-nav-link>
                            <x-nav-link :href="route('realisations.index')" :active="request()->routeIs('realisations.*')">Réalisations</x-nav-link>
                        @endif

                        @if ($isCommercial)
                            <x-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">Clients</x-nav-link>
                            <x-nav-link :href="route('devis.index')" :active="request()->routeIs('devis.*')">Devis</x-nav-link>
                            <x-nav-link :href="route('commandes.index')" :active="request()->routeIs('commandes.*')">Commandes</x-nav-link>
                        @endif

                        @if ($isCompta)
                            <x-nav-link :href="route('fournisseurs.index')" :active="request()->routeIs('fournisseurs.*')">Fournisseurs</x-nav-link>
                            <x-nav-link :href="route('achats.index')" :active="request()->routeIs('achats.*')">Achats</x-nav-link>
                        @endif
                    @endif

                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:ms-6 sm:flex sm:items-center">

                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button
                            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium leading-4 text-slate-600 transition hover:border-cyan-200 hover:text-slate-900 focus:outline-none">

                            <div>{{ Auth::user()->name }}</div>

                            <div>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">

                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />

                                </svg>
                            </div>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <x-dropdown-link :href="route('profile.edit')">
                            Profil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                         this.closest('form').submit();">
                                Déconnexion
                            </x-dropdown-link>

                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center rounded-lg p-2 text-slate-500 transition hover:bg-slate-100 hover:text-slate-700 focus:outline-none">

                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">

                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />

                    </svg>

                </button>

            </div>

        </div>

    </div>

    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden border-t border-slate-200 bg-white sm:hidden">
        <div class="space-y-2 px-3 pb-3 pt-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            @if ($isAdmin)
                <div x-data="{ subOpen: false }" class="rounded-lg border border-slate-200">
                    <button @click="subOpen = !subOpen" class="flex w-full items-center justify-between px-3 py-2 text-left text-sm font-semibold text-slate-700">
                        Production
                        <span x-text="subOpen ? '−' : '+'"></span>
                    </button>
                    <div x-show="subOpen" x-transition class="space-y-1 border-t border-slate-200 px-2 py-2" style="display: none;">
                        <x-responsive-nav-link :href="route('pieces.index')" :active="request()->routeIs('pieces.*')">Pièces</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('gammes.index')" :active="request()->routeIs('gammes.*')">Gammes</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('operations.index')" :active="request()->routeIs('operations.*')">Opérations</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('postes-travail.index')" :active="request()->routeIs('postes-travail.*')">Postes de travail</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('machines.index')" :active="request()->routeIs('machines.*')">Machines</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('compatibilites.index')" :active="request()->routeIs('compatibilites.*')">Compatibilités</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('qualifications.index')" :active="request()->routeIs('qualifications.*')">Qualifications</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('realisations.index')" :active="request()->routeIs('realisations.*')">Réalisations</x-responsive-nav-link>
                    </div>
                </div>

                <div x-data="{ subOpen: false }" class="rounded-lg border border-slate-200">
                    <button @click="subOpen = !subOpen" class="flex w-full items-center justify-between px-3 py-2 text-left text-sm font-semibold text-slate-700">
                        Commercial
                        <span x-text="subOpen ? '−' : '+'"></span>
                    </button>
                    <div x-show="subOpen" x-transition class="space-y-1 border-t border-slate-200 px-2 py-2" style="display: none;">
                        <x-responsive-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">Clients</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('devis.index')" :active="request()->routeIs('devis.*')">Devis</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('commandes.index')" :active="request()->routeIs('commandes.*')">Commandes</x-responsive-nav-link>
                    </div>
                </div>

                <div x-data="{ subOpen: false }" class="rounded-lg border border-slate-200">
                    <button @click="subOpen = !subOpen" class="flex w-full items-center justify-between px-3 py-2 text-left text-sm font-semibold text-slate-700">
                        Achats
                        <span x-text="subOpen ? '−' : '+'"></span>
                    </button>
                    <div x-show="subOpen" x-transition class="space-y-1 border-t border-slate-200 px-2 py-2" style="display: none;">
                        <x-responsive-nav-link :href="route('fournisseurs.index')" :active="request()->routeIs('fournisseurs.*')">Fournisseurs</x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('achats.index')" :active="request()->routeIs('achats.*')">Commandes fournisseurs</x-responsive-nav-link>
                    </div>
                </div>

                <div x-data="{ subOpen: false }" class="rounded-lg border border-slate-200">
                    <button @click="subOpen = !subOpen" class="flex w-full items-center justify-between px-3 py-2 text-left text-sm font-semibold text-slate-700">
                        Administration
                        <span x-text="subOpen ? '−' : '+'"></span>
                    </button>
                    <div x-show="subOpen" x-transition class="space-y-1 border-t border-slate-200 px-2 py-2" style="display: none;">
                        <x-responsive-nav-link :href="route('users.roles')" :active="request()->routeIs('users.roles')">Utilisateurs & rôles</x-responsive-nav-link>
                    </div>
                </div>
            @else
                @if ($isAtelier)
                    <x-responsive-nav-link :href="route('pieces.index')" :active="request()->routeIs('pieces.*')">Pièces</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('gammes.index')" :active="request()->routeIs('gammes.*')">Gammes</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('operations.index')" :active="request()->routeIs('operations.*')">Opérations</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('postes-travail.index')" :active="request()->routeIs('postes-travail.*')">Postes de travail</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('machines.index')" :active="request()->routeIs('machines.*')">Machines</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('compatibilites.index')" :active="request()->routeIs('compatibilites.*')">Compatibilités</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('qualifications.index')" :active="request()->routeIs('qualifications.*')">Qualifications</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('realisations.index')" :active="request()->routeIs('realisations.*')">Réalisations</x-responsive-nav-link>
                @endif

                @if ($isCommercial)
                    <x-responsive-nav-link :href="route('clients.index')" :active="request()->routeIs('clients.*')">Clients</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('devis.index')" :active="request()->routeIs('devis.*')">Devis</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('commandes.index')" :active="request()->routeIs('commandes.*')">Commandes</x-responsive-nav-link>
                @endif

                @if ($isCompta)
                    <x-responsive-nav-link :href="route('fournisseurs.index')" :active="request()->routeIs('fournisseurs.*')">Fournisseurs</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('achats.index')" :active="request()->routeIs('achats.*')">Achats</x-responsive-nav-link>
                @endif
            @endif
        </div>

        <div class="border-t border-slate-200 px-4 py-3">
            <div class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</div>
            <div class="mt-2 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                    Profil
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Déconnexion
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>

</nav>
