<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Qualifications des utilisateurs
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
                <form method="POST" action="{{ route('qualifications.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label>Utilisateur</label>
                        <select name="user_id" class="w-full border rounded p-2">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }} - {{ $user->email }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Poste de travail</label>
                        <select name="poste_travail_id" class="w-full border rounded p-2">
                            @foreach ($postes as $poste)
                                @php
                                    $dejaQualifie = $qualificationsExistantes->contains(function ($qualification) use (
                                        $poste,
                                    ) {
                                        return $qualification->poste_travail_id == $poste->id;
                                    });
                                @endphp

                                @if (!$dejaQualifie)
                                    <option value="{{ $poste->id }}">
                                        {{ $poste->libelle }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                        Ajouter qualification
                    </button>
                </form>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <table class="w-full border border-slate-200">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Utilisateur</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Poste qualifié</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($qualifications as $qualification)
                            <tr>
                                <td class="border border-slate-200 p-2">
                                    {{ $qualification->user->name }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ $qualification->posteTravail->libelle }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    <form method="POST" action="{{ route('qualifications.destroy', $qualification) }}">
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
                                    Aucune qualification définie.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

