<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Ajouter une machine
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

            <form method="POST" action="{{ route('machines.store') }}">
                @csrf

                <label>Libellé</label>

                <input type="text"
                       name="libelle"
                       class="w-full border rounded p-2 mb-4">

                <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                    Enregistrer
                </button>
            </form>

        </div>
    </div>
</x-app-layout>

