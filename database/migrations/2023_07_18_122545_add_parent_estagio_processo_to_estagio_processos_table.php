<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentEstagioProcessoToEstagioProcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estagio_processos', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_estagio_processo_id')->nullable();
            $table->foreign('parent_estagio_processo_id')->references('id')->on('estagio_processos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estagio_processos', function (Blueprint $table) {
            $table->dropForeign(['parent_estagio_processo_id']);
            $table->dropColumn('parent_estagio_processo_id');
        });
    }
}
