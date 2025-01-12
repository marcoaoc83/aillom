<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna "login" (sem a restrição unique inicialmente)
            $table->string('login')->nullable()->after('id');

            // Adiciona a coluna "individual_id" e o relacionamento com "individuals"
            $table->integer('individual_id')->nullable()->after('login');
            $table->foreign('individual_id')->references('id')->on('individuals')->onDelete('cascade');

            // Torna "email" opcional (se necessário)
            $table->string('email')->nullable()->change();
        });

        // Preenche a coluna "login" com valores únicos para evitar conflitos
        DB::table('users')->get()->each(function ($user) {
            DB::table('users')->where('id', $user->id)->update([
                'login' => 'user_' . $user->id,
            ]);
        });

        // Adiciona a restrição unique na coluna "login"
        Schema::table('users', function (Blueprint $table) {
            $table->string('login')->unique()->change();
        });

        // Remove o índice único de "email" (opcional)
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove o relacionamento com "individuals"
            $table->dropForeign(['individual_id']);
            $table->dropColumn('individual_id');

            // Remove a coluna "login"
            $table->dropColumn('login');

            // Restaura a obrigatoriedade de "email"
            $table->string('email')->nullable(false)->change();

            // Restaura o índice único de "email"
            $table->unique('email');
        });
    }
};
