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
        Schema::create('companies_individuals', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('individual_id')->nullable()->index('fk_companies_individuals_individual');
            $table->integer('company_id')->nullable()->index('fk_companies_individuals_company');
            $table->integer('relationship_type_id')->nullable()->index('fk_companies_individuals_relationship_type');
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
        Schema::dropIfExists('companies_individuals');
    }
};
