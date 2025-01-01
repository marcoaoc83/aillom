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
        Schema::table('individual', function (Blueprint $table) {
            $table->foreign(['birth_place_id'], 'fk_birth_place')->references(['id'])->on('addresses')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['gender_id'], 'fk_gender')->references(['id'])->on('individual_genders')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['naturalness_id'], 'fk_naturalness')->references(['id'])->on('addresses')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('individual', function (Blueprint $table) {
            $table->dropForeign('fk_birth_place');
            $table->dropForeign('fk_gender');
            $table->dropForeign('fk_naturalness');
        });
    }
};
