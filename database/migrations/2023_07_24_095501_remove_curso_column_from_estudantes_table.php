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
            // Removendo a coluna "curso" da tabela "estudantes"
            $table->dropColumn('curso');
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
            // Recriando a coluna "curso" caso você precise reverter a migração
            $table->string('curso')->nullable();
        });
    }
};
