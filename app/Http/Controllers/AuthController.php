<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validamos que los datos cumplan con los requisitos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // No permite emails duplicados
            'password' => 'required|string|min:8',
        ]);

        // Creamos el usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Tu modelo (con #'hashed') la encriptará automáticamente
        ]);

        // Generamos el token de Sanctum para este usuario recién creado
        $token = $user->createToken('auth_token')->plainTextToken;

        // Respondemos con el token y un estado HTTP 21 (Created)
        return response()->json([
            'message' => 'Usuario registrado con éxito',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function login(Request $request)
    {
        // Validamos que envíen los campos obligatorios
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Buscamos si existe un usuario con ese email
        $user = User::where('email', $request->email)->first();

        // Validamos: ¿El usuario no existe? O ¿La contraseña no coincide con el Hash guardado?
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        // Si las credenciales son correctas, creamos un nuevo Token de Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // Respondemos con el token de acceso
        return response()->json([
            'message' => 'Ingreso exitoso',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    public function logout(Request $request)
    {
        // 'currentAccessToken()' identifica exactamente el token que el usuario mandó en la cabecera
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente y token revocado.'
        ], 200);
    }
}
