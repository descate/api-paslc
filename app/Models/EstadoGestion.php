<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoGestion extends Model
{
    use HasFactory;

    protected $table = 'catalogo.estado_gestion';

    protected $fillable = [
        'codigo',
        'nombre',
        'etapa_id',
        'activo',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relaciones
    public function etapa()
    {
        return $this->belongsTo(TipoEtapaPi::class, 'etapa_id');
    }
}
