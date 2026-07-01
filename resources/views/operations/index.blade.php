<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des opérations
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('operations.create') }}"
                   class="inline-flex items-center rounded-xl border border-cyan-800 bg-cyan-700 px-4 py-2 font-semibold text-white shadow-sm transition hover:-translate-y-0.5 hover:bg-cyan-800 hover:shadow">
                    Ajouter une opération
                </a>
            </div>

            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="w-full border border-slate-200">
                    <thead>
                        <tr class="bg-slate-100">
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Nom</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Description</th>
                            <th class="border border-slate-200 p-2 text-xs font-bold uppercase tracking-wide text-slate-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($operations as $operation)
                            <tr>
                                <td class="border border-slate-200 p-2">{{ $operation->nom }}</td>
                                <td class="border border-slate-200 p-2">{{ $operation->description ?? '-' }}</td>
                                <td class="border border-slate-200 p-2">
                                    <a href="{{ route('operations.edit', $operation) }}"
                                       class="text-blue-600">
                                        Modifier
                                    </a>

                                    <form action="{{ route('operations.destroy', $operation) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 ml-2"
                                                onclick="return confirm('Supprimer cette opération ?')">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border p-4 text-center">
                                    Aucune opération enregistrée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>

