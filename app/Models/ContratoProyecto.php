<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContratoProyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos.contrato_proyecto';

    protected $fillable = [
        'proyecto_id',
        'etapa_proyecto_id',
        'rol_contrato_id',
        'numero_contrato',
        'nombre_contratista',
        'ruc_contratista',
        'fecha_firma',
        'monto_contractual',
        'plazo_contractual',
        'finicio_contractual',
        'ffin_contractual',
        'plazo_vigente',
        'ffin_vigente',
        'modalidad_ejecucion_id',
        'procedimiento_seleccion_id',
        'modalidad_contratacion_id',
        'sistema_contratacion_id',
        'estado_contrato',
    ];

    protected $casts = [
        'estado_contrato' => 'boolean',
        'monto_contractual' => 'decimal:2',
    ];

    public function etapaProyecto(): BelongsTo
    {
        return $this->belongsTo(EtapaProyecto::class, 'etapa_proyecto_id');
    }

    public function proyectoInversion(): BelongsTo
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id');
    }
}
