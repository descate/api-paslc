<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValorizacionEjecutada extends Model
{
    protected $table = 'proyectos.valorizacion_ejecutada';
    public $timestamps = false;

    protected $fillable = [
        'proyecto_id',
        'contrato_id',
        'anio',
        'mes',
        'monto',
        'por_avance_fisico',
        'fecha_presentacion',
        'estado_valorizacion_id',
        'created_by',
        'updated_by'
    ];

    // Relaciones
    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id');
    }

    public function contrato()
    {
        return $this->belongsTo(Contrato::class, 'contrato_id');
    }

    public function estadoValorizacion()
    {
        return $this->belongsTo(EstadoValorizacion::class, 'estado_valorizacion_id');
    }
}