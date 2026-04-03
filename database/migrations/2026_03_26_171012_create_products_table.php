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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento com a loja (Store)
            // Se a loja for deletada, os produtos dela também serão (cascade)
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('description');
            $table->text('body'); // Conteúdo detalhado do produto
            
            // Preços: Usamos decimal para precisão financeira (10 dígitos no total, 2 decimais)
            $table->decimal('price', 10, 2);
            
            $table->string('slug')->unique();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};