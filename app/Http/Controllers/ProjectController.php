<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. Recuperamos todos los proyectos de la base de datos
        $projects = Project::all(); //Devuelve una colección de todos los proyectos, es decir, un array de objetos Project, cada objeto representa un proyecto y contiene sus atributos (id, name, description, created_at, updated_at)

        // 2. Retornamos una vista y le pasamos los proyectos con compact()

        //Laravel traduce los " . " como " / " en las rutas de las vistas, por lo que "projects.index" se traduce como "resources/views/projects/index.blade.php"
        return view('projects.index', compact('projects')); //compact() crea un array asociativo (un array de toda la vida de Dios con sus indices de números enteros), pero es de objetos

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Muestra la vista con el formulario de creación
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Asegúrate de que esta línea esté justo aquí y el archivo esté bien guardado
        $validated['user_id'] = Auth::id();

        // Asegúrate de pasarle $validated y NO $request->all() o datos sueltos
        Project::create($validated);

        return redirect()->route('projects.index')->with('success', '¡Proyecto creado con éxito!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('owner', 'members'); // Cargamos los métodos owner y members para que estén disponibles en la vista (Vienen de ProjectController.php)

        $users = \App\Models\User::all(); // Cargamos todos los usuarios para poder mostrarlos en el formulario de añadir miembros al proyecto

        // Laravel busca AUTOMÁTICAMENTE el proyecto por su ID en la base de datos.
        return view('projects.show', compact('project', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        // Route Model Binding busca el proyecto AUTOMÁTICAMENTE por su ID
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        // 1. Validamos los datos nuevos
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // 2. Actualizamos el proyecto en la base de datos con los datos validados
        $project->update($validated);

        // 3. Redirigimos al listado con un mensaje flash de éxito
        return redirect()->route('projects.index')->with('success', '¡Proyecto actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // 1. Borramos el proyecto de la base de datos
        $project->delete();

        // 2. Redirigimos al listado con un mensaje flash de éxito
        return redirect()->route('projects.index')->with('success', '¡Proyecto eliminado con éxito!');
    }


    public function addMember(Request $request, Project $project)
    {
        // Validamos los datos que vienen del formulario
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string|max:255',
            'contribution_hours' => 'required|integer|min:0',
        ]);

        // Usamos attach pasándole el ID del usuario y los datos de la tabla pivote
        $project->members()->attach($request->user_id, [
            'role' => $request->role,
            'contribution_hours' => $request->contribution_hours,
        ]);

        return back()->with('success', '¡Miembro añadido con éxito!');
        // Back() redirige a la página anterior, en este caso, al detalle del proyecto donde se añadió el miembro.
    }


    public function removeMember(Project $project, \App\Models\User $user)
    {
        // Desvinculamos al usuario de la tabla pivote de este proyecto
        $project->members()->detach($user->id);

        return back()->with('success', '¡Miembro eliminado del proyecto con éxito!');
    }
}
