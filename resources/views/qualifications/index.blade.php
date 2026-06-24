<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Qualifications des utilisateurs
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

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Ajouter qualification
                    </button>
                </form>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Utilisateur</th>
                            <th class="border p-2">Poste qualifié</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($qualifications as $qualification)
                            <tr>
                                <td class="border p-2">
                                    {{ $qualification->user->name }}
                                </td>

                                <td class="border p-2">
                                    {{ $qualification->posteTravail->libelle }}
                                </td>

                                <td class="border p-2">
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
