<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Gestion des rôles utilisateurs
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded shadow p-6">

                <table class="w-full border">

                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Utilisateur</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Rôles</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($users as $user)

                            <tr>

                                <td class="border p-2">
                                    {{ $user->name }}
                                </td>

                                <td class="border p-2">
                                    {{ $user->email }}
                                </td>

                                <td class="border p-2">

                                    <form method="POST"
                                          action="{{ route('users.roles.update', $user) }}">

                                        @csrf
                                        @method('PUT')

                                        @foreach($roles as $role)

                                            <label class="block mb-1">

                                                <input type="checkbox"
                                                       name="roles[]"
                                                       value="{{ $role->id }}"
                                                       {{ $user->roles->contains($role->id) ? 'checked' : '' }}>

                                                {{ $role->libelle }}

                                            </label>

                                        @endforeach

                                </td>

                                <td class="border p-2">

                                        <button class="bg-blue-600 text-white px-3 py-1 rounded">
                                            Enregistrer
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>
</x-app-layout>
