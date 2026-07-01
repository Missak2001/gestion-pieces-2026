<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Nouvelle commande fournisseur
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-3xl mx-auto">

            <div class="bg-white rounded shadow p-6">

                <form method="POST"
                      action="{{ route('achats.store') }}">

                    @csrf

                    <div class="mb-4">

                        <label>Fournisseur</label>

                        <select name="fournisseur_id"
                                class="w-full border rounded p-2">

                            @foreach($fournisseurs as $fournisseur)

                                <option value="{{ $fournisseur->id }}">
                                    {{ $fournisseur->nom }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="mb-4">

                        <label>Date commande</label>

                        <input type="date"
                               name="date_commande"
                               class="w-full border rounded p-2">

                    </div>

                    <div class="mb-4">

                        <label>Date livraison prévue</label>

                        <input type="date"
                               name="date_livraison_prevue"
                               class="w-full border rounded p-2">

                    </div>

                    <button class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                        Créer
                    </button>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>

