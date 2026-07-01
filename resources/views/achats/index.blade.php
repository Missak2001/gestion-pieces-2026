<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Commandes fournisseurs
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('achats.create') }}" class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                Nouvelle commande fournisseur
            </a>

            <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="w-full border border-slate-200">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">ID</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Fournisseur</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Commande</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Livraison prévue</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Livraison réelle</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Total</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($achats as $achat)
                            <tr>
                                <td class="border border-slate-200 p-2">{{ $achat->id }}</td>
                                <td class="border border-slate-200 p-2">{{ $achat->fournisseur->nom }}</td>
                                <td class="border border-slate-200 p-2">{{ $achat->date_commande }}</td>
                                <td class="border border-slate-200 p-2">{{ $achat->date_livraison_prevue }}</td>
                                <td class="border border-slate-200 p-2">{{ $achat->date_livraison_reelle ?? '-' }}</td>
                                <td class="border border-slate-200 p-2">
                                    {{ number_format($achat->total(), 2, ',', ' ') }} €
                                </td>

                                <td class="border border-slate-200 p-2">
                                    @if($achat->date_livraison_reelle)
                                        <span class="text-green-600 font-bold">
                                            Réceptionnée
                                        </span>
                                    @else
                                        <form method="POST"
                                              action="{{ route('achats.reception', $achat) }}"
                                              class="inline">
                                            @csrf

                                            <button class="text-blue-600 mr-3"
                                                    onclick="return confirm('Réceptionner cette commande ?')">
                                                Réceptionner
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('achat-lignes.index', $achat) }}"
                                       class="text-green-600 ml-3">
                                        Lignes
                                    </a>

                                    <form method="POST"
                                          action="{{ route('achats.destroy', $achat) }}"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 ml-3">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-4">
                                    Aucune commande fournisseur.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

