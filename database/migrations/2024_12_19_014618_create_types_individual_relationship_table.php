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
        Schema::create('types_individual_relationship', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('description', 100);
            $table->integer('inverse_relationship_id')->nullable(); // Novo campo
            $table->foreign('inverse_relationship_id')
                ->references('id')
                ->on('types_individual_relationship')
                ->onDelete('set null'); // Relacionamento com chave estrangeira
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types_individual_relationship');
    }
};
