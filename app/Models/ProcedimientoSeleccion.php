<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcedimientoSeleccion extends Model
{
    protected $table = 'catalogo.procedimiento_seleccion';

    protected $fillable = [
        'codigo',
        'nombre',
        'created_by',
        'updated_by'
    ];
}
