<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->unsignedBigInteger('estagio_processo_id');
            $table->foreign('estagio_processo_id')->references('id')->on('estagio_processos');
        });
    }

    public function down()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropForeign(['estagio_processo_id']);
            $table->dropColumn('estagio_processo_id');
        });
    }
};
