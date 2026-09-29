<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtapaProyecto extends Model
{
    use HasFactory;

    protected $table = 'proyectos.etapa_proyecto';

    // Desactivamos los timestamps porque tu tabla no tiene created_at ni updated_at
    public $timestamps = false;

    protected $fillable = [
        'proyecto_id',
        'numero_etapa',
        'alias_etapa',
        'etapa_id',
        'estado_id'
    ];

    // --- RELACIONES ---

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id');
    }

    public function tipoEtapa()
    {
        // Asume que tienes un modelo llamado TipoEtapaPi para catalogo.tipo_etapa_pi
        return $this->belongsTo(TipoEtapaPi::class, 'etapa_id');
    }

    public function estadoGestion()
    {
        // Asume que tienes un modelo llamado EstadoGestion para catalogo.estado_gestion
        return $this->belongsTo(EstadoGestion::class, 'estado_id');
    }
}
