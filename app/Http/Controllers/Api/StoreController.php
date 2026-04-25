<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Exibe os dados da loja vinculada ao usuário autenticado.
     */
    public function index()
    {
        $store = auth()->user()->store;

        if (!$store) {
            return response()->json(['error' => 'Nenhuma loja encontrada para este usuário.'], 404);
        }

        return response()->json(['data' => $store]);
    }

    /**
     * Cria uma nova loja para o usuário logado (caso ele ainda não possua uma).
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        // Regra de negócio: Um usuário, uma loja.
        if ($user->store) {
            return response()->json(['error' => 'Este usuário já possui uma loja cadastrada.'], 400);
        }

        $data = $request->validate([
            'name'         => 'required|string|min:3',
            'description'  => 'required|string',
            'phone'        => 'required|string',
            'mobile_phone' => 'required|string',
            'slug'         => 'required|string|unique:stores,slug'
        ]);

        $store = $user->store()->create($data);

        return response()->json([
            'msg' => 'Loja criada com sucesso!',
            'data' => $store
        ], 201);
    }

    /**
     * Atualiza os dados da loja do usuário logado.
     */
    public function update(Request $request)
    {
        $store = auth()->user()->store;

        if (!$store) {
            return response()->json(['error' => 'Loja não encontrada para atualização.'], 404);
        }

        $data = $request->validate([
            'name'         => 'string|min:3',
            'description'  => 'string',
            'phone'        => 'string',
            'mobile_phone' => 'string',
        ]);

        $store->update($data);

        return response()->json([
            'msg' => 'Dados da loja atualizados com sucesso!',
            'data' => $store
        ]);
    }
}