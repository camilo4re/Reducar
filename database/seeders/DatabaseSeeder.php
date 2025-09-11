<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
   User::factory()->count(10)->create([
       'role' => 'alumno',
       'password' => '12345678', // encripta la contraseña
   ]);

        User::factory()->create([
            'name' => 'Directivo',
            'email' => 'directivo@gmail.com',
            'role' => 'directivo',
            'password' => '12345678',

        ]);
        DB::table('cursos')->insert([
            ['id' => 1, 'nombre' => null, 'año' => 'Primero', 'division' => 'Primera'],
            ['id' => 2, 'nombre' => null, 'año' => 'Primero', 'division' => 'Segunda'],
            ['id' => 3, 'nombre' => null, 'año' => 'Primero', 'division' => 'Tercera'],
            ['id' => 4, 'nombre' => null, 'año' => 'Primero', 'division' => 'Cuarta'],
            ['id' => 5, 'nombre' => null, 'año' => 'Primero', 'division' => 'Quinta'],
            ['id' => 6, 'nombre' => null, 'año' => 'Primero', 'division' => 'Sexta'],
            ['id' => 7, 'nombre' => null, 'año' => 'Primero', 'division' => 'Septima'],
            ['id' => 8, 'nombre' => null, 'año' => 'Segundo', 'division' => 'Primera'],
            ['id' => 9, 'nombre' => null, 'año' => 'Segundo', 'division' => 'Segunda'],
            ['id' => 10, 'nombre' => null, 'año' => 'Segundo', 'division' => 'Tercera'],
            ['id' => 11, 'nombre' => null, 'año' => 'Segundo', 'division' => 'Cuarta'],
            ['id' => 12, 'nombre' => null, 'año' => 'Segundo', 'division' => 'Quinta'],
            ['id' => 13, 'nombre' => null, 'año' => 'Segundo', 'division' => 'Sexta'],
            ['id' => 14, 'nombre' => null, 'año' => 'Segundo', 'division' => 'Septima'],
            ['id' => 21, 'nombre' => null, 'año' => 'Tercero', 'division' => 'Primera'],
            ['id' => 22, 'nombre' => null, 'año' => 'Tercero', 'division' => 'Segunda'],
            ['id' => 23, 'nombre' => null, 'año' => 'Tercero', 'division' => 'Tercera'],
            ['id' => 24, 'nombre' => null, 'año' => 'Tercero', 'division' => 'Cuarta'],
            ['id' => 25, 'nombre' => null, 'año' => 'Tercero', 'division' => 'Quinta'],
            ['id' => 26, 'nombre' => null, 'año' => 'Tercero', 'division' => 'Sexta'],
            ['id' => 27, 'nombre' => null, 'año' => 'Tercero', 'division' => 'Septima'],
            ['id' => 28, 'nombre' => null, 'año' => 'Cuarto', 'division' => 'Primera'],
            ['id' => 29, 'nombre' => null, 'año' => 'Cuarto', 'division' => 'Segunda'],
            ['id' => 30, 'nombre' => null, 'año' => 'Cuarto', 'division' => 'Tercera'],
            ['id' => 31, 'nombre' => null, 'año' => 'Cuarto', 'division' => 'Cuarta'],
            ['id' => 32, 'nombre' => null, 'año' => 'Cuarto', 'division' => 'Quinta'],
            ['id' => 33, 'nombre' => null, 'año' => 'Cuarto', 'division' => 'Sexta'],
            ['id' => 34, 'nombre' => null, 'año' => 'Cuarto', 'division' => 'Septima'],
            ['id' => 35, 'nombre' => null, 'año' => 'Quinto', 'division' => 'Primera'],
            ['id' => 36, 'nombre' => null, 'año' => 'Quinto', 'division' => 'Segunda'],
            ['id' => 37, 'nombre' => null, 'año' => 'Quinto', 'division' => 'Tercera'],
            ['id' => 38, 'nombre' => null, 'año' => 'Quinto', 'division' => 'Cuarta'],
            ['id' => 39, 'nombre' => null, 'año' => 'Quinto', 'division' => 'Quinta'],
            ['id' => 40, 'nombre' => null, 'año' => 'Quinto', 'division' => 'Sexta'],
            ['id' => 41, 'nombre' => null, 'año' => 'Quinto', 'division' => 'Septima'],
            ['id' => 42, 'nombre' => null, 'año' => 'Sexto', 'division' => 'Primera'],
            ['id' => 43, 'nombre' => null, 'año' => 'Sexto', 'division' => 'Segunda'],
            ['id' => 44, 'nombre' => null, 'año' => 'Sexto', 'division' => 'Tercera'],
            ['id' => 45, 'nombre' => null, 'año' => 'Sexto', 'division' => 'Cuarta'],
            ['id' => 46, 'nombre' => null, 'año' => 'Sexto', 'division' => 'Quinta'],
            ['id' => 47, 'nombre' => null, 'año' => 'Sexto', 'division' => 'Sexta'],
            ['id' => 48, 'nombre' => null, 'año' => 'Sexto', 'division' => 'Septima'],
            ['id' => 49, 'nombre' => null, 'año' => 'Septimo', 'division' => 'Primera'],
            ['id' => 50, 'nombre' => null, 'año' => 'Septimo', 'division' => 'Segunda'],
            ['id' => 51, 'nombre' => null, 'año' => 'Septimo', 'division' => 'Tercera'],
            ['id' => 52, 'nombre' => null, 'año' => 'Septimo', 'division' => 'Cuarta'],
            ['id' => 53, 'nombre' => null, 'año' => 'Septimo', 'division' => 'Quinta'],
            ['id' => 54, 'nombre' => null, 'año' => 'Septimo', 'division' => 'Sexta'],
            ['id' => 55, 'nombre' => null, 'año' => 'Septimo', 'division' => 'Septima'],
        ]);
    }
    
}
