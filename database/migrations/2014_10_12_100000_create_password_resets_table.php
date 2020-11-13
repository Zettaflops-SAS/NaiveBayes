<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Metodo encargado de cargar la migración
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();//Columna donde se almacena el correo electrónico para restaurar la contraseña
            $table->string('token');//Columna donde se almacena el token de la restauración de la contraseña
            $table->timestamp('created_at')->nullable();//Columna donde se guarda la fecha de creación del registro
        });
    }

    /**
     * Metodo encargado de eliminar la migración
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
}
