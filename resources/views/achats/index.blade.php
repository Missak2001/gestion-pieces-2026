<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Commandes fournisseurs
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('achats.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Nouvelle commande fournisseur
            </a>

            <div class="bg-white rounded shadow mt-4 p-4">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">ID</th>
                            <th class="border p-2">Fournisseur</th>
                            <th class="border p-2">Commande</th>
                            <th class="border p-2">Livraison prévue</th>
                            <th class="border p-2">Livraison réelle</th>
                            <th class="border p-2">Total</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($achats as $achat)
                            <tr>
                                <td class="border p-2">{{ $achat->id }}</td>
                                <td class="border p-2">{{ $achat->fournisseur->nom }}</td>
                                <td class="border p-2">{{ $achat->date_commande }}</td>
                                <td class="border p-2">{{ $achat->date_livraison_prevue }}</td>
                                <td class="border p-2">{{ $achat->date_livraison_reelle ?? '-' }}</td>
                                <td class="border p-2">
                                    {{ number_format($achat->total(), 2, ',', ' ') }} €
                                </td>

                                <td class="border p-2">
                                    @if($achat->date_livraison_reelle)
                                        <span class="text-green-600 font-bold">
                                            Réceptionnée
                                        </span>
                                    @else
                                        <form method="POST"
                                              action="{{ route('achats.reception', $achat) }}"
                                              class="inline">
                                            @csrf

                                            <button class="text-blue-600 mr-3"
                                                    onclick="return confirm('Réceptionner cette commande ?')">
                                                Réceptionner
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('achat-lignes.index', $achat) }}"
                                       class="text-green-600 ml-3">
                                        Lignes
                                    </a>

                                    <form method="POST"
                                          action="{{ route('achats.destroy', $achat) }}"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 ml-3">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center p-4">
                                    Aucune commande fournisseur.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
