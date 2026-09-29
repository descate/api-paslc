<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelAlerta extends Model
{
    protected $table = 'catalogo.nivel_alerta';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
}
