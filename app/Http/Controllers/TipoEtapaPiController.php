<?php

namespace App\Http\Controllers;

use App\Models\TipoEtapaPi;
use Illuminate\Http\Request;

class TipoEtapaPiController extends Controller
{
    public function index()
    {
        $etapas = TipoEtapaPi::orderBy('orden', 'asc')->get();
        return response()->json($etapas);
    }

    public function store(Request $request)
    {
        $etapa = TipoEtapaPi::create($request->all());
        return response()->json($etapa, 201);
    }

    public function show($id)
    {
        $etapa = TipoEtapaPi::findOrFail($id);
        return response()->json($etapa);
    }

    public function update(Request $request, $id)
    {
        $etapa = TipoEtapaPi::findOrFail($id);
        $etapa->update($request->all());
        return response()->json($etapa);
    }

    public function destroy($id)
    {
        $etapa = TipoEtapaPi::findOrFail($id);
        $etapa->delete();
        return response()->json(null, 204);
    }
}
