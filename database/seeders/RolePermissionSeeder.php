<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // <-- MANQUAIT ! OBLIGATOIRE

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Réinitialiser le cache Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1️⃣ Création des permissions
        $permissions = [
            'gerer-etudiants',
            'gerer-inscriptions',
            'gerer-paiements',
            'voir-statistiques',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate([
                'name' => $perm,
                'guard_name' => 'web',
            ]);
        }

        // 2️⃣ Création des rôles
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $agent = Role::firstOrCreate(['name' => 'agent', 'guard_name' => 'web']);

        // 3️⃣ Attribution des permissions
        $admin->givePermissionTo($permissions); // L’admin a tout

        $agent->givePermissionTo([
            'gerer-etudiants',
            'gerer-inscriptions',
            'gerer-paiements',
        ]);

        // 4️⃣ Création de l'utilisateur admin par défaut
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'), // Correctement hashé
            ]
        );

        // 5️⃣ Donner le rôle admin à ce user
        $user->assignRole('admin');

        // Réinitialiser encore le cache (sécurité)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
