<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoInversion extends Model
{
    use HasFactory;

    protected $table = 'proyectos.proyecto_inversion';

    protected $fillable = [
        'cui',
        'descripcion',
        'alias',
        'monto_inversion',
        'etapa_actual_id',
        'estado_id',
        'ubigeo',
        'geom',
        'created_by',
        'updated_by'
    ];

    // Relaciones
    public function estado()
    {
        return $this->belongsTo(EstadoGestion::class, 'estado_id');
    }

    public function etapaActual()
    {
        return $this->belongsTo(TipoEtapaPi::class, 'etapa_actual_id');
    }

    public function controlesGasto()
    {
        return $this->hasMany(ControlGasto::class, 'proyecto_id');
    }
}
