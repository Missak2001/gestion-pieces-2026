<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des postes de travail
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('postes-travail.create') }}"
               class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                Ajouter un poste
            </a>

            <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="w-full border border-slate-200">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Libellé</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($postes as $poste)
                            <tr>
                                <td class="border border-slate-200 p-2">
                                    {{ $poste->libelle }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    <a href="{{ route('postes-travail.edit', $poste) }}"
                                       class="text-blue-600">
                                        Modifier
                                    </a>

                                    <form method="POST"
                                          action="{{ route('postes-travail.destroy', $poste) }}"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 ml-2">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2"
                                    class="text-center p-4">
                                    Aucun poste.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

