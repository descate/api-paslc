<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeguimientoProyecto extends Model
{
    protected $table = 'proyectos.vw_seguimiento_proyecto';

    protected $primaryKey = 'etapa_proyecto_id';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'proyecto_id',
        'contrato_id',
        'etapa_proyecto_id',
        'cui',
        'alias_etapa',
        'tipo_etapa',
        'tipo_estado',
        'monto_contractual',
        'avance_fisico_programado',
        'avance_fisico_ejecutado',
        'controversias',
    ];
}
