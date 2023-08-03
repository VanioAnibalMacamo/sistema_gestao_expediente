<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('funcionario_comentario_expediente', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcionario_id');
            $table->unsignedBigInteger('expediente_id');
            $table->text('comentario');
            $table->timestamp('data_comentario')->useCurrent();
            $table->timestamps();

            $table->foreign('funcionario_id')->references('id')->on('funcionarios');
            $table->foreign('expediente_id')->references('id')->on('expedientes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionario_comentario_expediente');
    }
};
