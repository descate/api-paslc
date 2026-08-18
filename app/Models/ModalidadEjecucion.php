<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadEjecucion extends Model
{
    protected $table = 'catalogo.modalidad_ejecucion';

    protected $fillable = [
        'codigo',
        'nombre',
        'created_by',
        'updated_by'
    ];
}
