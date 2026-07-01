<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des gammes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('gammes.create') }}" class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                    Ajouter une gamme
                </a>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="w-full border border-slate-200">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Nom</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Pièce</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Responsable</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gammes as $gamme)
                            <tr>
                                <td class="border border-slate-200 p-2">{{ $gamme->nom }}</td>
                                <td class="border border-slate-200 p-2">{{ $gamme->piece->libelle ?? '-' }}</td>
                                <td class="border border-slate-200 p-2">{{ $gamme->responsable ?? '-' }}</td>
                                <td class="border border-slate-200 p-2">
                                    <a href="{{ route('gammes.edit', $gamme) }}" class="text-blue-600">
                                        Modifier
                                    </a>

                                    <a href="{{ route('gamme-operations.index', $gamme) }}" class="text-green-600 ml-2">
                                        Opérations
                                    </a>

                                    <form method="POST" action="{{ route('gammes.realiser', $gamme) }}" class="inline">
                                        @csrf

                                        <button type="submit" class="text-purple-600 ml-2"
                                            onclick="return confirm('Générer les réalisations de cette gamme ?')">
                                            Réaliser
                                        </button>
                                    </form>

                                    <form action="{{ route('gammes.destroy', $gamme) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-600 ml-2"
                                            onclick="return confirm('Supprimer cette gamme ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border p-4 text-center">
                                    Aucune gamme enregistrée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

