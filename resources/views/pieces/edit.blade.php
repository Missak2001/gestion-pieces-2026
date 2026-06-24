<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Modifier une pièce
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow rounded">

            <form method="POST" action="{{ route('pieces.update', $piece) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Référence</label>
                    <input type="text" name="reference" class="w-full border rounded p-2"
                        value="{{ old('reference', $piece->reference) }}">
                </div>

                <div class="mb-4">
                    <label>Libellé</label>
                    <input type="text" name="libelle" class="w-full border rounded p-2"
                        value="{{ old('libelle', $piece->libelle) }}">
                </div>

                <div class="mb-4">
                    <label>Type de pièce</label>
                    <select name="type_piece_id" class="w-full border rounded p-2">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $piece->type_piece_id == $type->id ? 'selected' : '' }}>
                                {{ $type->libelle }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label>Stock</label>
                    <input type="number" name="stock" class="w-full border rounded p-2"
                        value="{{ old('stock', $piece->stock) }}">
                </div>

                <div class="mb-4">
                    <label>Prix de vente</label>
                    <input type="number" step="0.01" name="prix_vente" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label>Prix catalogue / achat</label>
                    <input type="number" step="0.01" name="prix_catalogue" class="w-full border rounded p-2">
                </div>

                <button class="px-4 py-2 bg-green-600 text-white rounded">
                    Modifier
                </button>

            </form>

        </div>
    </div>
</x-app-layout>
