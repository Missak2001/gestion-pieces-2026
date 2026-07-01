<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Commandes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('commandes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Nouvelle commande
            </a>

            <div class="bg-white p-4 rounded shadow mt-4">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Client</th>
                            <th class="border p-2">Date commande</th>
                            <th class="border p-2">Total</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($commandes as $commande)
                            <tr>
                                <td class="border p-2">{{ $commande->id }}</td>
                                <td class="border p-2">{{ $commande->client->nom }}</td>
                                <td class="border p-2">{{ $commande->date_commande }}</td>
                                <td class="border p-2">
                                    {{ number_format($commande->total(), 2, ',', ' ') }} €
                                </td>
                                <td class="border p-2">

                                    <a href="{{ route('factures.show', $commande) }}" class="text-blue-600 mr-3">
                                        Facture PDF
                                    </a>

                                    <form method="POST" action="{{ route('commandes.destroy', $commande) }}"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600"
                                            onclick="return confirm('Supprimer cette commande ?')">
                                            Supprimer
                                        </button>
                                    </form>

                                </td>
                            </tr>

                            <tr>
                                <td colspan="5" class="border p-2 bg-gray-50">
                                    <strong>Lignes :</strong>

                                    <ul class="list-disc ml-6 mt-2">
                                        @foreach ($commande->lignes as $ligne)
                                            <li>
                                                {{ $ligne->piece->reference }} -
                                                {{ $ligne->piece->libelle }}
                                                | Quantité : {{ $ligne->quantite }}
                                                | Prix : {{ number_format($ligne->prix_unitaire, 2, ',', ' ') }} €
                                                | Total : {{ number_format($ligne->total(), 2, ',', ' ') }} €
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">
                                    Aucune commande.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
