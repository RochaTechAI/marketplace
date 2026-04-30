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
        $data = $request->validate([
            'name'        => 'required|string',
            'description' => 'required|string',
            'body'        => 'required|string',
            'price'       => 'required|numeric',
            'slug'        => 'required|string|unique:products,slug',
            'categories'  => 'array'
        ]);

        $user = auth()->user(); 
        
        // Garante que o produto seja criado dentro da loja do usuário
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
        // SEGURANÇA: Busca o produto apenas dentro da loja do usuário logado
        $product = auth()->user()->store->products()->findOrFail($id);

        $data = $request->validate([
            'name'        => 'string',
            'description' => 'string',
            'body'        => 'string',
            'price'       => 'numeric',
            'slug'        => 'string',
        ]);

        $product->update($data);

        if ($request->has('categories')) {
            $product->categories()->sync($request->get('categories'));
        }

        return response()->json([
            'data' => [
                'msg' => 'Produto atualizado com sucesso!',
                'product' => $product
            ]
        ]);
    }

    public function destroy(string $id)
    {
        // SEGURANÇA: Garante que só pode deletar se o produto for da loja do usuário
        $product = auth()->user()->store->products()->findOrFail($id);
        $product->delete();

        return response()->json(['data' => ['msg' => 'Produto removido com sucesso!']]);
    }
}