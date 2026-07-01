<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Modifier une gamme
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <form method="POST" action="{{ route('gammes.update', $gamme) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Pièce</label>

                    <select name="piece_id" class="w-full border rounded p-2">
                        @foreach($pieces as $piece)
                            <option value="{{ $piece->id }}"
                                {{ $gamme->piece_id == $piece->id ? 'selected' : '' }}>
                                {{ $piece->reference }} - {{ $piece->libelle }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label>Nom de la gamme</label>

                    <input type="text"
                           name="nom"
                           value="{{ $gamme->nom }}"
                           class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label>Responsable</label>

                    <input type="text"
                           name="responsable"
                           value="{{ $gamme->responsable }}"
                           class="w-full border rounded p-2">
                </div>

                <button class="px-4 py-2 bg-green-600 text-white rounded">
                    Modifier
                </button>

            </form>

        </div>
    </div>
</x-app-layout>

