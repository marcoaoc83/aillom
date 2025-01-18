<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies_files', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->integer('company_id'); // Chave estrangeira
            $table->string('title'); // Título do arquivo
            $table->text('description')->nullable(); // Descrição do arquivo
            $table->string('file_path'); // Caminho do arquivo
            $table->timestamps(); // Campos created_at e updated_at
            $table->softDeletes();
            // Chave estrangeira e relacionamento
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies_files');
    }
};