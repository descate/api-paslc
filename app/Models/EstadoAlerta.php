<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoAlerta extends Model
{
    protected $table = 'catalogo.estado_alerta';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
}
