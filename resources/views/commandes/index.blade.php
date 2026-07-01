<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Commandes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('commandes.create') }}" class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                Nouvelle commande
            </a>

            <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="w-full border border-slate-200">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">ID</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Client</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Date commande</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Total</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($commandes as $commande)
                            <tr>
                                <td class="border border-slate-200 p-2">{{ $commande->id }}</td>
                                <td class="border border-slate-200 p-2">{{ $commande->client->nom }}</td>
                                <td class="border border-slate-200 p-2">{{ $commande->date_commande }}</td>
                                <td class="border border-slate-200 p-2">
                                    {{ number_format($commande->total(), 2, ',', ' ') }} €
                                </td>
                                <td class="border border-slate-200 p-2">

                                    <a href="{{ route('factures.show', $commande) }}" class="text-blue-600 mr-3">
                                        Facture PDF
                                    </a>

                                    <form method="POST" action="{{ route('commandes.destroy', $commande) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600"
                                            onclick="return confirm('Supprimer cette commande ?')">
                                            Supprimer
                                        </button>
                                    </form>

                                </td>
                            </tr>

                            <tr>
                                <td colspan="5" class="border p-2 bg-gray-50">
                                    <strong>Lignes :</strong>

                                    <ul class="list-disc ml-6 mt-2">
                                        @foreach ($commande->lignes as $ligne)
                                            <li>
                                                {{ $ligne->piece->reference }} -
                                                {{ $ligne->piece->libelle }}
                                                | Quantité : {{ $ligne->quantite }}
                                                | Prix : {{ number_format($ligne->prix_unitaire, 2, ',', ' ') }} €
                                                | Total : {{ number_format($ligne->total(), 2, ',', ' ') }} €
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">
                                    Aucune commande.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

