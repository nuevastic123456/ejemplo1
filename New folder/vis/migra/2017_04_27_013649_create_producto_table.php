<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pro_codigo',20);
            $table->string('pro_nombre',255);
            $table->string('pro_ruta_foto',255);
            $table->integer('pro_stock_maximo');
            $table->integer('pro_stock_minimo');
            $table->boolean('pro_estado');
            $table->integer('pro_existencia');
            $table->string('pro_precio_costo',20);
            $table->integer('id_categoria')->unsigned();
            $table->integer('id_unidad')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_categoria')->references('id')->on('categoria');
            $table->foreign('id_unidad')->references('id')->on('unidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}
