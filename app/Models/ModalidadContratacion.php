<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadContratacion extends Model
{
    protected $table = 'catalogo.modalidad_contratacion';

    protected $fillable = [
        'codigo',
        'nombre',
        'created_by',
        'updated_by'
    ];
}
