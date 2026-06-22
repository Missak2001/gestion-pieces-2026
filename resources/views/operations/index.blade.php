<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des opérations
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
                <a href="{{ route('operations.create') }}"
                   class="px-4 py-2 bg-blue-600 text-white rounded">
                    Ajouter une opération
                </a>
            </div>

            <div class="bg-white shadow rounded p-4">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Nom</th>
                            <th class="border p-2">Description</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($operations as $operation)
                            <tr>
                                <td class="border p-2">{{ $operation->nom }}</td>
                                <td class="border p-2">{{ $operation->description ?? '-' }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('operations.edit', $operation) }}"
                                       class="text-blue-600">
                                        Modifier
                                    </a>

                                    <form action="{{ route('operations.destroy', $operation) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 ml-2"
                                                onclick="return confirm('Supprimer cette opération ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border p-4 text-center">
                                    Aucune opération enregistrée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
