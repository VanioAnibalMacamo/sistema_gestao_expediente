<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartamentoIdToTiposExpediente extends Migration
{
    public function up()
    {
        Schema::table('tipo_expedientes', function (Blueprint $table) {
            $table->unsignedBigInteger('departamento_id');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
        });
    }

    public function down()
    {
        Schema::table('tipo_expedientes', function (Blueprint $table) {
            $table->dropForeign(['departamento_id']);
            $table->dropColumn('departamento_id');
        });
    }
}
