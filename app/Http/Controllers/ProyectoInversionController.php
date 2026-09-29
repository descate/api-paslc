<?php

namespace App\Http\Controllers;

use App\Models\ProyectoInversion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProyectoInversionController extends Controller
{
    public function index(Request $request) // <-- Inyectamos Request
    {
        $user = $request->user();
        $query = ProyectoInversion::orderBy('alias', 'asc');

        // SEGURIDAD: Filtrar proyectos si es un usuario normal
        if ($user->rol === 'usuario') {
            $query->whereHas('usuarios', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            });
        }

        $proyectos = $query->get();
        return response()->json($proyectos);
    }

    public function store(Request $request)
    {
        // SEGURIDAD: Bloquear creación a usuarios normales
        if ($request->user()->rol === 'usuario') {
            return response()->json(['message' => 'No tienes permisos para crear proyectos.'], 403);
        }

        $validatedData = $request->validate([
            'cui' => [
                'required',
                'string',
                'max:20',
                Rule::unique(ProyectoInversion::class, 'cui')
            ],
            'descripcion' => 'required|string',
            'alias' => 'nullable|string|max:50',
            'monto_inversion' => 'nullable|numeric',
            'tiene_etapa' => 'nullable|boolean'
        ]);

        $proyecto = ProyectoInversion::create($validatedData);

        return response()->json($proyecto, 201);
    }

    public function show(Request $request, $id) // <-- Inyectamos Request
    {
        $user = $request->user();
        $query = ProyectoInversion::query();

        // SEGURIDAD: Evitar que un usuario vea un proyecto que no le pertenece
        if ($user->rol === 'usuario') {
            $query->whereHas('usuarios', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            });
        }

        $proyecto = $query->findOrFail($id);

        return response()->json($proyecto);
    }

    public function update(Request $request, $id)
    {
        // SEGURIDAD: Bloquear edición a usuarios normales
        if ($request->user()->rol === 'usuario') {
            return response()->json(['message' => 'No tienes permisos para editar proyectos.'], 403);
        }

        $proyecto = ProyectoInversion::findOrFail($id);

        $validatedData = $request->validate([
            'cui' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                Rule::unique(ProyectoInversion::class, 'cui')->ignore($id)
            ],
            'descripcion' => 'sometimes|required|string',
            'alias' => 'nullable|string|max:50',
            'monto_inversion' => 'nullable|numeric',
            'tiene_etapa' => 'nullable|boolean'
        ]);

        $proyecto->update($validatedData);

        return response()->json($proyecto);
    }

    public function destroy(Request $request, $id) // <-- Inyectamos Request
    {
        // SEGURIDAD: Bloquear eliminación a usuarios normales
        if ($request->user()->rol === 'usuario') {
            return response()->json(['message' => 'No tienes permisos para eliminar proyectos.'], 403);
        }

        $proyecto = ProyectoInversion::findOrFail($id);
        $proyecto->delete();

        return response()->json(null, 204);
    }
}
