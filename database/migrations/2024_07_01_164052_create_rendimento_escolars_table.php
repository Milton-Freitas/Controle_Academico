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
        // database/migrations/xxxx_xx_xx_create_rendimento_escolars_table.php
        Schema::create('rendimento_escolars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('turma_id')->constrained()->onDelete('cascade');
            $table->foreignId('aluno_id')->constrained()->onDelete('cascade');
            $table->decimal('nota_primeira_prova', 5, 1);
            $table->decimal('nota_segunda_prova', 5, 1);
            $table->json('trabalhos');
            $table->json('notas_trabalhos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendimento_escolars');
    }
};
