<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('funcionario_departamento_cargo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('funcionario_id');
            $table->unsignedBigInteger('departamento_id');
            $table->unsignedBigInteger('cargo_id');
            $table->timestamps();

            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionario_departamento_cargo');
    }
};
