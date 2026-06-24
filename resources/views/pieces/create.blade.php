<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Ajouter une pièce
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow rounded">

            <form method="POST" action="{{ route('pieces.store') }}">
                @csrf

                <div class="mb-4">
                    <label>Référence</label>
                    <input type="text" name="reference" class="w-full border rounded p-2"
                        value="{{ old('reference') }}">
                    @error('reference')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Libellé</label>
                    <input type="text" name="libelle" class="w-full border rounded p-2" value="{{ old('libelle') }}">
                    @error('libelle')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Type de pièce</label>
                    <select name="type_piece_id" class="w-full border rounded p-2">
                        <option value="">Choisir un type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->libelle }}</option>
                        @endforeach
                    </select>
                    @error('type_piece_id')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Stock</label>
                    <input type="number" name="stock" class="w-full border rounded p-2"
                        value="{{ old('stock', 0) }}">
                    @error('stock')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Prix de vente</label>
                    <input type="number" step="0.01" name="prix_vente" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label>Prix catalogue / achat</label>
                    <input type="number" step="0.01" name="prix_catalogue" class="w-full border rounded p-2">
                </div>

                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    Enregistrer
                </button>

                <a href="{{ route('pieces.index') }}" class="ml-2 text-gray-600">
                    Annuler
                </a>
            </form>

        </div>
    </div>
</x-app-layout>
