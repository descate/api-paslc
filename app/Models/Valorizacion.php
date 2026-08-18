<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = 'proyectos.contrato';

    protected $fillable = [
        'proyecto_id', 'rol_contrato_id', 'razon_social', 'ruc', 'numero_contrato',
        'fecha_firma', 'monto_contractual', 'plazo_contractual', 'finicio_contractual',
        'ffin_contractual', 'plazo_vigente', 'ffin_vigente', 'ffin_programada',
        'modalidad_ejecucion_id', 'procedimiento_seleccion_id', 'modalidad_contratacion_id',
        'sistema_contratacion_id', 'estado_id'
    ];

    // Relaciones
    public function proyecto() { return $this->belongsTo(ProyectoInversion::class, 'proyecto_id'); }
    public function rol() { return $this->belongsTo(RolContrato::class, 'rol_contrato_id'); }
    public function estado() { return $this->belongsTo(EstadoGestion::class, 'estado_id'); }
    public function modalidadEjecucion() { return $this->belongsTo(ModalidadEjecucion::class, 'modalidad_ejecucion_id'); }
    public function procedimientoSeleccion() { return $this->belongsTo(ProcedimientoSeleccion::class, 'procedimiento_seleccion_id'); }
    public function modalidadContratacion() { return $this->belongsTo(ModalidadContratacion::class, 'modalidad_contratacion_id'); }
    public function sistemaContratacion() { return $this->belongsTo(SistemaContratacion::class, 'sistema_contratacion_id'); }

    public function valorizacionesProgramadas() {
        return $this->hasMany(ValorizacionProgramada::class, 'contrato_id');
    }
}
