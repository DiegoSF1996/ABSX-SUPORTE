<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamado', function (Blueprint $table) {
            $table->bigIncrements('cha_codigo');
            $table->string('cha_assunto', 30);
            $table->string('cha_descricao', 2000);
            $table->dateTime('cha_datacriacao');
            $table->string('cha_status', 20);


            $table->unsignedBigInteger('usu_codigo_cliente');
            $table->foreign('usu_codigo_cliente')->references('usu_codigo')->on('usuario')->onDelete("cascade");

            $table->unsignedBigInteger('usu_codigo_suporte');
            $table->foreign('usu_codigo_suporte')->references('usu_codigo')->on('usuario')->onDelete("cascade");


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
        Schema::dropIfExists('chamado');
    }
}
