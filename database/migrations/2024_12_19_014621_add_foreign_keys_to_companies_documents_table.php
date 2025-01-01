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
        Schema::table('companies_documents', function (Blueprint $table) {
            $table->foreign(['company_id'], 'fk_company_document')->references(['id'])->on('companies')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['document_type_id'], 'fk_company_documents_types_document')->references(['id'])->on('types_document')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies_documents', function (Blueprint $table) {
            $table->dropForeign('fk_company_document');
            $table->dropForeign('fk_company_documents_types_document');
        });
    }
};
