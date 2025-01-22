<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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

            // Verifica o tipo de banco de dados para definir a coluna gerada corretamente
            $driver = DB::getDriverName();

            if ($driver === 'mysql') {
                $table->string('postal_code_numbers')->nullable()
                    ->storedAs("REGEXP_REPLACE(postal_code, '[^0-9]', '')"); // MySQL
            } elseif ($driver === 'pgsql') {
                $table->string('postal_code_numbers')->nullable()
                    ->storedAs("REGEXP_REPLACE(postal_code, '[^0-9]', '', 'g')"); // PostgreSQL
            } elseif ($driver === 'sqlsrv') {
                $table->string('postal_code_numbers')->nullable()
                    ->storedAs("REPLACE(REPLACE(REPLACE(postal_code, '-', ''), '.', ''), ' ', '')")
                    ->persisted(); // SQL Server
            } else {
                throw new \Exception('Banco de dados não suportado para colunas geradas.');
            }
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

