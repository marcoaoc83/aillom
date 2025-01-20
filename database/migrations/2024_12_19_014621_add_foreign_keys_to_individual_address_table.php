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
        Schema::table('individual_address', function (Blueprint $table) {
            $table->foreign(['address_id'], 'fk_address')->references(['id'])->on('addresses')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['address_type_id'], 'fk_address_type')->references(['id'])->on('types_address')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['individual_id'], 'fk_individual_address')->references(['id'])->on('individuals')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('individual_address', function (Blueprint $table) {
            $table->dropForeign('fk_address');
            $table->dropForeign('fk_address_type');
            $table->dropForeign('fk_individual_address');
        });
    }
};
