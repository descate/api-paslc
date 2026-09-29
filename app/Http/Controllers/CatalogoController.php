<?php

namespace App\Http\Controllers;

use App\Models\TipoSituacion;
use App\Models\NivelAlerta;
use App\Models\EstadoAlerta;
use App\Models\Personal;
use App\Models\TipoEtapaPi;
use App\Models\EstadoGestion;

class CatalogoController extends Controller
{
    public function index()
    {
        return response()->json([
            'tiposSituacion' => TipoSituacion::where('activo', true)->orderBy('id')->get(),
            'nivelesAlerta'  => NivelAlerta::where('activo', true)->orderBy('id')->get(),
            'estadosAlerta'  => EstadoAlerta::where('activo', true)->orderBy('id')->get(),
            'personal'       => Personal::where('activo', true)->orderBy('nombre')->get(),
            'tiposEtapa'     => TipoEtapaPi::where('activo', true)->orderBy('id')->get(),
            'estadosGestion' => EstadoGestion::where('activo', true)->orderBy('id')->get(),
        ]);
    }
}
