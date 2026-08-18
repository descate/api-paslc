<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SistemaContratacion extends Model
{
    protected $table = 'catalogo.sistema_contratacion';

    protected $fillable = [
        'codigo',
        'nombre',
        'created_by',
        'updated_by'
    ];
}
