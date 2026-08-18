<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEtapaPi extends Model
{
    use HasFactory;

    protected $table = 'catalogo.tipo_etapa_pi';

    protected $fillable = [
        'codigo',
        'nombre',
        'orden',
        'created_by',
        'updated_by'
    ];

    // Relaciones
    public function estadosGestion()
    {
        return $this->hasMany(EstadoGestion::class, 'etapa_id');
    }
}
