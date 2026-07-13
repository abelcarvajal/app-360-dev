<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('cedula', $request->cedula)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'cedula' => ['Cédula o contraseña incorrecta.'],
            ]);
        }

        $token = $user->createToken('eval360')->plainTextToken;

        return response()->json([
            'token' => $token,
            'debe_cambiar_password' => $user->debe_cambiar_password,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'cedula' => $user->cedula,
                'colaborador_id' => $user->colaborador_id,
                'roles' => $user->colaborador?->roles->pluck('slug'),
            ],
        ]);
    }

    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'password_actual' => 'required',
            'password_nuevo' => 'required|min:8|confirmed',
        ]);

        $user = $request->user();

        if (!Hash::check($request->password_actual, $user->password)) {
            return response()->json(['message' => 'Contraseña actual incorrecta'], 422);
        }

        $user->update([
            'password' => Hash::make($request->password_nuevo),
            'debe_cambiar_password' => false,
        ]);

        return response()->json(['message' => 'Contraseña actualizada correctamente']);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada']);
    }

    public function me(Request $request)
    {
        $user = $request->user()->load('colaborador.roles');
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'cedula' => $user->cedula,
            'debe_cambiar_password' => $user->debe_cambiar_password,
            'colaborador_id' => $user->colaborador_id,
            'roles' => $user->colaborador?->roles->pluck('slug') ?? [],
        ]);
    }
}
