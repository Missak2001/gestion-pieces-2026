<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Devis
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('devis.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Nouveau devis
            </a>

            <div class="bg-white p-4 rounded shadow mt-4">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Client</th>
                            <th class="border p-2">Date devis</th>
                            <th class="border p-2">Date limite</th>
                            <th class="border p-2">Total</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($devis as $devisItem)
                            <tr>
                                <td class="border p-2">{{ $devisItem->id }}</td>
                                <td class="border p-2">{{ $devisItem->client->nom }}</td>
                                <td class="border p-2">{{ $devisItem->date_devis }}</td>
                                <td class="border p-2">{{ $devisItem->date_limite }}</td>

                                <td class="border p-2">
                                    {{ number_format($devisItem->total(), 2, ',', ' ') }} €
                                </td>

                                <td class="border p-2">
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
