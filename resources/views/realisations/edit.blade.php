<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Modifier une réalisation
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <div class="mb-6 p-4 bg-gray-100 rounded">
                    <p>
                        <strong>Gamme :</strong>
                        {{ $realisation->gammeOperation->gamme->nom }}
                    </p>

                    <p>
                        <strong>Opération :</strong>
                        {{ $realisation->gammeOperation->operation->nom }}
                    </p>

                    <p>
                        <strong>Poste prévu :</strong>
                        {{ $realisation->gammeOperation->posteTravailPrevu?->libelle ?? '-' }}
                    </p>

                    <p>
                        <strong>Machine prévue :</strong>
                        {{ $realisation->gammeOperation->machinePrevue?->libelle ?? '-' }}
                    </p>

                    <p>
                        <strong>Temps prévu :</strong>
                        {{ $realisation->gammeOperation->temps_prevu }} min
                    </p>
                </div>

                <form method="POST" action="{{ route('realisations.update', $realisation) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Poste réel</label>
                        <select name="poste_travail_reel_id"
                                class="w-full border rounded p-2">
                            @foreach($postes as $poste)
                                <option value="{{ $poste->id }}"
                                    {{ $realisation->poste_travail_reel_id == $poste->id ? 'selected' : '' }}>
                                    {{ $poste->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Machine réelle</label>
                        <select name="machine_reelle_id"
                                class="w-full border rounded p-2">
                            @foreach($machines as $machine)
                                <option value="{{ $machine->id }}"
                                    {{ $realisation->machine_reelle_id == $machine->id ? 'selected' : '' }}>
                                    {{ $machine->libelle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Temps réel en minutes</label>
                        <input type="number"
                               name="temps_reel"
                               min="1"
                               value="{{ $realisation->temps_reel }}"
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox"
                                   name="terminee"
                                   value="1"
                                   class="mr-2"
                                   {{ $realisation->terminee ? 'checked' : '' }}>
                            Réalisation terminée
                        </label>
                    </div>

                    <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                        Enregistrer
                    </button>

                    <a href="{{ route('realisations.index') }}"
                       class="ml-2 text-gray-600">
                        Annuler
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

