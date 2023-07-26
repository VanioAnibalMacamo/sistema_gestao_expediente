<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('estado')->default('Activo'); // Define a coluna 'estado' com valor padrão 'Activo'
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('estado'); // Remove a coluna 'estado' caso seja necessário fazer rollback da migração
        });
    }
};
