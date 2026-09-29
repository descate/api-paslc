<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AccionEstadoSituacional extends Model
{
    use HasFactory;

    protected $table = 'proyectos.acciones_estado';

    // Quitamos public $timestamps = false; para que Laravel gestione created_at y updated_at

    protected $fillable = [
        'estado_situacional_id',
        'estado_alerta_id',
        'fecha_accion',
        'accion_tomada',
        'accion_pendiente',
        'responsable_id',
        'fecha_compromiso',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'fecha_accion' => 'date',
        'fecha_compromiso' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

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

    // Relaciones
    public function estadoSituacional() { return $this->belongsTo(EstadoSituacional::class, 'estado_situacional_id'); }
    public function estadoAlerta() { return $this->belongsTo(EstadoAlerta::class, 'estado_alerta_id'); }
    public function responsable() { return $this->belongsTo(Personal::class, 'responsable_id'); }

    // Relaciones de auditoría opcionales
    public function creador() { return $this->belongsTo(User::class, 'created_by'); }
    public function actualizador() { return $this->belongsTo(User::class, 'updated_by'); }
}
