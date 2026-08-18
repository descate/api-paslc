<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorizacionProgramada extends Model
{
    use HasFactory;

    protected $table = 'proyectos.valorizacion_programada';
    public $timestamps = false; // No tiene campos created_at / updated_at en el script

    protected $fillable = [
        'proyecto_id',
        'contrato_id',
        'anio',
        'mes',
        'monto',
        'por_avance_fisico'
    ];

    // Relaciones
    public function proyecto() { return $this->belongsTo(ProyectoInversion::class, 'proyecto_id'); }
    public function contrato() { return $this->belongsTo(Contrato::class, 'contrato_id'); }
}
