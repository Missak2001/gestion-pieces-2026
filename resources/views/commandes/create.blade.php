<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Nouvelle commande
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('commandes.store') }}">
                @csrf

                <div class="bg-white p-6 rounded shadow mb-6">
                    <div class="mb-4">
                        <label>Client</label>

                        <select name="client_id"
                                id="client_id"
                                class="w-full border rounded p-2"
                                required>
                            <option value="">-- Choisir un client --</option>

                            @foreach($clients as $client)
                                <option value="{{ $client->id }}">
                                    {{ $client->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label>Date commande</label>

                        <input type="date"
                               name="date_commande"
                               value="{{ date('Y-m-d') }}"
                               class="w-full border rounded p-2"
                               required>
                    </div>
                </div>

                <div class="bg-white p-6 rounded shadow">
                    <h3 class="font-bold mb-4">
                        Lignes de devis valides du client
                    </h3>

                    <div id="lignes-container" class="text-gray-500">
                        Choisissez un client pour afficher ses lignes de devis valides.
                    </div>

                    <div class="mt-6">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded">
                            Créer la commande
                        </button>

                        <a href="{{ route('commandes.index') }}"
                           class="ml-2 text-gray-600">
                            Annuler
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <script>
        const clientSelect = document.getElementById('client_id');
        const container = document.getElementById('lignes-container');

        clientSelect.addEventListener('change', async function () {
            const clientId = this.value;

            if (!clientId) {
                container.innerHTML = 'Choisissez un client pour afficher ses lignes de devis valides.';
                return;
            }

            container.innerHTML = 'Chargement des lignes...';

            const response = await fetch(`/clients/${clientId}/devis-lignes-valides`);
            const lignes = await response.json();

            if (lignes.length === 0) {
                container.innerHTML = 'Aucune ligne de devis valide pour ce client.';
                return;
            }

            let html = `
                <table class="w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Choisir</th>
                            <th class="border p-2">Devis</th>
                            <th class="border p-2">Pièce</th>
                            <th class="border p-2">Quantité</th>
                            <th class="border p-2">Prix</th>
                            <th class="border p-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

            lignes.forEach(ligne => {
                html += `
                    <tr>
                        <td class="border p-2 text-center">
                            <input type="checkbox"
                                   name="devis_ligne_ids[]"
                                   value="${ligne.id}">
                        </td>
                        <td class="border p-2">Devis #${ligne.devis_id}</td>
                        <td class="border p-2">${ligne.piece}</td>
                        <td class="border p-2">${ligne.quantite}</td>
                        <td class="border p-2">${Number(ligne.prix_unitaire).toFixed(2)} €</td>
                        <td class="border p-2">${Number(ligne.total).toFixed(2)} €</td>
                    </tr>
                `;
            });

            html += `
                    </tbody>
                </table>
            `;

            container.innerHTML = html;
        });
    </script>
</x-app-layout>
