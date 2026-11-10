<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function createdProjects()
    {
        return $this->hasMany(Project::class); //Configuramos la relación 1:N entre User y Project, un usuario puede crear muchos proyectos
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class) // Configuramos la relación N:N entre User y Project, un usuario puede participar en muchos proyectos y un proyecto puede tener muchos usuarios
                    ->withPivot('role', 'contribution_hours') // Indicamos que queremos acceder a los atributos adicionales de la tabla intermedia

                    ->withTimestamps(); // Indicamos que queremos que se gestionen automáticamente los timestamps de la tabla intermedia, 
                    // al añadir un usuario a un proyecto, se registrará la fecha de creación y actualización de la relación.
    }
}
