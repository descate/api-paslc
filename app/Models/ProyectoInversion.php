<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProyectoInversion extends Model
{
    use HasFactory;

    protected $table = 'proyectos.proyecto_inversion';

    public $timestamps = false;

    protected $fillable = [
        'cui',
        'descripcion',
        'alias',
        'monto_inversion',
        'tiene_etapa'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(
            User::class,
            'proyecto_user',
            'proyecto_id',
            'user_id'
        );
    }
}
