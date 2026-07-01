<?php

namespace Database\Seeders;

use App\Models\Role;
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
    }
}
