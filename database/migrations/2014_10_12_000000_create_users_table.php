<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Metodo encargado de cargar la migración
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();//Llave foranea
            $table->string('name');//Columna donde se almacena el nombre del usuario
            $table->string('email')->unique();//columna donde se almacena el correo electronico del usuario
            $table->timestamp('email_verified_at')->nullable();//Columna donde se carga el correo electronico de verificación
            $table->string('password');//Columna donde se almacena la contraseña del usuario
            $table->rememberToken();//Columna donde se almacena el token del usuario
            $table->timestamps();//Columna donde se almacena la fecha de creación y modificación del registro
        });
    }

    /**
     * Metodo encargado de eliminar la migración
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
