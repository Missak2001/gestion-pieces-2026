<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Modifier client
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <form method="POST" action="{{ route('clients.update', $client) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label>Nom</label>
                        <input type="text" name="nom" value="{{ $client->nom }}" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ $client->email }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Téléphone</label>
                        <input type="text" name="telephone" value="{{ $client->telephone }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Adresse</label>
                        <textarea name="adresse" class="w-full border rounded p-2">{{ $client->adresse }}</textarea>
                    </div>

                    <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                        Mettre à jour
                    </button>

                    <a href="{{ route('clients.index') }}" class="ml-2 text-gray-600">
                        Annuler
                    </a>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>

