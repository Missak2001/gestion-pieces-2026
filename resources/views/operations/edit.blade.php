<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Modifier une opération
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <form method="POST" action="{{ route('operations.update', $operation) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Nom</label>

                    <input type="text"
                           name="nom"
                           value="{{ $operation->nom }}"
                           class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label>Description</label>

                    <textarea name="description"
                              rows="4"
                              class="w-full border rounded p-2">{{ $operation->description }}</textarea>
                </div>

                <button class="px-4 py-2 bg-green-600 text-white rounded">
                    Modifier
                </button>

            </form>

        </div>
    </div>
</x-app-layout>

