<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Ajouter un fournisseur
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">

            <div class="bg-white p-6 rounded shadow">

                <form method="POST" action="{{ route('fournisseurs.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block mb-1">Nom</label>
                        <input type="text"
                               name="nom"
                               value="{{ old('nom') }}"
                               class="w-full border rounded p-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Téléphone</label>
                        <input type="text"
                               name="telephone"
                               value="{{ old('telephone') }}"
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1">Adresse</label>
                        <textarea name="adresse"
                                  class="w-full border rounded p-2"
                                  rows="3">{{ old('adresse') }}</textarea>
                    </div>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Enregistrer
                    </button>

                    <a href="{{ route('fournisseurs.index') }}"
                       class="ml-3 text-gray-600">
                        Annuler
                    </a>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
