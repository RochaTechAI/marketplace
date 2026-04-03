<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents; // Opcional

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Esta é a linha mágica que faz o Laravel rodar o seu UserSeeder
        $this->call([
            UserSeeder::class,
        ]);
    }
}