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
        Schema::create('individual_address', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('individual_id')->nullable()->index('fk_individual_address');
            $table->integer('address_id')->nullable()->index('fk_address_individual');
            $table->string('number_address', 20)->nullable();
            $table->string('complement')->nullable();
            $table->integer('address_type_id')->nullable()->index('fk_address_type_individual');
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
        Schema::dropIfExists('individual_address');
    }
};
