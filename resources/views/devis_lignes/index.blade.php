<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Lignes du devis #{{ $devis->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm mb-6">
                <p class="mb-2">
                    <strong>Client :</strong> {{ $devis->client->nom }}
                </p>

                <p class="mb-4">
                    <strong>Date limite :</strong> {{ $devis->date_limite }}
                </p>

                <form method="POST" action="{{ route('devis-lignes.store', $devis) }}">
                    @csrf

                    <div class="mb-4">
                        <label>Pièce commercialisée</label>

                        <select name="piece_id"
                                id="piece_id"
                                class="w-full border rounded p-2">
                            @foreach($pieces as $piece)
                                <option value="{{ $piece->id }}"
                                        data-prix="{{ $piece->prix_vente }}">
                                    {{ $piece->reference }} - {{ $piece->libelle }}
                                    — {{ number_format($piece->prix_vente, 2, ',', ' ') }} €
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Quantité</label>
                        <input type="number"
                               name="quantite"
                               min="1"
                               value="1"
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Prix unitaire (€)</label>
                        <input type="number"
                               name="prix_unitaire"
                               id="prix_unitaire"
                               step="0.01"
                               min="0"
                               class="w-full border rounded p-2"
                               required>

                        <small class="text-gray-500">
                            Prix proposé automatiquement, modifiable selon le client.
                        </small>
                    </div>

                    <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                        Ajouter la ligne
                    </button>

                    <a href="{{ route('devis.index') }}" class="ml-2 text-gray-600">
                        Retour aux devis
                    </a>
                </form>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <table class="w-full border border-slate-200">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Pièce</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Quantité</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Prix unitaire figé</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Total ligne</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($devis->lignes as $ligne)
                            <tr>
                                <td class="border border-slate-200 p-2">
                                    {{ $ligne->piece->reference }} - {{ $ligne->piece->libelle }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ $ligne->quantite }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ number_format($ligne->prix_unitaire, 2, ',', ' ') }} €
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ number_format($ligne->total(), 2, ',', ' ') }} €
                                </td>

                                <td class="border border-slate-200 p-2">
                                    <form method="POST"
                                          action="{{ route('devis-lignes.destroy', $ligne) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">
                                    Aucune ligne dans ce devis.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="text-right mt-4 font-bold text-lg">
                    Total devis :
                    {{ number_format($devis->total(), 2, ',', ' ') }} €
                </div>
            </div>

        </div>
    </div>

    <script>
        function remplirPrixUnitaire() {
            const select = document.getElementById('piece_id');
            const inputPrix = document.getElementById('prix_unitaire');

            if (!select || !inputPrix) {
                return;
            }

            const option = select.options[select.selectedIndex];
            inputPrix.value = option.dataset.prix || 0;
        }

        document.addEventListener('DOMContentLoaded', remplirPrixUnitaire);

        document.getElementById('piece_id')
            ?.addEventListener('change', remplirPrixUnitaire);
    </script>
</x-app-layout>

