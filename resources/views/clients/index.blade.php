<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des clients
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('clients.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Nouveau client
            </a>

            <div class="bg-white p-4 rounded shadow mt-4">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Nom</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Téléphone</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($clients as $client)
                            <tr>
                                <td class="border p-2">{{ $client->nom }}</td>
                                <td class="border p-2">{{ $client->email }}</td>
                                <td class="border p-2">{{ $client->telephone }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('clients.edit', $client) }}">
                                        Modifier
                                    </a>

                                    <form method="POST"
                                          action="{{ route('clients.destroy', $client) }}"
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
                                <td colspan="4" class="text-center p-4">
                                    Aucun client enregistré.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
