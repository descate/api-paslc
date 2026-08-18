<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlGasto extends Model
{
    use HasFactory;

    protected $table = 'proyectos.control_gasto';

    protected $fillable = [
        'proyecto_id',
        'componente_proyecto_id',
        'meta',
        'clasificador_gasto',
        'concepto_pago',
        'mes',
        'monto_gasto',
        'created_by',
        'updated_by'
    ];

    // Relaciones
    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id');
    }
}
