<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des pièces
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('pieces.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                    Ajouter une pièce
                </a>
            </div>

            <div class="bg-white shadow rounded p-4">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Référence</th>
                            <th class="border p-2">Libellé</th>
                            <th class="border p-2">Type</th>
                            <th class="border p-2">Stock</th>
                            <th class="border p-2">Prix vente</th>
                            <th class="border p-2">Prix catalogue</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pieces as $piece)
                            <tr>
                                <td class="border p-2">{{ $piece->reference }}</td>
                                <td class="border p-2">{{ $piece->libelle }}</td>
                                <td class="border p-2">{{ $piece->typePiece->libelle ?? '-' }}</td>
                                <td class="border p-2">{{ $piece->stock }}</td>
                                <td class="border p-2">{{ $piece->prix_vente ?? '-' }}</td>
                                <td class="border p-2">{{ $piece->prix_catalogue ?? '-' }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('pieces.edit', $piece) }}" class="text-blue-600">
                                        Modifier
                                    </a>

                                    @if (($piece->typePiece->libelle ?? '') !== 'Matière Première')
                                        <a href="{{ route('compositions.index', $piece) }}" class="text-green-600 ml-2">
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
