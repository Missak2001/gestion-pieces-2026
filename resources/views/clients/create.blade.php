<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Nouveau client
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white p-6 rounded shadow">

                <form method="POST" action="{{ route('clients.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label>Nom</label>
                        <input type="text" name="nom" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Téléphone</label>
                        <input type="text" name="telephone" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Adresse</label>
                        <textarea name="adresse" class="w-full border rounded p-2"></textarea>
                    </div>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Enregistrer
                    </button>

                    <a href="{{ route('clients.index') }}" class="ml-2 text-gray-600">
                        Annuler
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
