<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permiso_usuario', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_permiso')->unsigned();
            $table->integer('id_tipo_usuario')->unsigned();
            $table->timestamps();
            
            $table->foreign('id_permiso')->references('id')->on('permiso');
            $table->foreign('id_tipo_usuario')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permiso_usuario');
    }
}
