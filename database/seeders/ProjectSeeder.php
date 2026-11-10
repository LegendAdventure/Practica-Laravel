<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Creamos un usuario de prueba (o buscamos uno existente)
        $user = User::firstOrCreate([
            'email' => 'test@example.com'
        ], [
            'name' => 'Usuario Test',
            'password' => bcrypt('password')
        ]);

        // Le creamos un par de proyectos asociados automáticamente
        Project::create([
            'user_id' => $user->id,
            'title' => 'Proyecto de prueba 1',
            'description' => 'Descripción generada por seeder',
            'status' => 'pending'
        ]);

        Project::create([
            'user_id' => $user->id,
            'title' => 'Proyecto de prueba 2',
            'description' => 'Otra descripción automática',
            'status' => 'in_progress'
        ]);
    }
}
