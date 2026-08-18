<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoMetaFisica; // <--- Importación corregida
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TipoMetaFisicaController extends Controller
{
    public function index(): JsonResponse
    {
        $tipos = TipoMetaFisica::where('activo', true)
            ->orderBy('nombre')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tipos,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:40|unique:catalogo.tipo_meta_fisica,codigo',
            'nombre' => 'required|string|max:150',
            'unidad_medida' => 'required|string|max:40',
        ]);

        $tipo = TipoMetaFisica::create([
            ...$validated,
            'created_by' => auth()->user()?->username ?? 'system',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tipo de meta física registrado correctamente.',
            'data' => $tipo,
        ], 201);
    }
}
