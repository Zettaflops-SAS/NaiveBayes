<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InformacionDelPrestamo extends Migration
{
    /**
     * Metodo encargado de cargar la migración
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MGN_Informacion_Prestamo', function (Blueprint $table) {

            $table->increments('PK')->unsigned()->nullable($value = false);//Columna donde se guarda la llave primaria
            $table->bigInteger('ValorPrestamo')->nullable($value = false);//Columna donde se guarda el monto de dinero solicitado
            $table->decimal('InteresPrestamo')->nullable($value = false);//Columna donde se almacena el interes con el que se solicita el prestamo
            $table->integer('PlazoPrestamo')->nullable($value = false);//Columna donde se almacena el plazo al cual se solicita el prestamo
            $table->double('CuotaPrestamo')->nullable($value = false);//Columna donde se almacena la cuota que se debe pagar mensualmente
            $table->integer('CedulaCliente')->nullable($value = false)->unsigned();//Columna donde se almacena la cedula del cliente que solicita el prestamo
            //$table->integer('DedicacionComercial')->nullable($value = false);//Columna donde se almacena la dedicación comercial del cliente
            $table->integer('FuerzaMilitar')->nullable($value = false);//Columna donde se almacena la fuerza militar a la cual pertenece el cliente
            $table->string('EstadoPrestamo')->nullable($value = false)->collation('utf8_spanish2_ci');//Columna donde se almacena el estado actual del prestamo
        });
    }

    /**
     * Metodo encargado de eliminar la migración
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MGN_Informacion_Prestamo');
    }
}
