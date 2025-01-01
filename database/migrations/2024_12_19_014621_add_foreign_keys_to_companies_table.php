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
        Schema::table('companies', function (Blueprint $table) {
            $table->foreign(['level_id'], 'fk_corporate_structure')->references(['id'])->on('companies_level')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['type_company_id'], 'fk_main_activity')->references(['id'])->on('types_company')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('fk_corporate_structure');
            $table->dropForeign('fk_main_activity');
        });
    }
};
