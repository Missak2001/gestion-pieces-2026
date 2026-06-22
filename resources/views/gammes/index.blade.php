<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des gammes
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
                <a href="{{ route('gammes.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                    Ajouter une gamme
                </a>
            </div>

            <div class="bg-white shadow rounded p-4">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Nom</th>
                            <th class="border p-2">Pièce</th>
                            <th class="border p-2">Responsable</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($gammes as $gamme)
                            <tr>
                                <td class="border p-2">{{ $gamme->nom }}</td>
                                <td class="border p-2">{{ $gamme->piece->libelle ?? '-' }}</td>
                                <td class="border p-2">{{ $gamme->responsable ?? '-' }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('gammes.edit', $gamme) }}" class="text-blue-600">
                                        Modifier
                                    </a>
                                    <a href="{{ route('gamme-operations.index', $gamme) }}" class="text-green-600 ml-2">
                                        Opérations
                                    </a>

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
