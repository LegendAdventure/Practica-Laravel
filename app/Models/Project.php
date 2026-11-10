<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Project extends Model
{
    // Campos que permitimos rellenar masivamente (Mass Assignment)
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'due_date', 
        'status'
    ];

    /**
     * Relación 1:N -> El usuario CREADOR / PROPIETARIO de este proyecto
     */
    public function owner() //Me devuele el creador
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación N:N -> Los usuarios PARTICIPANTES en este proyecto
     */
    public function members() //Me devuelve los miembros del proyecto en un array asociativo de objetos
    {
        return $this->belongsToMany(User::class) // Configuramos la relación N:N entre Project y User, un proyecto puede tener muchos miembros (usuarios) y un usuario puede participar en muchos proyectos
                    ->withPivot('role', 'contribution_hours') // Indicamos que queremos acceder a los atributos adicionales de la tabla intermedia (importante para leer el rol y las horas de la pivote)

                    ->withTimestamps(); // Indicamos que queremos que se gestionen automáticamente los timestamps de la tabla intermedia, 
                    // al añadir un miembro a un proyecto, se registrará la fecha de creación y actualización de la relación.
    }
}