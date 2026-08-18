<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoValorizacion extends Model
{
    protected $table = 'catalogo.estado_valorizacion';
    public $timestamps = false; // Manejaremos los timestamps manualmente o por BD si es necesario

    protected $fillable = [
        'codigo', 
        'nombre', 
        'created_by', 
        'updated_by'
    ];
}