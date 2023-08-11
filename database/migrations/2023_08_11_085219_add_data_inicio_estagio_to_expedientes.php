<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->date('data_inicio_estagio')->nullable();
        });
    }

    public function down()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropColumn('data_inicio_estagio');
        });
    }
};
