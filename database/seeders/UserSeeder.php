<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar um usuário administrador/teste específico para você logar
        User::create([
            'name' => 'Admin Store',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Use sempre Hash::make
        ]);

        // Criar mais 10 usuários aleatórios usando Factory para popular o marketplace
        User::factory(10)->create();
    }
}