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
        Schema::create('notifications', function (Blueprint $table) {
            $driver = Schema::getConnection()->getDriverName();

            // Criação dos campos comuns
            if ($driver === 'pgsql') {
                $table->uuid('id')->primary();
            } else {
                $table->id();
            }

            $table->string('type');
            $table->morphs('notifiable');

            // Definir o tipo correto para a coluna 'data' conforme o banco de dados
            if (in_array($driver, ['pgsql', 'mysql'])) {
                $table->json('data'); // MySQL e PostgreSQL suportam JSON
            } else {
                $table->text('data'); // SQL Server e SQLite usam TEXT
            }

            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
