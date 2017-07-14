<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('usu_nombre',150);
            $table->string('usu_numero_documento',20);
            $table->string('usu_direccion',255);
            $table->string('usu_numero_telefono',20);
            $table->string('name',20)->unique();
            $table->string('email',200)->unique();
            $table->string('usu_ruta_foto',255)->nullable();
            $table->string('password',255);
            $table->boolean('usu_estado');
            $table->boolean('usu_administrador')->nullable();;
            $table->integer('id_tipo_usuario')->unsigned();
            $table->integer('id_municipio')->unsigned();
            $table->integer('id_tipo_documento')->unsigned();
            $table->dateTime('usu_fecha_ingreso');
            $table->timestamps();
            $table->softDeletes();
            $table->rememberToken();

            $table->foreign('id_tipo_usuario')->references('id')->on('tipo_usuario');
            $table->foreign('id_municipio')->references('id')->on('municipio');
            $table->foreign('id_tipo_documento')->references('id')->on('tipo_documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
