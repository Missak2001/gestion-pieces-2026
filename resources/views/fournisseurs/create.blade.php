<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Ajouter un fournisseur
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

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

                    <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
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

