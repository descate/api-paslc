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

    protected $fillable = [
        'proyecto_id',
        'tipo_meta_id',
        'cantidad',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function tipoMeta(): BelongsTo
    {
        return $this->belongsTo(TipoMetaFisica::class, 'tipo_meta_id', 'id');
    }

    public function proyecto(): BelongsTo
    {
        // Asumiendo que tu modelo de proyecto también está en la carpeta Models
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id', 'id');
    }
}
