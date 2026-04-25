<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['store', 'categories'])->paginate(10);
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = auth()->user(); // Pega o usuário logado pelo token

        // Cria o produto vinculado à loja do usuário
        $product = $user->store->products()->create($data);

        if ($request->has('categories')) {
            $product->categories()->sync($request->get('categories'));
        }

        return response()->json([
            'data' => [
                'msg' => 'Produto criado com sucesso!',
                'product' => $product
            ]
        ], 201);
    }

    public function show(string $id)
    {
        $product = Product::with(['store', 'categories'])->findOrFail($id);
        return response()->json($product);
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        if ($request->has('categories')) {
            $product->categories()->sync($request->get('categories'));
        }

        return response()->json([
            'data' => [
                'msg' => 'Produto atualizado!',
                'product' => $product
            ]
        ]);
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['data' => ['msg' => 'Removido!']]);
    }
}