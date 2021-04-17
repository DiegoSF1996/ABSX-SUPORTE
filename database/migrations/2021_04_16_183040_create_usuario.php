<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->bigIncrements('usu_codigo');
            $table->boolean('usu_status');
            $table->string('usu_nome', 30);
            $table->string('usu_email', 50);
            $table->string('usu_telefone', 20);
            $table->string('usu_tipousuario', 3); //ADM, CLI, SUP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
