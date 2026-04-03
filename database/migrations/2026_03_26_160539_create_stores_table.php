<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            
            // Forma moderna de definir chave estrangeira:
            // 1. Cria a coluna user_id (BigInteger)
            // 2. Cria o índice e a restrição de chave estrangeira automaticamente
            // 3. cascadeOnDelete() garante integridade se o usuário for removido
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->text('description'); // Alterado para text, pois descriptions costumam ser longas
            $table->string('phone')->nullable(); // Adicionado nullable para campos opcionais
            $table->string('mobile_phone');
            
            // unique() é essencial para slugs, pois eles compõem a URL
            $table->string('slug')->unique();
            
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};