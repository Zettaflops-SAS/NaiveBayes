<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InformacionDeTablaAmortizacion extends Migration
{
    /**
     * Metodo encargado de cargar la migración
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MGN_Informacion_Amortizacion', function (Blueprint $table) {

            $table->increments('PK')->unsigned()->nullable($value = false);//Columna donde se guarda la llave primaria
            $table->integer('FK_MGN_Inf_Amortizacion')->unsigned()->nullable($value = false);//Columna donde se guarda la llave foranea
            $table->foreign('FK_MGN_Inf_Amortizacion')->references('PK')->on('MGN_Informacion_Prestamo')->onDelete('cascade');//Referencia hacia la tabla padre
            $table->bigInteger('AbonoCapital')->nullable($value = false);//Columna donde se guarda el abono a capital del prestamo
            $table->bigInteger('AbonoInteres')->unsigned()->nullable($value = false);//Columna donde se guarda el interes que se debe pagar en cada cuota
            $table->bigInteger('InteresMora')->nullable($value = true);//Columna donde se guarda el interes de mora
            $table->bigInteger('Saldo')->unsigned()->nullable($value = false);//Columna donde se guarda el saldo que adeuda el cliente
            $table->integer('Mes')->unsigned()->nullable($value = false)->collation('utf8_spanish2_ci');//Columna donde se guarda el mes en el cual debe pagar la cuota
            $table->string('Estado')->nullable($value = false)->collation('utf8_spanish2_ci');//Columna donde se guarda el estadao de cada cuota
            $table->date('FechaPago')->nullable($value = true);//Columna donde se guarda la fecha en la cual realizo el pago
        });
    }

    /**
     * Metodo encargado de eliminar la migración
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MGN_Informacion_Amortizacion');
    }
}
