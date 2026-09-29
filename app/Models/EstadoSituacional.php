<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class EstadoSituacional extends Model
{
    use HasFactory;

    protected $table = 'proyectos.estado_situacional';

    protected $fillable = [
        'etapa_proyecto_id',
        'numero_informe',
        'fecha_reporte',
        'tipo_es_id',
        'nivel_alerta_id',
        'estado_alerta_id',
        'titulo',
        'descripcion',
        'responsable_id',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'fecha_reporte' => 'date',
        'fecha_compromiso' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // =========================================================================
    // BOOT: Inyectar automáticamente quién crea y quién actualiza el registro
    // =========================================================================
    protected static function booted()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }

    // Relaciones Catálogos
    public function etapaProyecto() { return $this->belongsTo(EtapaProyecto::class, 'etapa_proyecto_id'); }
    public function tipoSituacion() { return $this->belongsTo(TipoSituacion::class, 'tipo_es_id'); }
    public function nivelAlerta() { return $this->belongsTo(NivelAlerta::class, 'nivel_alerta_id'); }
    public function estadoAlerta() { return $this->belongsTo(EstadoAlerta::class, 'estado_alerta_id'); }
    public function responsable() { return $this->belongsTo(Personal::class, 'responsable_id'); }

    // Relaciones para auditoría (Opcional, si tu usuario autenticado es el modelo User)
    public function creador() { return $this->belongsTo(User::class, 'created_by'); }
    public function actualizador() { return $this->belongsTo(User::class, 'updated_by'); }

    // Relación con el Historial (Línea de tiempo)
    public function acciones()
    {
        return $this->hasMany(AccionEstadoSituacional::class, 'estado_situacional_id')
                    ->orderBy('fecha_accion', 'desc')
                    ->orderBy('id', 'desc');
    }
}
