<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des pièces
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
                <a href="{{ route('pieces.create') }}"
                    class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                    Ajouter une pièce
                </a>
            </div>

            <div class="mb-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <form method="GET" action="{{ route('pieces.index') }}" class="flex flex-wrap gap-3 items-end">

                    <div class="flex-1 min-w-64">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            Rechercher
                        </label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Référence ou libellé..."
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-cyan-600 focus:ring-cyan-600">
                    </div>

                    <div class="min-w-64">
                        <label class="block text-sm font-semibold text-slate-700 mb-1">
                            Type de pièce
                        </label>
                        <select name="type_piece_id"
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-cyan-600 focus:ring-cyan-600">
                            <option value="">Tous les types</option>

                            @foreach ($types as $type)
                                <option value="{{ $type->id }}"
                                    {{ request('type_piece_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button
                        class="rounded-xl bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm hover:bg-cyan-800">
                        Filtrer
                    </button>

                    <a href="{{ route('pieces.index') }}"
                        class="rounded-xl border border-slate-300 px-4 py-2 font-semibold text-slate-700 hover:bg-slate-100">
                        Réinitialiser
                    </a>
                </form>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="w-full border border-slate-200">
                    <thead>
                        <tr class="bg-slate-100">
                            <th
                                class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">
                                Référence</th>
                            <th
                                class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">
                                Libellé</th>
                            <th
                                class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">
                                Type</th>
                            <th
                                class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">
                                Stock</th>
                            <th
                                class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">
                                Prix vente</th>
                            <th
                                class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">
                                Prix catalogue</th>
                            <th
                                class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pieces as $piece)
                            <tr>
                                <td class="border border-slate-200 p-2 text-left">{{ $piece->reference }}</td>
                                <td class="border border-slate-200 p-2 text-left">{{ $piece->libelle }}</td>
                                <td class="border border-slate-200 p-2 text-left">{{ $piece->typePiece->libelle ?? '-' }}</td>
                                <td class="border border-slate-200 p-2 text-right">{{ $piece->stock }}</td>
                                <td class="border border-slate-200 p-2 text-right">{{ $piece->prix_vente ?? '-' }}</td>
                                <td class="border border-slate-200 p-2 text-right">{{ $piece->prix_catalogue ?? '-' }}</td>
                                <td class="border border-slate-200 p-2">
                                    <a href="{{ route('pieces.edit', $piece) }}" class="text-blue-600">
                                        Modifier
                                    </a>

                                    @if (($piece->typePiece->libelle ?? '') !== 'Matière Première')
                                        <a href="{{ route('compositions.index', $piece) }}"
                                            class="text-green-600 ml-2">
                                            Composition
                                        </a>
                                    @endif

                                    <form action="{{ route('pieces.destroy', $piece) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 ml-2"
                                            onclick="return confirm('Supprimer cette pièce ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border p-4 text-center">
                                    Aucune pièce enregistrée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
