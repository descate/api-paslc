<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEtapaPi extends Model
{
    use HasFactory;

    protected $table = 'catalogo.tipo_etapa_pi';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relaciones
    public function estadosGestion()
    {
        return $this->hasMany(EstadoGestion::class, 'etapa_id');
    }
}
