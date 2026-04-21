<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Retorna produtos com loja e categorias paginados
        return response()->json(Product::with(['store', 'categories'])->paginate(10));
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());

        if ($request->has('categories')) {
            $product->categories()->sync($request->get('categories'));
        }

        return response()->json(['data' => ['msg' => 'Produto criado!', 'product' => $product]], 201);
    }

    public function show(string $id)
    {
        return response()->json(Product::with(['store', 'categories'])->findOrFail($id));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        if ($request->has('categories')) {
            $product->categories()->sync($request->get('categories'));
        }

        return response()->json(['data' => ['msg' => 'Produto atualizado!', 'product' => $product]]);
    }

    public function destroy(string $id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['data' => ['msg' => 'Produto removido!']]);
    }
}