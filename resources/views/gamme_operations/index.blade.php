<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Opérations de la gamme : {{ $gamme->nom }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-6xl mx-auto">

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm mb-6">
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

                    <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                        Ajouter à la gamme
                    </button>

                    <a href="{{ route('gammes.index') }}" class="ml-2 text-gray-600">
                        Retour
                    </a>
                </form>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <table class="w-full border border-slate-200">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Ordre</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Opération</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Poste prévu</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Machine prévue</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Temps prévu</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($gammeOperations as $gammeOperation)
                            <tr>
                                <td class="border border-slate-200 p-2">{{ $gammeOperation->ordre }}</td>

                                <td class="border border-slate-200 p-2">
                                    {{ $gammeOperation->operation->nom }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ $gammeOperation->posteTravailPrevu?->libelle ?? '-' }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ $gammeOperation->machinePrevue?->libelle ?? '-' }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ $gammeOperation->temps_prevu }} min
                                </td>
                                <td class="border border-slate-200 p-2">
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

