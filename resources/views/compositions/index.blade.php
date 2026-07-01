<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Composition : {{ $piece->libelle }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm mb-6">

                <form method="POST" action="{{ route('compositions.store', $piece) }}">
                    @csrf

                    <div class="mb-4">
                        <label>Pièce composante</label>

                        <select name="piece_enfant_id" class="w-full border rounded p-2">
                            @foreach($pieces as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->reference }} - {{ $p->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Quantité</label>

                        <input type="number"
                               name="quantite"
                               value="1"
                               min="1"
                               class="w-full border rounded p-2">
                    </div>

                    <button type="submit"
                            class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                        Ajouter
                    </button>

                </form>

            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <table class="w-full border border-slate-200">
                    <thead>
                        <tr>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Composant</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Quantité</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($compositions as $composition)

                        <tr>
                            <td class="border border-slate-200 p-2">
                                {{ $composition->pieceEnfant->libelle }}
                            </td>

                            <td class="border border-slate-200 p-2">
                                {{ $composition->quantite }}
                            </td>

                            <td class="border border-slate-200 p-2">

                                <form method="POST"
                                      action="{{ route('compositions.destroy', $composition) }}">
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
                            <td colspan="3" class="text-center p-4">
                                Aucun composant
                            </td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>

