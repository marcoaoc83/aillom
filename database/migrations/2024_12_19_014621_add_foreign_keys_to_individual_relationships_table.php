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
        Schema::table('individual_relationships', function (Blueprint $table) {
            $table->foreign(['individual_id1'], 'fk_individual1')->references(['id'])->on('individuals')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['individual_id2'], 'fk_individual2')->references(['id'])->on('individuals')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['relationship_type_id'], 'fk_relationship_type')->references(['id'])->on('types_individual_relationship')->onUpdate('restrict')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('individual_relationships', function (Blueprint $table) {
            $table->dropForeign('fk_individual1');
            $table->dropForeign('fk_individual2');
            $table->dropForeign('fk_relationship_type');
        });
    }
};
