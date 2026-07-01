<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Compatibilités Machines ↔ Postes
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm mb-6">

                <form method="POST" action="{{ route('compatibilites.store') }}">

                    @csrf

                    <div class="mb-4">
                        <label>Poste de travail</label>

                        <select name="poste_travail_id" class="w-full border rounded p-2">

                            @foreach ($postes as $poste)
                                <option value="{{ $poste->id }}">
                                    {{ $poste->libelle }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Machine</label>

                        <select name="machine_id" class="w-full border rounded p-2">

                            @foreach ($machines as $machine)
                                @php
                                    $dejaUtilisee = $couplesExistants->contains(function ($couple) use ($machine) {
                                        return $couple->machine_id == $machine->id;
                                    });
                                @endphp

                                @if (!$dejaUtilisee)
                                    <option value="{{ $machine->id }}">
                                        {{ $machine->libelle }}
                                    </option>
                                @endif
                            @endforeach

                        </select>
                    </div>

                    <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                        Ajouter compatibilité
                    </button>

                </form>

            </div>

            <div class="bg-white p-4 rounded shadow">

                <table class="w-full border border-slate-200">

                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Poste</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Machine</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($compatibilites as $compatibilite)
                            <tr>
                                <td class="border border-slate-200 p-2">
                                    {{ $compatibilite->posteTravail->libelle }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ $compatibilite->machine->libelle }}
                                </td>

                                <td class="border border-slate-200 p-2">

                                    <form method="POST" action="{{ route('compatibilites.destroy', $compatibilite) }}">

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
                                <td colspan="3" class="text-center p-4">

                                    Aucune compatibilité définie.

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>

