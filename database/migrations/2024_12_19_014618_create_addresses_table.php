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
        Schema::create('addresses', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('parent_id')->nullable()->index('fk_parent_address');
            $table->string('description');
            $table->string('abbreviation', 20)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('latitude', 65)->nullable();
            $table->string('longitude', 65)->nullable();
            $table->string('ibge_code', 20)->nullable();
            $table->integer('area_code')->nullable();
            $table->integer('country_code')->nullable();
            $table->string('hierarchical_code', 20)->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
