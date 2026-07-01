<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Lignes de la commande fournisseur #{{ $achat->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded shadow p-6 mb-6">

                <h3 class="font-bold mb-4">
                    Ajouter une pièce
                </h3>

                <form method="POST"
                      action="{{ route('achat-lignes.store', $achat) }}">

                    @csrf

                    <div class="mb-4">
                        <label>Pièce</label>

                        <select name="piece_id"
                                class="w-full border rounded p-2">

                            @foreach($pieces as $piece)

                                <option value="{{ $piece->id }}">
                                    {{ $piece->reference }}
                                    -
                                    {{ $piece->libelle }}
                                </option>

                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Quantité</label>

                        <input type="number"
                               name="quantite"
                               min="1"
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Prix d'achat</label>

                        <input type="number"
                               step="0.01"
                               name="prix_achat"
                               class="w-full border rounded p-2">
                    </div>

                    <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                        Ajouter
                    </button>

                </form>

            </div>

            <div class="bg-white rounded shadow p-4">

                <table class="w-full border border-slate-200">

                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Pièce</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Quantité</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Prix</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Total</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($achat->lignes as $ligne)

                        <tr>

                            <td class="border border-slate-200 p-2">
                                {{ $ligne->piece->libelle }}
                            </td>

                            <td class="border border-slate-200 p-2">
                                {{ $ligne->quantite }}
                            </td>

                            <td class="border border-slate-200 p-2">
                                {{ number_format($ligne->prix_achat,2,',',' ') }} €
                            </td>

                            <td class="border border-slate-200 p-2">
                                {{ number_format($ligne->total(),2,',',' ') }} €
                            </td>

                            <td class="border border-slate-200 p-2">

                                <form method="POST"
                                      action="{{ route('achat-lignes.destroy',$ligne) }}">

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
                            <td colspan="5"
                                class="text-center p-4">
                                Aucune ligne.
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

                <div class="mt-6 text-right text-lg font-bold">
                    Total :
                    {{ number_format($achat->total(),2,',',' ') }} €
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

