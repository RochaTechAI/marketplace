<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * O password é estático para não precisar re-encriptar a cada usuário criado (ganho de performance)
     */
    protected static ?string $password;

    /**
     * Definição padrão do usuário do Marketplace
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            // Usando a nova sintaxe de Password do Laravel 10/11
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Estado para e-mail não verificado
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * DICA DE STARTUP: Estado para criar um usuário que já nasce Administrador
     * Útil para testar painéis de controle
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Admin Marketplace',
            'email' => 'admin@admin.com',
        ]);
    }
}