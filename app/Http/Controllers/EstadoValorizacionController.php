<?php

namespace App\Http\Controllers;

use App\Models\EstadoValorizacion;
use Illuminate\Http\Request;

class EstadoValorizacionController extends Controller
{
    public function index()
    {
        return response()->json(EstadoValorizacion::all());
    }
}