<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

// Rota para testar autenticação futuramente
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rota da sua API de Produtos
Route::apiResource('products', ProductController::class);