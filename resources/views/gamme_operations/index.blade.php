<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Opérations de la gamme : {{ $gamme->nom }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow mb-6">
                <form method="POST" action="{{ route('gamme-operations.store', $gamme) }}">
                    @csrf

                    <div class="mb-4">
                        <label>Opération</label>
                        <select name="operation_id" class="w-full border rounded p-2">
                            @foreach ($operations as $operation)
                                <option value="{{ $operation->id }}">
                                    {{ $operation->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Poste prévu</label>

                        <select name="poste_travail_prevu_id" class="w-full border rounded p-2">

                            <option value="">-- Aucun --</option>

                            @foreach ($postesTravail as $poste)
                                <option value="{{ $poste->id }}">
                                    {{ $poste->libelle }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Machine prévue</label>

                        <select name="machine_prevue_id" class="w-full border rounded p-2">

                            <option value="">-- Aucune --</option>

                            @foreach ($machines as $machine)
                                <option value="{{ $machine->id }}">
                                    {{ $machine->libelle }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Ordre</label>
                        <input type="number" name="ordre" min="1" value="1"
                            class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Temps prévu en minutes</label>
                        <input type="number" name="temps_prevu" min="1" value="10"
                            class="w-full border rounded p-2">
                    </div>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Ajouter à la gamme
                    </button>

                    <a href="{{ route('gammes.index') }}" class="ml-2 text-gray-600">
                        Retour
                    </a>
                </form>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Ordre</th>
                            <th class="border p-2">Opération</th>
                            <th class="border p-2">Poste prévu</th>
                            <th class="border p-2">Machine prévue</th>
                            <th class="border p-2">Temps prévu</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($gammeOperations as $gammeOperation)
                            <tr>
                                <td class="border p-2">{{ $gammeOperation->ordre }}</td>

                                <td class="border p-2">
                                    {{ $gammeOperation->operation->nom }}
                                </td>

                                <td class="border p-2">
                                    {{ $gammeOperation->posteTravailPrevu?->libelle ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $gammeOperation->machinePrevue?->libelle ?? '-' }}
                                </td>

                                <td class="border p-2">
                                    {{ $gammeOperation->temps_prevu }} min
                                </td>
                                <td class="border p-2">
                                    <form method="POST"
                                        action="{{ route('gamme-operations.destroy', $gammeOperation) }}">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600"
                                            onclick="return confirm('Supprimer cette opération de la gamme ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-4">
                                     Aucune opération dans cette gamme.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
