<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Devis
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('devis.create') }}" class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                Nouveau devis
            </a>

            <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="w-full border border-slate-200">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">ID</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Client</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Date devis</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Date limite</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Total</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($devis as $devisItem)
                            <tr>
                                <td class="border border-slate-200 p-2">{{ $devisItem->id }}</td>
                                <td class="border border-slate-200 p-2">{{ $devisItem->client->nom }}</td>
                                <td class="border border-slate-200 p-2">{{ $devisItem->date_devis }}</td>
                                <td class="border border-slate-200 p-2">{{ $devisItem->date_limite }}</td>

                                <td class="border border-slate-200 p-2">
                                    {{ number_format($devisItem->total(), 2, ',', ' ') }} €
                                </td>

                                <td class="border border-slate-200 p-2">
                                    <a href="{{ route('devis-lignes.index', $devisItem) }}"
                                       class="text-green-600 mr-3">
                                        Lignes
                                    </a>

                                    <form method="POST"
                                          action="{{ route('devis.destroy.custom', $devisItem->id) }}"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-600 ml-2"
                                                onclick="return confirm('Voulez-vous vraiment supprimer le devis n°{{ $devisItem->id }} ?')">
                                            Supprimer #{{ $devisItem->id }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-4">
                                    Aucun devis.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

