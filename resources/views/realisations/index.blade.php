<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Historique des réalisations
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white p-6 rounded shadow mb-6">
                <form method="POST" action="{{ route('realisations.store') }}">
                    @csrf

                    <label>Opération de gamme</label>
                    <select name="gamme_operation_id" id="gamme_operation_id" class="w-full border rounded p-2 mb-4">
                        @foreach ($gammeOperations as $go)
                            <option value="{{ $go->id }}"
                                data-poste="{{ $go->posteTravailPrevu?->libelle ?? '' }}"
                                data-machine="{{ $go->machinePrevue?->libelle ?? '' }}"
                                data-temps="{{ $go->temps_prevu }}">
                                {{ $go->gamme->nom }} - {{ $go->operation->nom }}
                            </option>
                        @endforeach
                    </select>

                    <label>Poste prévu</label>
                    <input type="text" id="poste_prevu" class="w-full border rounded p-2 mb-4 bg-gray-100" readonly>

                    <label>Machine prévue</label>
                    <input type="text" id="machine_prevue" class="w-full border rounded p-2 mb-4 bg-gray-100"
                        readonly>

                    <label>Temps prévu en minutes</label>
                    <input type="text" id="temps_prevu" class="w-full border rounded p-2 mb-4 bg-gray-100" readonly>

                    <label>Utilisateur</label>
                    <select name="user_id" class="w-full border rounded p-2 mb-4">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>

                    <label>Poste réel</label>
                    <select name="poste_travail_reel_id" class="w-full border rounded p-2 mb-4">
                        @foreach ($postes as $poste)
                            <option value="{{ $poste->id }}">
                                {{ $poste->libelle }}
                            </option>
                        @endforeach
                    </select>

                    <label>Machine réelle</label>
                    <select name="machine_reelle_id" class="w-full border rounded p-2 mb-4">
                        @foreach ($machines as $machine)
                            <option value="{{ $machine->id }}">
                                {{ $machine->libelle }}
                            </option>
                        @endforeach
                    </select>

                    <label>Date réalisation</label>
                    <input type="date" name="date_realisation" class="w-full border rounded p-2 mb-4">

                    <label>Temps réel en minutes</label>
                    <input type="number" name="temps_reel" min="1" class="w-full border rounded p-2 mb-4">

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Enregistrer réalisation
                    </button>
                </form>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Gamme</th>
                            <th class="border p-2">Opération</th>
                            <th class="border p-2">Utilisateur</th>
                            <th class="border p-2">Poste réel</th>
                            <th class="border p-2">Machine réelle</th>
                            <th class="border p-2">Date</th>
                            <th class="border p-2">Temps réel</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($realisations as $realisation)
                            <tr>
                                <td class="border p-2">
                                    {{ $realisation->gammeOperation->gamme->nom }}
                                </td>
                                <td class="border p-2">
                                    {{ $realisation->gammeOperation->operation->nom }}
                                </td>
                                <td class="border p-2">
                                    {{ $realisation->user->name }}
                                </td>
                                <td class="border p-2">
                                    {{ $realisation->posteTravailReel->libelle }}
                                </td>
                                <td class="border p-2">
                                    {{ $realisation->machineReelle->libelle }}
                                </td>
                                <td class="border p-2">
                                    {{ $realisation->date_realisation }}
                                </td>
                                <td class="border p-2">
                                    {{ $realisation->temps_reel }} min
                                </td>
                                <td class="border p-2">
                                    <form method="POST" action="{{ route('realisations.destroy', $realisation) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center p-4">
                                    Aucune réalisation enregistrée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script>
        function remplirChampsPrevus() {
            const select = document.getElementById('gamme_operation_id');

            if (!select) {
                return;
            }

            const option = select.options[select.selectedIndex];

            document.getElementById('poste_prevu').value = option.dataset.poste || '';
            document.getElementById('machine_prevue').value = option.dataset.machine || '';
            document.getElementById('temps_prevu').value = option.dataset.temps || '';
        }

        document.addEventListener('DOMContentLoaded', remplirChampsPrevus);

        document.getElementById('gamme_operation_id')
            ?.addEventListener('change', remplirChampsPrevus);
    </script>
</x-app-layout>
