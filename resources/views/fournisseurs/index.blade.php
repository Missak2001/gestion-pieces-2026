<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Fournisseurs
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('fournisseurs.create') }}"
                   class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                    Ajouter un fournisseur
                </a>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <table class="w-full border border-slate-200">

                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Nom</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Email</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Téléphone</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Adresse</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($fournisseurs as $fournisseur)

                            <tr>

                                <td class="border border-slate-200 p-2">
                                    {{ $fournisseur->nom }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ $fournisseur->email ?? '-' }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ $fournisseur->telephone ?? '-' }}
                                </td>

                                <td class="border border-slate-200 p-2">
                                    {{ $fournisseur->adresse ?? '-' }}
                                </td>

                                <td class="border border-slate-200 p-2">

                                    <a href="{{ route('fournisseurs.edit', $fournisseur) }}"
                                       class="text-blue-600">
                                        Modifier
                                    </a>

                                    <form action="{{ route('fournisseurs.destroy', $fournisseur) }}"
                                          method="POST"
                                          class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 ml-3"
                                                onclick="return confirm('Supprimer ce fournisseur ?')">
                                            Supprimer
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="text-center p-4">
                                    Aucun fournisseur enregistré.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>

