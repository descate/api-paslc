<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoMetaFisica extends Model
{
    use HasFactory;

    protected $table = 'catalogo.tipo_meta_fisica';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'codigo',
        'nombre',
        'unidad_medida',
        'activo',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function metasFisicas(): HasMany
    {
        // Al estar en la misma carpeta, no requiere importación extra
        return $this->hasMany(MetaFisica::class, 'tipo_meta_id', 'id');
    }
}
