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
        Schema::create('dbuilders', function (Blueprint $table) {
            $table->id();
            $table->string('icon'); // Ícone
            $table->string('dbtable'); // Table do BD
            $table->boolean('status')->nullable();
            $table->string('navigation_label'); // Menu
            $table->string('navigation_group'); // Grupo Menu
            $table->integer('navigation_sort')->default(1); // Ordem de Navegação
            $table->json('columns')->nullable(); // Colunas
            $table->json('relationships')->nullable(); // Relacionamentos
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dbuilders');
    }
};
