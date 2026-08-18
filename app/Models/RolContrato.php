<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolContrato extends Model
{
    protected $table = 'catalogo.rol_contrato';
    public $timestamps = false; // Como vimos en la tabla, no tiene created_at / updated_at
    protected $fillable = ['codigo', 'nombre'];
}
