<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoPrecioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_precio', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_producto')->unsigned();
            $table->integer('id_precio')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_producto')->references('id')->on('producto');
            $table->foreign('id_precio')->references('id')->on('precio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto_precio');
    }
}
