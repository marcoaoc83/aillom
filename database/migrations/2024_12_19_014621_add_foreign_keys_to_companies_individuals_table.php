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
        Schema::table('companies_individuals', function (Blueprint $table) {
            $table->foreign(['company_id'], 'fk_companies_individuals_company')->references(['id'])->on('companies')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['individual_id'], 'fk_companies_individuals_individual')->references(['id'])->on('individual')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['relationship_type_id'], 'fk_companies_individuals_relationship_type')->references(['id'])->on('types_company_relationship')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies_individuals', function (Blueprint $table) {
            $table->dropForeign('fk_companies_individuals_company');
            $table->dropForeign('fk_companies_individuals_individual');
            $table->dropForeign('fk_companies_individuals_relationship_type');
        });
    }
};
