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
        Schema::create('individual_relationships', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('individual_id1')->nullable()->index('fk_individual1');
            $table->integer('individual_id2')->nullable()->index('fk_individual2');
            $table->integer('relationship_type_id')->nullable()->index('fk_relationship_type');
            $table->date('relationship_start_date')->nullable();
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
        Schema::dropIfExists('individual_relationships');
    }
};
