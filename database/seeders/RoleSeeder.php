<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nom' => 'admin', 'libelle' => 'Administrateur'],
            ['nom' => 'atelier', 'libelle' => 'Atelier'],
            ['nom' => 'commercial', 'libelle' => 'Commercial'],
            ['nom' => 'comptabilite', 'libelle' => 'Comptabilité'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['nom' => $role['nom']],
                ['libelle' => $role['libelle']]
            );
        }

        // Attribuer automatiquement le rôle admin au premier utilisateur
        $admin = User::first();

        if ($admin) {
            $roleAdmin = Role::where('nom', 'admin')->first();

            if ($roleAdmin && !$admin->roles()->where('role_id', $roleAdmin->id)->exists()) {
                $admin->roles()->attach($roleAdmin->id);
            }
        }
    }
}
