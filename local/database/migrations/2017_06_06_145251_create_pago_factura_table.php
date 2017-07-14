<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoFacturaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_factura', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pf_abono',20);
            $table->string('pf_saldo',20);
            $table->boolean('pf_estado');
            $table->integer('id_compra')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('pago_factura');
    }
}
