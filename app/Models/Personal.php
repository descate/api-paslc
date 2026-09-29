<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    // Apuntamos al esquema 'proyectos'
    protected $table = 'proyectos.personal';

    public $timestamps = false;

    // Colocamos los campos específicos que me mencionaste
    protected $fillable = [
        'nombre',
        'rol_id',
        'activo'
    ];

    // Esto convierte automáticamente el 1 o 0 de PostgreSQL a true o false en Angular
    protected $casts = [
        'activo' => 'boolean',
    ];
}
