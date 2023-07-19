<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('estagio_processo_tipo_expediente', function (Blueprint $table) {
            $table->unsignedBigInteger('estagio_processo_id');
            $table->unsignedBigInteger('tipo_expediente_id');

            $table->foreign('estagio_processo_id')->references('id')->on('estagio_processos')->onDelete('cascade');
            $table->foreign('tipo_expediente_id')->references('id')->on('tipo_expedientes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('estagio_processo_tipo_expediente');
    }
};
