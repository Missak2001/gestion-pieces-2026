<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium text-slate-500">Bienvenue</p>
                <p class="mt-1 text-2xl font-semibold tracking-tight text-slate-900">{{ __("Vous etes connecte.") }}</p>
                <p class="mt-2 text-sm text-slate-600">Utilisez les raccourcis ci-dessous pour acceder rapidement aux modules principaux.</p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <a href="{{ route('pieces.index') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-cyan-200 hover:shadow">
                    <p class="text-sm font-semibold text-slate-500">Production</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">Pieces</p>
                    <p class="mt-1 text-sm text-slate-600">Gestion du catalogue</p>
                </a>

                <a href="{{ route('clients.index') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-cyan-200 hover:shadow">
                    <p class="text-sm font-semibold text-slate-500">Commercial</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">Clients</p>
                    <p class="mt-1 text-sm text-slate-600">Suivi des comptes clients</p>
                </a>

                <a href="{{ route('devis.index') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-cyan-200 hover:shadow">
                    <p class="text-sm font-semibold text-slate-500">Vente</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">Devis</p>
                    <p class="mt-1 text-sm text-slate-600">Preparation et suivi</p>
                </a>

                <a href="{{ route('achats.index') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-cyan-200 hover:shadow">
                    <p class="text-sm font-semibold text-slate-500">Approvisionnement</p>
                    <p class="mt-2 text-lg font-semibold text-slate-900">Achats</p>
                    <p class="mt-1 text-sm text-slate-600">Commandes fournisseurs</p>
                </a>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-semibold text-slate-700">Astuce</p>
                <p class="mt-2 text-sm text-slate-600">Le menu adapte automatiquement les modules visibles selon votre role. Les boutons d'action et les tableaux ont ete harmonises sur l'ensemble des pages.</p>
            </div>
        </div>
    </div>
</x-app-layout>
