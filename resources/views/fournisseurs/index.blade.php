<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Fournisseurs
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('fournisseurs.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded">
                    Ajouter un fournisseur
                </a>
            </div>

            <div class="bg-white shadow rounded p-4">

                <table class="w-full border">

                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Nom</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Téléphone</th>
                            <th class="border p-2">Adresse</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($fournisseurs as $fournisseur)

                            <tr>

                                <td class="border p-2">
                                    {{ $fournisseur->nom }}
                                </td>

                                <td class="border p-2">
                                    {{ $fournisseur->email ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $fournisseur->telephone ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $fournisseur->adresse ?? '-' }}
                                </td>

                                <td class="border p-2">

                                    <a href="{{ route('fournisseurs.edit', $fournisseur) }}"
                                       class="text-blue-600">
                                        Modifier
                                    </a>

                                    <form action="{{ route('fournisseurs.destroy', $fournisseur) }}"
                                          method="POST"
                                          class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 ml-3"
                                                onclick="return confirm('Supprimer ce fournisseur ?')">
                                            Supprimer
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="text-center p-4">
                                    Aucun fournisseur enregistré.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>
