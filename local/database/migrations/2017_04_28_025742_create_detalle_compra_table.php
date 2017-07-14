<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dc_cantidad');
            $table->string('dc_precio',20);
            $table->integer('id_compra')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->boolean('dc_estado');
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('producto');
            $table->foreign('id_compra')->references('id')->on('compra');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_compra');
    }
}
