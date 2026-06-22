<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Ajouter une machine
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

            <form method="POST" action="{{ route('machines.store') }}">
                @csrf

                <label>Libellé</label>

                <input type="text"
                       name="libelle"
                       class="w-full border rounded p-2 mb-4">

                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Enregistrer
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
