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
        Schema::create('individual', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->dateTime('death_date')->nullable();
            $table->string('sex', 20)->nullable();
            $table->integer('gender_id')->nullable()->index('fk_gender');
            $table->string('nationality', 100)->nullable();
            $table->integer('birth_place_id')->nullable()->index('fk_birth_place');
            $table->integer('naturalness_id')->nullable()->index('fk_naturalness');
            $table->string('social_name')->nullable();
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
        Schema::dropIfExists('individual');
    }
};
