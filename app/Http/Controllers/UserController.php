<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Obtener la lista de todos los usuarios
    public function index()
    {
        // Traemos todos los usuarios pero ocultamos la contraseña por seguridad
        $usuarios = User::select('id', 'name', 'email', 'rol')->orderBy('id', 'desc')->get();
        return response()->json($usuarios);
    }

    // Crear un usuario nuevo
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'rol' => 'required|in:admin,ejecutivo,usuario',
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptación obligatoria
            'rol' => $request->rol,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Usuario creado correctamente',
            'usuario' => $usuario
        ], 201);
    }
}
