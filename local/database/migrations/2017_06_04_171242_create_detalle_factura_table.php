<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('df_cantidad');
            $table->string('df_precio',20);
            $table->integer('id_factura')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->boolean('df_estado');
            $table->timestamps();

            $table->foreign('id_producto')->references('id')->on('producto');
            $table->foreign('id_factura')->references('id')->on('factura');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_factura');
    }
}
