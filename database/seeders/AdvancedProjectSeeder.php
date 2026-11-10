<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;

class AdvancedProjectSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Creamos 10 usuarios de prueba por si la base de datos está vacía
        $users = User::factory()->count(10)->create();

        // 2. Lista de roles para repartir en la tabla pivote
        $roles = ['Frontend Developer', 'Backend Developer', 'UI/UX Designer', 'Project Manager', 'QA Tester'];

        // 3. Definimos varios proyectos de ejemplo
        $projectsData = [
            [
                'title' => 'Red Social Corporativa',
                'description' => 'Desarrollo de una red social interna para la comunicación de empleados con Laravel y Vue.',
                'status' => 'en curso',
            ],
            [
                'title' => 'Pasarela de Pagos Cripto',
                'description' => 'Integración de pasarela de pagos descentralizada para e-commerce internacional.',
                'status' => 'pendiente',
            ],
            [
                'title' => 'Sistema de Gestión de Inventarios',
                'description' => 'Control de stock en tiempo real con alertas automáticas y lectura de códigos de barras.',
                'status' => 'completado',
            ],
            [
                'title' => 'Portal de Educación Online (LMS)',
                'description' => 'Plataforma de cursos en streaming con exámenes interactivos y emisión de certificados.',
                'status' => 'en curso',
            ]
        ];

        foreach ($projectsData as $data) {
            // Asignamos un propietario (owner) aleatorio de los usuarios creados
            $data['user_id'] = $users->random()->id;

            // Creamos el proyecto
            $project = Project::create($data);

            // 4. Seleccionamos entre 2 y 5 usuarios aleatorios para la tabla pivote (members)
            $miembrosSeleccionados = $users->random(rand(2, 5));

            foreach ($miembrosSeleccionados as $miembro) {
                $project->members()->attach($miembro->id, [
                    'role' => $roles[array_rand($roles)],
                    'contribution_hours' => rand(15, 120), // Horas aleatorias entre 15 y 120
                ]);
            }
        }
    }
}
