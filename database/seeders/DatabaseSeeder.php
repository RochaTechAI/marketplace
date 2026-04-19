<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Criar 10 categorias globais
        $categories = Category::factory(10)->create();

        // 2. Criar Usuários e Lojas
        User::factory(10)
            ->has(
                Store::factory()
                    ->has(
                        // Criamos os produtos vinculados à loja
                        Product::factory(20)->afterCreating(function (Product $product) use ($categories) {
                            // Após criar o produto, vinculamos entre 1 e 3 categorias aleatórias na tabela pivot
                            $product->categories()->attach($categories->random(rand(1, 3))->pluck('id'));
                        })
                    )
            )
            ->create();

        // Usuário admin padrão
        User::factory()->create([
            'name' => 'Admin Store',
            'email' => 'admin@admin.com',
        ]);
    }
}