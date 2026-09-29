<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSituacion extends Model
{
    protected $table = 'catalogo.tipo_situacion';
    // public $timestamps = false; // Descomentar si no usas created_at / updated_at

    protected $fillable = [
        'nombre',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];
}
