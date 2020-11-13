<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class CMGN_Controlador_Decision extends Controller
{
    
    /**
	*middleware encargado de validar que el usuario este logeado antes de poder
	*usar el controlador
	*/
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
    *Metodo encargado de recibir la información del algoritmo Naive
    *Bayes
    */
    public function Recibir_Informacion_Algoritmo($RespuestaCalculoProbabilidad,$RespuestaTotalCuotasMora,$IdPrestamo){
    	
    	try {
    		
    		$ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('PK',$IdPrestamo)->first();
	    	$ResultadoCalculoMaximoDineroMilitar=0;
	    	$ResultadoCalculoInteresMilitar=0;
	    	$InteresManejado=3;
	    	$TotalInteresMoraFuerzaMilitar=0;

		    $RespuestaTotalCuotas=$this->Consultar_Informacion_Cuotas($ResultadoConsultaPrestamos->FuerzaMilitar);
	    	if($RespuestaTotalCuotas=="FALLO 15"){
	    		return "FALLO 15";
	    	}

	    	if($ResultadoConsultaPrestamos->FuerzaMilitar==1){
	    		$ResultadoCalculoMaximoDineroMilitar=$this->Calcular_Dinero_Maximo_Fuerza_Militar($RespuestaCalculoProbabilidad[0]);
	    		$ResultadoCalculoInteresMilitar=$this->Calcular_Interes_Fuerza_Militar($RespuestaCalculoProbabilidad[0]);
	    		$TotalInteresMoraFuerzaMilitar=$RespuestaTotalCuotasMora[0]/$RespuestaTotalCuotas[0];
	    	}

	    	if($ResultadoConsultaPrestamos->FuerzaMilitar==2){
	    		$ResultadoCalculoMaximoDineroMilitar=$this->Calcular_Dinero_Maximo_Fuerza_Militar($RespuestaCalculoProbabilidad[3]);
	    		$ResultadoCalculoInteresMilitar=$this->Calcular_Interes_Fuerza_Militar($RespuestaCalculoProbabilidad[3]);
	    		$TotalInteresMoraFuerzaMilitar=$RespuestaTotalCuotasMora[1]/$RespuestaTotalCuotas[0];
	    	}

	    	if($ResultadoConsultaPrestamos->FuerzaMilitar==3){
	    		$ResultadoCalculoMaximoDineroMilitar=$this->Calcular_Dinero_Maximo_Fuerza_Militar($RespuestaCalculoProbabilidad[2]);
	    		$ResultadoCalculoInteresMilitar=$this->Calcular_Interes_Fuerza_Militar($RespuestaCalculoProbabilidad[2]);
	    		$TotalInteresMoraFuerzaMilitar=$RespuestaTotalCuotasMora[2]/$RespuestaTotalCuotas[0];
	    	}

	    	if($ResultadoConsultaPrestamos->FuerzaMilitar==4){
	    		$ResultadoCalculoMaximoDineroMilitar=$this->Calcular_Dinero_Maximo_Fuerza_Militar($RespuestaCalculoProbabilidad[1]);
	    		$ResultadoCalculoInteresMilitar=$this->Calcular_Interes_Fuerza_Militar($RespuestaCalculoProbabilidad[1]);
	    		$TotalInteresMoraFuerzaMilitar=$RespuestaTotalCuotasMora[3]/$RespuestaTotalCuotas[0];
	    	}

	    	if($ResultadoCalculoMaximoDineroMilitar=="FALLO 11"){
	    		return "FALLO 11";
	    	}

	    	if($ResultadoCalculoInteresMilitar=="FALLO 12"){
	    		return "FALLO 12";
	    	}

	    	$TotalDineroMaximo=$ResultadoCalculoMaximoDineroMilitar;
	    	$TotalInteres=$ResultadoCalculoInteresMilitar;
	    	$TotalInteres=$InteresManejado-$TotalInteres;
	    	$TotalInteres=round($TotalInteres+($TotalInteresMoraFuerzaMilitar),2);
	    	$ResutadoTotalPlazo=$this->Calcular_Plazo($TotalInteres,$TotalDineroMaximo);
	    	if($ResutadoTotalPlazo=="FALLO 16"){
	    		return "FALLO 16";
	    	}

	    	$CMGN_Controlador_Prestamo=new CMGN_Controlador_Prestamo();
	    	$Cuota=$CMGN_Controlador_Prestamo->Calcular_Cuota($TotalInteres,$ResutadoTotalPlazo,$TotalDineroMaximo);

	    	if($Cuota==-1){
	    		return "FALLO 17";
	    	}

	    	$RespuesInformacionPrestamo = array();
	    	$RespuesInformacionPrestamo[]=$TotalDineroMaximo;
	    	$RespuesInformacionPrestamo[]=$TotalInteres;
	    	$RespuesInformacionPrestamo[]=$ResutadoTotalPlazo;
	    	$RespuesInformacionPrestamo[]=$Cuota;

	    	return $RespuesInformacionPrestamo;

    	} catch (\Exception $e) {
    		return "FALLO 18";
    	}
    }

    /**
    *Metodo encargado de calcular el monto maximo de dinero
    *que se le puede prestar a un cliente que pertenece a una fuerza militar
    */
    public function Calcular_Dinero_Maximo_Fuerza_Militar($Probabilidad){
    	
    	try {
    		
    		$DineroMaximoMilitar=0;
    		$Contador=0.00;

    		while ($Contador < round($Probabilidad)) {
    			$DineroMaximoMilitar=$DineroMaximoMilitar+1000000;
    			$Contador=round($Contador+1.00,2);
    		}

    		return $DineroMaximoMilitar;

    	} catch (\Exception $e) {
    		return "FALLO 11";
    	}
    }

    /**
    *Metodo encargado de calcular el interes para el cliente que pertenece
    * a las fuerzas militares
    */
    private function Calcular_Interes_Fuerza_Militar($Probabilidad){
    	try {
    		$RespuestaInteresFuerzasMilitares=round($Probabilidad/100,2);
    		return $RespuestaInteresFuerzasMilitares;
    	} catch (\Exception $e) {
    		return "FALLO 12";
    	}
    }

    /**
    *Metodo encargado de consultar la información sobre las
    *cuotas de cada fuerza militar y dedicación economica
    */
    public function Consultar_Informacion_Cuotas($FuerzaMilitar){

    	try {
    		
    		$TotalCuotasEjercito=0;
	    	$TotalCuotasFuerzaAerea=0;
	    	$TotalCuotasArmada=0;
	    	$TotalCuotasNaval=0;
    		$TotalCuotasMoraEjercito=0;
	    	$TotalCuotasMoraFuerzaAerea=0;
	    	$TotalCuotasMoraArmada=0;
	    	$TotalCuotasMoraNaval=0;

	    	$ResultadoConsultaAmortizacion = DB::table('MGN_Informacion_Amortizacion')->where('Estado',"DEBE")->get();
	    	foreach ($ResultadoConsultaAmortizacion as $apuntador) {
	    		
	    		$ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('PK',$apuntador->FK_MGN_Inf_Amortizacion)->first();

	    		if($ResultadoConsultaPrestamos->FuerzaMilitar==1){
	    			$TotalCuotasEjercito=$TotalCuotasEjercito+1;
	    		}

	    		if($ResultadoConsultaPrestamos->FuerzaMilitar==2){
	    			$TotalCuotasFuerzaAerea=$TotalCuotasFuerzaAerea+1;
	    		}

	    		if($ResultadoConsultaPrestamos->FuerzaMilitar==3){
	    			$TotalCuotasArmada=$TotalCuotasArmada+1;
	    		}

	    		if($ResultadoConsultaPrestamos->FuerzaMilitar==4){
	    			$TotalCuotasNaval=$TotalCuotasNaval+1;
	    		}

	    	}

	    	$RespuestaTotalCuotas = array();

	    	if($FuerzaMilitar==1){
	    		$RespuestaTotalCuotas[]=$TotalCuotasEjercito;
	    	}

	    	if($FuerzaMilitar==2){
	    		$RespuestaTotalCuotas[]=$TotalCuotasFuerzaAerea;
	    	}

	    	if($FuerzaMilitar==3){
	    		$RespuestaTotalCuotas[]=$TotalCuotasArmada;
	    	}

	    	if($FuerzaMilitar==4){
	    		$RespuestaTotalCuotas[]=$TotalCuotasNaval;
	    	}

	    	return $RespuestaTotalCuotas;

    	} catch (\Exception $e) {
    		return "FALLO 15";
    	}
    }

    /**
    *Metodo encargado de calcular el plazo del prestamo
    */
    private function Calcular_Plazo($TotalInteres,$TotalDineroMaximo){

    	try {
    		
    		$TotalPlazo=6;
	    	$Contador=0;
	    	$ContadorAuxiliar=0;

	    	while ($Contador<= $TotalDineroMaximo) {
	    		$Contador=$Contador+1000000;
	    		if($Contador<=$TotalDineroMaximo){
	    			$TotalPlazo=$TotalPlazo+4;
	    		}
	    	}

	    	/*if($TotalInteres>=1){
	    		$TotalPlazo=$TotalPlazo+1;
	    	}

	    	if($TotalInteres>=2){
	    		$TotalPlazo=$TotalPlazo+1;
	    	}

	    	if($TotalInteres==3){
	    		$TotalPlazo=$TotalPlazo+1;
	    	}*/

	    	return $TotalPlazo;

    	} catch (\Exception $e) {
    		return "FALLO 16";
    	}
    }
}
