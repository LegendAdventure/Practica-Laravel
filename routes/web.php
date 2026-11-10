<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
| Se reemplazó la vista por defecto de Laravel para redirigir directamente
| a la lista de proyectos, evitando así errores de "ruta no encontrada".
*/
// ELIMINADO: Ruta dashboard que redirigía por defecto a la vista
// Route::get('/dashboard', function () {
//      return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// AÑADIDO: Redirigir /dashboard a proyectos
Route::get('/dashboard', function () {
    return redirect()->route('projects.index');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile & Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





// ==========================================
// MIS RUTAS DE PROYECTOS 
// ==========================================
/*
| Al ponerle 'group' y 'auth', todas las rutas dentro de este grupo necesitan 
| obligatoriamente un LOGIN, o el sistema las redirigirá a la página de login automáticamente.
*/
Route::middleware(['auth'])->group(function () {

    /*
    | Route::resource genera automáticamente las 7 rutas del CRUD estándar:
    | (index, create, store, show, edit, update, destroy) para el ProjectController.
    | 
    | Nota: Solo permite esos 7 métodos por defecto. Si quieres añadir rutas adicionales,
    | debes declararlas de forma manual (como los ejemplos de abajo o una ruta personalizada).
    | Ejemplo para un método personalizado:
    | Route::post('/projects/{id}/join', [ProjectController::class, 'pepe_peo']);
    */
    Route::resource('projects', ProjectController::class); 

    // Rutas personalizadas para la gestión de miembros del proyecto
    Route::post('/projects/{project}/members', [ProjectController::class, 'addMember'])->name('projects.members.store');
    Route::delete('/projects/{project}/members/{user}', [ProjectController::class, 'removeMember'])->name('projects.members.destroy');

});