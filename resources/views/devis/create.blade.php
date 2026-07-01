<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Nouveau devis
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                <form method="POST" action="{{ route('devis.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label>Client</label>

                        <select name="client_id"
                                class="w-full border rounded p-2">
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">
                                    {{ $client->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Date du devis</label>

                        <input type="date"
                               name="date_devis"
                               value="{{ date('Y-m-d') }}"
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label>Date limite</label>

                        <input type="date"
                               name="date_limite"
                               class="w-full border rounded p-2">
                    </div>

                    <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                        Enregistrer
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>

