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
            $table->string('role')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('nick');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->dateTime('lastInteraction');
            $table->string('userActive');
            $table->date('fechaNacimiento');
            $table->string('genero');
            $table->integer('paisActual');
            $table->integer('ciudadActual');
            $table->string('zona');
            $table->string('direccion_residencia');
            $table->integer('telefono');
            $table->integer('celular');
            $table->integer('tipo_establecimiento');
            $table->integer('tipo_comida');
            $table->integer('tipo_musica');
            $table->integer('tipo_ambiente');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
