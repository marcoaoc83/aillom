<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('types_document', function (Blueprint $table) {
            $table->string('mask', 50)->nullable()->after('regex');
        });
    }

    public function down()
    {
        Schema::table('types_document', function (Blueprint $table) {
            $table->dropColumn('mask');
        });
    }
};