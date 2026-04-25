<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Autentica o usuário e retorna o token de acesso.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Busca o usuário pelo e-mail
        $user = User::where('email', $request->email)->first();

        // Verifica se o usuário existe e se a senha está correta
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error' => 'Credenciais inválidas. Verifique seu e-mail e senha.'
            ], 401);
        }

        // Gera o token usando o Laravel Sanctum
        $token = $user->createToken('auth_token_marketplace')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => [
                'name'  => $user->name,
                'email' => $user->email
            ]
        ]);
    }

    /**
     * Revoga o token do usuário (Logout).
     */
    public function logout(Request $request)
    {
        // Deleta o token que está sendo usado na requisição atual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'msg' => 'Logout realizado com sucesso. Token revogado.'
        ]);
    }
}