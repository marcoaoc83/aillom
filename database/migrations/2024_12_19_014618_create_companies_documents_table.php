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
        Schema::create('companies_documents', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id')->nullable()->index('fk_company_document');
            $table->integer('document_type_id')->index('fk_company_documents_types_document');
            $table->string('document_type', 100);
            $table->string('description');
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
        Schema::dropIfExists('companies_documents');
    }
};
