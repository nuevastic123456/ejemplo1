<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('emp_nombre',100)->nullable();
            $table->string('emp_nit',20)->nullable();
            $table->string('emp_email',100)->nullable();
            $table->string('emp_telefono',50)->nullable();
            $table->string('emp_nombre_propiietario',100)->nullable();
            $table->text('emp_descripcion')->nullable();
            $table->string('emp_ruta_logo',200)->nullable();
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
        Schema::dropIfExists('empresa');
    }
}
