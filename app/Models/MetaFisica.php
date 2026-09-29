<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetaFisica extends Model
{
    use HasFactory;

    protected $table = 'proyectos.meta_fisica';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'proyecto_id',
        'tipo_meta_id',
        'cantidad',
        'etapa_proyecto_id',
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
    ];

    public function tipoMeta(): BelongsTo
    {
        return $this->belongsTo(TipoMetaFisica::class, 'tipo_meta_id', 'id');
    }

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id', 'id');
    }

    // Nueva relación añadida basada en la FK de la tabla
    public function etapaProyecto(): BelongsTo
    {
        return $this->belongsTo(EtapaProyecto::class, 'etapa_proyecto_id', 'id');
    }
}
