<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Cria 10 usuários, cada um com uma loja vinculada via Factory
        User::factory(10)->hasStore()->create();

        // Cria o usuário administrador específico
        User::factory()->create([
            'name' => 'Admin Store',
            'email' => 'admin@admin.com',
        ]);
    }
}