<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderBy('name')->get();
        $roles = Role::orderBy('libelle')->get();

        return view('users.roles', compact('users', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->roles()->sync($validated['roles'] ?? []);

        return redirect()
            ->route('users.roles')
            ->with('success', 'Rôles mis à jour.');
    }
}
