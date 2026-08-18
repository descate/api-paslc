<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VwSeguimientoProyecto
 * * @property int $contrato_id
 * @property int $proyecto_id
 * @property string $cui
 * @property string $descripcion
 * @property string|null $alias
 * @property string $etapa
 * @property float $monto_contractual
 * @property float $avance_fisico_programado
 * @property float $avance_fisico_ejecutado
 * @property int $controversias
 */
class VwSeguimientoProyecto extends Model
{
    // 1. Apuntamos al esquema y nombre exacto de la vista SQL
    protected $table = 'proyectos.vw_seguimiento_proyecto';

    // 2. Clave primaria referencial de la vista (El ID del contrato es el principal aquí)
    protected $primaryKey = 'contrato_id';

    // 3. Indicamos que no es un ID auto-incrementable por Eloquent
    public $incrementing = false;

    // 4. Las vistas SQL no manejan timestamps creados por Eloquent (created_at, updated_at)
    public $timestamps = false;

    // 5. Mapeo/Casting de todos los campos que devuelve la vista
    protected $casts = [
        'contrato_id'                => 'integer',
        'proyecto_id'                => 'integer',
        'cui'                        => 'string',
        'descripcion'                => 'string',
        'alias'                      => 'string',
        'etapa'                      => 'string',
        'monto_contractual'          => 'float',
        'avance_fisico_programado'   => 'float',
        'avance_fisico_ejecutado'    => 'float',
        'controversias'              => 'integer',
    ];

    // 6. Al ser una vista de solo lectura, desprotegemos la asignación masiva para consultas
    protected $guarded = [];
}
