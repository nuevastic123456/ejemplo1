<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('factura', function (Blueprint $table){
            $table->increments('id');
            $table->string('fac_total',20);
            $table->boolean('fac_estado');
            $table->integer('id_modo_factura')->unsigned();
            $table->integer('id_usuario_cliente')->unsigned();
            $table->integer('id_usuario_vendedor')->unsigned();
            $table->timestamps();

            $table->foreign('id_usuario_cliente')->references('id')->on('users');
            $table->foreign('id_usuario_vendedor')->references('id')->on('users');
            $table->foreign('id_modo_factura')->references('id')->on('modo_factura');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura');
    }
}
