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
        Schema::table('individual_documents', function (Blueprint $table) {
            $table->foreign(['individual_id'], 'fk_individual_document')->references(['id'])->on('individual')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['document_type_id'], 'fk_individual_documents_types_document')->references(['id'])->on('types_document')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('individual_documents', function (Blueprint $table) {
            $table->dropForeign('fk_individual_document');
            $table->dropForeign('fk_individual_documents_types_document');
        });
    }
};
