<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Niveau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(RolePermissionSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Ajouter les niveaux
        $niveaux = [
            ['nom' => 'Débutant', 'description' => 'Niveau pour les débutants'],
            ['nom' => 'Intermédiaire', 'description' => 'Niveau intermédiaire'],
            ['nom' => 'Avancé', 'description' => 'Niveau avancé'],
            ['nom' => 'Expert', 'description' => 'Niveau expert'],
        ];

        foreach ($niveaux as $niveau) {
            Niveau::create($niveau);
        }
        // Appel de ton seeder de permissions / rôles
    $this->call(RolePermissionSeeder::class);

    // Donner le rôle admin au premier utilisateur
    $user = User::first();
    if ($user) {
        $user->assignRole('admin');
    }
    
    
    }



}
