<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Carlos acuña',
            'email' => 'profesor@gmail.com',
            'role' => 'profesor',
            'password' => '12345678',

        ]);
        
        User::factory()->create([
            'name' => 'Camilo Arenas',
            'email' => 'alumno@gmail.com',
            'role' => 'alumno',
            'password' => '12345678',

        ]);
        
        User::factory()->create([
            'name' => 'Directivo',
            'email' => 'directivo@gmail.com',
            'role' => 'directivo',
            'password' => '12345678',

        ]);
    }
}
