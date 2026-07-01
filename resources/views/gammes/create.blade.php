<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Ajouter une gamme
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <form method="POST" action="{{ route('gammes.store') }}">
                @csrf

                <div class="mb-4">
                    <label>Pièce</label>

                    <select name="piece_id" class="w-full border rounded p-2">
                        <option value="">Choisir une pièce</option>

                        @foreach($pieces as $piece)
                            <option value="{{ $piece->id }}">
                                {{ $piece->reference }} - {{ $piece->libelle }}
                            </option>
                        @endforeach
                    </select>

                    @error('piece_id')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Nom de la gamme</label>

                    <input type="text"
                           name="nom"
                           value="{{ old('nom') }}"
                           class="w-full border rounded p-2">

                    @error('nom')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Responsable</label>

                    <input type="text"
                           name="responsable"
                           value="{{ old('responsable') }}"
                           class="w-full border rounded p-2">
                </div>

                <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                    Enregistrer
                </button>

                <a href="{{ route('gammes.index') }}"
                   class="ml-2 text-gray-600">
                    Annuler
                </a>

            </form>

        </div>
    </div>
</x-app-layout>

