<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Ajouter une opération
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow rounded">

            <form method="POST" action="{{ route('operations.store') }}">
                @csrf

                <div class="mb-4">
                    <label>Nom</label>

                    <input type="text"
                           name="nom"
                           value="{{ old('nom') }}"
                           class="w-full border rounded p-2">

                    @error('nom')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Description</label>

                    <textarea name="description"
                              rows="4"
                              class="w-full border rounded p-2">{{ old('description') }}</textarea>
                </div>

                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    Enregistrer
                </button>

                <a href="{{ route('operations.index') }}"
                   class="ml-2 text-gray-600">
                    Annuler
                </a>

            </form>

        </div>
    </div>
</x-app-layout>
