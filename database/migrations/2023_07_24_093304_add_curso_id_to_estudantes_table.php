<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('estudantes', function (Blueprint $table) {
            // Adicionando a coluna de chave estrangeira
            $table->unsignedBigInteger('curso_id')->nullable();
            // Definindo o relacionamento com a tabela 'cursos'
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estudantes', function (Blueprint $table) {
            // Removendo a coluna de chave estrangeira e o relacionamento
            $table->dropForeign(['curso_id']);
            $table->dropColumn('curso_id');
        });
    }
};
