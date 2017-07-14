<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablePagoCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_compra', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pc_abono',20);
            $table->string('pc_saldo',20);
            $table->boolean('pc_estado');
            $table->dateTime('pc_fecha_compra');
            $table->integer('id_compra')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('pago_compra');
    }
}
