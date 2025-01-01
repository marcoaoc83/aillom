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
        Schema::table('companies_address', function (Blueprint $table) {
            $table->foreign(['address_id'], 'fk_address2')->references(['id'])->on('addresses')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['address_type_id'], 'fk_address_type2')->references(['id'])->on('types_address')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['company_id'], 'fk_company_address2')->references(['id'])->on('companies')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies_address', function (Blueprint $table) {
            $table->dropForeign('fk_address2');
            $table->dropForeign('fk_address_type2');
            $table->dropForeign('fk_company_address2');
        });
    }
};
