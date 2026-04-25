<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StoreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rotas Públicas de Autenticação e Consulta
Route::post('login', [AuthController::class, 'login']);
Route::get('products', [ProductController::class, 'index']);
Route::get('products/{id}', [ProductController::class, 'show']);

// Rotas Protegidas (Exigem Token Bearer)
Route::middleware('auth:sanctum')->group(function () {

    // Gerenciamento da Loja do Usuário
    Route::get('my-store', [StoreController::class, 'index']);
    Route::post('my-store', [StoreController::class, 'store']);
    Route::put('my-store', [StoreController::class, 'update']);

    // Logout
    Route::post('logout', [AuthController::class, 'logout']);

    // CRUD de Produtos Vinculados à Loja
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::patch('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

});