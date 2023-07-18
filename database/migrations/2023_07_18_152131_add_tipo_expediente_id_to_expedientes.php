<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoExpedienteIdToExpedientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_expediente_id');
            $table->foreign('tipo_expediente_id')->references('id')->on('tipo_expedientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropForeign(['tipo_expediente_id']);
            $table->dropColumn('tipo_expediente_id');
        });
    }
}
