<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des machines
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('machines.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Ajouter une machine
            </a>

            <div class="bg-white mt-4 p-4 rounded shadow">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Libellé</th>
                            <th class="border p-2">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($machines as $machine)
                            <tr>
                                <td class="border p-2">{{ $machine->libelle }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('machines.edit', $machine) }}"
                                       class="text-blue-600">
                                        Modifier
                                    </a>

                                    <form method="POST"
                                          action="{{ route('machines.destroy', $machine) }}"
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
                                <td colspan="2" class="text-center p-4">
                                    Aucune machine.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
