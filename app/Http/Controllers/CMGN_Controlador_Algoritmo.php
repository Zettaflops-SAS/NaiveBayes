<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class CMGN_Controlador_Algoritmo extends Controller
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
    *Metodo encargado de cargar la vista con todas las estadisticas obtenenidas
    *de la aplicación del algoritmo Naive Bayes
    */
    public function Mostar_Vista_Estadistica_Algoritmo($IdPrestamo){

    	try {
    		
    		$RespuestaAlgoritmoEjercito=$this->Consultar_Informacion_Ejercito();
  			if($RespuestaAlgoritmoEjercito=="FALLO 1"){
  				return $this->Redireccionar_Mensajes_Fallos(1);
  			}  		

	    	$RespuestaAlgoritmoFuerzaAerea=$this->Consultar_Informacion_Fuerza_Aerea();
	    	if($RespuestaAlgoritmoFuerzaAerea=="FALLO 2"){
  				return $this->Redireccionar_Mensajes_Fallos(2);
  			}

	    	$RespuestaAlgoritmoArmada=$this->Consultar_Informacion_Armada();
	    	if($RespuestaAlgoritmoArmada=="FALLO 3"){
  				return $this->Redireccionar_Mensajes_Fallos(3);
  			}
  			
	    	$RespuestaAlgoritmoNaval=$this->Consultar_Informacion_Naval();
	    	if($RespuestaAlgoritmoNaval=="FALLO 4"){
  				return $this->Redireccionar_Mensajes_Fallos(4);
  			}

  			$RespuestaCalculoProbabilidad=$this->Calcular_Probabilidades($RespuestaAlgoritmoEjercito,$RespuestaAlgoritmoFuerzaAerea,$RespuestaAlgoritmoArmada,$RespuestaAlgoritmoNaval);
  			
  			$RespuestaTotalCuotasMora=$this->Consultar_Informacion_Cuotas_Mora();
  			if($RespuestaTotalCuotasMora=="FALLO 10"){
  				return $this->Redireccionar_Mensajes_Fallos(10);
  			}

  			$TotalCuotasCanceladasEjercito=$RespuestaAlgoritmoEjercito[3];
  			$TotalCuotasDeudaEjercito=$RespuestaAlgoritmoEjercito[4];

  			$TotalCuotasCanceladasFuerzaAerea=$RespuestaAlgoritmoFuerzaAerea[3];
  			$TotalCuotasDeudaFuerzaAerea=$RespuestaAlgoritmoFuerzaAerea[4];

  			$TotalCuotasCanceladasArmada=$RespuestaAlgoritmoArmada[3];
  			$TotalCuotasDeudaArmada=$RespuestaAlgoritmoArmada[4];

  			$TotalCuotasCanceladasNaval=$RespuestaAlgoritmoNaval[3];
  			$TotalCuotasDeudaNaval=$RespuestaAlgoritmoNaval[4];

	    	$ProbabilidadTotalEjercito=$RespuestaCalculoProbabilidad[0];
	    	$ProbabilidadTotalNaval=$RespuestaCalculoProbabilidad[1];
	    	$ProbabilidadTotalArmada=$RespuestaCalculoProbabilidad[2];
	    	$ProbabilidadTotalFuerzaAerea=$RespuestaCalculoProbabilidad[3];

	    	$TotalCuotasMoraEjercito=$RespuestaTotalCuotasMora[0];
	    	$TotalCuotasMoraFuerzaAerea=$RespuestaTotalCuotasMora[1];
	    	$TotalCuotasMoraArmada=$RespuestaTotalCuotasMora[2];
	    	$TotalCuotasMoraNaval=$RespuestaTotalCuotasMora[3];

	    	$CMGN_Controlador_Decision=new CMGN_Controlador_Decision();
	    	$ResuestaDecision=$CMGN_Controlador_Decision->Recibir_Informacion_Algoritmo($RespuestaCalculoProbabilidad,$RespuestaTotalCuotasMora,$IdPrestamo);

	    	if($ResuestaDecision=="FALLO 11"){
	    		return $this->Redireccionar_Mensajes_Fallos(11);
	    	}

	    	if($ResuestaDecision=="FALLO 12"){
	    		return $this->Redireccionar_Mensajes_Fallos(12);
	    	}

	    	if($ResuestaDecision=="FALLO 13"){
	    		return $this->Redireccionar_Mensajes_Fallos(12);
	    	}

	    	if($ResuestaDecision=="FALLO 14"){
	    		return $this->Redireccionar_Mensajes_Fallos(12);
	    	}

	    	if($ResuestaDecision=="FALLO 15"){
	    		return $this->Redireccionar_Mensajes_Fallos(15);
	    	}

	    	if($ResuestaDecision=="FALLO 16"){
	    		return $this->Redireccionar_Mensajes_Fallos(16);
	    	}

	    	if($ResuestaDecision=="FALLO 17"){
	    		return $this->Redireccionar_Mensajes_Fallos(17);
	    	}

	    	if($ResuestaDecision=="FALLO 18"){
	    		return $this->Redireccionar_Mensajes_Fallos(18);
	    	}

	    	$DineroSimulado=$ResuestaDecision[0];
	    	$InteresSimulado=$ResuestaDecision[1];
	    	$PlazoSimulado=$ResuestaDecision[2];
	    	$CuotaSimulada=$ResuestaDecision[3];
	    	
	    	$ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('PK',$IdPrestamo)->first();

	    	$DineroSolicitado=$ResultadoConsultaPrestamos->ValorPrestamo;
	    	$InteresSolicitado=$ResultadoConsultaPrestamos->InteresPrestamo;
	    	$PlazoSolicitado=$ResultadoConsultaPrestamos->PlazoPrestamo;
	    	$CoutaSolicitada=$ResultadoConsultaPrestamos->CuotaPrestamo;
	    	$CedulaCliente=$ResultadoConsultaPrestamos->CedulaCliente;
	    	$FuerzaPerteneciente=$ResultadoConsultaPrestamos->FuerzaMilitar;

	    	$totalPrestamos=$RespuestaCalculoProbabilidad[17];
	    	$PCAE=round($RespuestaCalculoProbabilidad[5]*100,2);
			$PCCE=round($RespuestaCalculoProbabilidad[6]*100,2);
			$PCAECCE=round($RespuestaCalculoProbabilidad[7]*100,2);
			$PCAF=round($RespuestaCalculoProbabilidad[8]*100,2);
			$PCCF=round($RespuestaCalculoProbabilidad[9]*100,2);
			$PCAFCCF=round($RespuestaCalculoProbabilidad[10]*100,2);
			$PCAA=round($RespuestaCalculoProbabilidad[11]*100,2);
			$PCCA=round($RespuestaCalculoProbabilidad[12]*100,2);
			$PCAACCA=round($RespuestaCalculoProbabilidad[13]*100,2);
			$PCAN=round($RespuestaCalculoProbabilidad[14]*100,2);
			$PCCN=round($RespuestaCalculoProbabilidad[15]*100,2);
			$PCANCCN=round($RespuestaCalculoProbabilidad[16]*100,2);

		    return view('Algoritmo.VMGN_Estadisticas_Algoritmo',compact('ProbabilidadTotalEjercito','ProbabilidadTotalNaval','ProbabilidadTotalArmada','ProbabilidadTotalFuerzaAerea','TotalCuotasCanceladasEjercito','TotalCuotasDeudaEjercito','TotalCuotasCanceladasFuerzaAerea','TotalCuotasDeudaFuerzaAerea','TotalCuotasCanceladasArmada','TotalCuotasDeudaArmada','TotalCuotasCanceladasNaval','TotalCuotasDeudaNaval','TotalCuotasMoraEjercito','TotalCuotasMoraFuerzaAerea','TotalCuotasMoraArmada','TotalCuotasMoraNaval','DineroSimulado','InteresSimulado','PlazoSimulado','CuotaSimulada','DineroSolicitado','InteresSolicitado','PlazoSolicitado','CoutaSolicitada','CedulaCliente','IdPrestamo','PCAE','PCCE','PCAECCE','PCAF','PCCF','PCAFCCF','PCAA','PCCA','PCAACCA','PCAN','PCCN','PCANCCN','totalPrestamos','FuerzaPerteneciente'));

    	} catch (\Exception $e) {
    		return $this->Redireccionar_Mensajes_Fallos(19);
    	}
    }

    /**
    *Metodo encargado de consultar la información sobre las
    *cuotas que se encuentran mora para todas las fuerzas militares y dedicación economica
    */
    private function Consultar_Informacion_Cuotas_Mora(){

    	try {
    		
    		$TotalCuotasMoraEjercito=0;
	    	$TotalCuotasMoraFuerzaAerea=0;
	    	$TotalCuotasMoraArmada=0;
	    	$TotalCuotasMoraNaval=0;
	    	$TotalCuotasMoraIndependiente=0;
	    	$TotalCuotasMoraDependiente=0;
	    	$TotalCuotasMoraComerciante=0;
	    	$TotalCuotasMoraEmpresario=0;

	    	$ResultadoConsultaAmortizacion = DB::table('MGN_Informacion_Amortizacion')->where('Estado',"MORA")->get();
	    	foreach ($ResultadoConsultaAmortizacion as $apuntador) {
	    		
	    		$ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('PK',$apuntador->FK_MGN_Inf_Amortizacion)->first();

	    		if($ResultadoConsultaPrestamos->FuerzaMilitar==1){
	    			$TotalCuotasMoraEjercito=$TotalCuotasMoraEjercito+1;
	    		}

	    		if($ResultadoConsultaPrestamos->FuerzaMilitar==2){
	    			$TotalCuotasMoraFuerzaAerea=$TotalCuotasMoraFuerzaAerea+1;
	    		}

	    		if($ResultadoConsultaPrestamos->FuerzaMilitar==3){
	    			$TotalCuotasMoraArmada=$TotalCuotasMoraArmada+1;
	    		}

	    		if($ResultadoConsultaPrestamos->FuerzaMilitar==4){
	    			$TotalCuotasMoraNaval=$TotalCuotasMoraNaval+1;
	    		}

	    		if($ResultadoConsultaPrestamos->EstadoPrestamo==1){
	    			$TotalCuotasMoraIndependiente=$TotalCuotasMoraIndependiente+1;
	    		}

	    		if($ResultadoConsultaPrestamos->EstadoPrestamo==2){
	    			$TotalCuotasMoraDependiente=$TotalCuotasMoraDependiente+1;
	    		}

	    		if($ResultadoConsultaPrestamos->EstadoPrestamo==3){
	    			$TotalCuotasMoraComerciante=$TotalCuotasMoraComerciante+1;
	    		}

	    		if($ResultadoConsultaPrestamos->EstadoPrestamo==4){
	    			$TotalCuotasMoraEmpresario=$TotalCuotasMoraEmpresario+1;
	    		}
	    	}

	    	$RespuestaTotalCuotasMora = array();
	    	$RespuestaTotalCuotasMora[]=$TotalCuotasMoraEjercito;
	    	$RespuestaTotalCuotasMora[]=$TotalCuotasMoraFuerzaAerea;
	    	$RespuestaTotalCuotasMora[]=$TotalCuotasMoraArmada;
	    	$RespuestaTotalCuotasMora[]=$TotalCuotasMoraNaval;
	    	$RespuestaTotalCuotasMora[]=$TotalCuotasMoraIndependiente;
	    	$RespuestaTotalCuotasMora[]=$TotalCuotasMoraDependiente;
	    	$RespuestaTotalCuotasMora[]=$TotalCuotasMoraComerciante;
	    	$RespuestaTotalCuotasMora[]=$TotalCuotasMoraEmpresario;

	    	return $RespuestaTotalCuotasMora;

    	} catch (\Exception $e) {
    		return "FALLO 10";
    	}
    }

    /**
    *Metodo encargado de calcular la probabilidad de pagar un prestamo
    *tanto para fuerza militar como para dedicación comercial
    */
    public function Calcular_Probabilidades($RespuestaAlgoritmoEjercito,$RespuestaAlgoritmoFuerzaAerea,$RespuestaAlgoritmoArmada,$RespuestaAlgoritmoNaval){

    	try {
    		
    		$ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->Where('EstadoPrestamo',"APROBADO")->orWhere('EstadoPrestamo',"CANCELADO")->get();
    		$totalPrestamos=count($ResultadoConsultaPrestamos);

	    	$PCAE=$RespuestaAlgoritmoEjercito[8]/$totalPrestamos;
	    	$PCCE=$RespuestaAlgoritmoEjercito[6]/$RespuestaAlgoritmoEjercito[8];
	    	$PCAECCE=1-($RespuestaAlgoritmoEjercito[7]/$RespuestaAlgoritmoEjercito[6]);
	    	$ProbabilidadTotalEjercito=$PCAE*$PCCE*$PCAECCE*100;
	    	//dd($RespuestaAlgoritmoEjercito);
	    	$PCAF=$RespuestaAlgoritmoFuerzaAerea[8]/$totalPrestamos;
	    	$PCCF=$RespuestaAlgoritmoFuerzaAerea[6]/$RespuestaAlgoritmoFuerzaAerea[8];
	    	$PCAFCCF=1-($RespuestaAlgoritmoFuerzaAerea[7]/$RespuestaAlgoritmoFuerzaAerea[6]);
	    	$ProbabilidadTotalFuerzaAerea=$PCAF*$PCCF*$PCAFCCF*100;
	    	//dd($RespuestaAlgoritmoFuerzaAerea);
	    	$PCAA=$RespuestaAlgoritmoArmada[8]/$totalPrestamos;
	    	$PCCA=$RespuestaAlgoritmoArmada[6]/$RespuestaAlgoritmoArmada[8];
	    	$PCAACCA=1-($RespuestaAlgoritmoArmada[7]/$RespuestaAlgoritmoArmada[6]);
	    	$ProbabilidadTotalArmada=$PCAA*$PCCA*$PCAACCA*100;

	    	$PCAN=$RespuestaAlgoritmoNaval[8]/$totalPrestamos;
	    	$PCCN=$RespuestaAlgoritmoNaval[6]/$RespuestaAlgoritmoNaval[8];
	    	$PCANCCN=1-($RespuestaAlgoritmoNaval[7]/$RespuestaAlgoritmoNaval[6]);
	    	$ProbabilidadTotalNaval=$PCAN*$PCCN*$PCANCCN*100;

			$RespuestaInformacionProbabilidad = array();
			$RespuestaInformacionProbabilidad[]=round($ProbabilidadTotalEjercito,2);
			$RespuestaInformacionProbabilidad[]=round($ProbabilidadTotalNaval,2);
			$RespuestaInformacionProbabilidad[]=round($ProbabilidadTotalArmada,2);
			$RespuestaInformacionProbabilidad[]=round($ProbabilidadTotalFuerzaAerea,2);
			$RespuestaInformacionProbabilidad[]=$ProbabilidadTotalEjercito+$ProbabilidadTotalNaval+$ProbabilidadTotalArmada+$ProbabilidadTotalFuerzaAerea;
			$RespuestaInformacionProbabilidad[]=$PCAE;
			$RespuestaInformacionProbabilidad[]=$PCCE;
			$RespuestaInformacionProbabilidad[]=$PCAECCE;
			$RespuestaInformacionProbabilidad[]=$PCAF;
			$RespuestaInformacionProbabilidad[]=$PCCF;
			$RespuestaInformacionProbabilidad[]=$PCAFCCF;
			$RespuestaInformacionProbabilidad[]=$PCAA;
			$RespuestaInformacionProbabilidad[]=$PCCA;
			$RespuestaInformacionProbabilidad[]=$PCAACCA;
			$RespuestaInformacionProbabilidad[]=$PCAN;
			$RespuestaInformacionProbabilidad[]=$PCCN;
			$RespuestaInformacionProbabilidad[]=$PCANCCN;
			$RespuestaInformacionProbabilidad[]=$totalPrestamos;

			return $RespuestaInformacionProbabilidad;

		} catch (\Exception $e) {
    		return "FALLO 9";
    	}
    }

    /**
    *Metodo encargado de consultar la información sobre la
    *poblacion de la fuerza militar del ejercito
    */
    public function Consultar_Informacion_Ejercito(){

    	try {
    		
    		$ResultadoTotalPrestamos=DB::table('MGN_Informacion_Prestamo')->get();
	    	$ResultadoConsultaPrestamosEjercito = DB::table('MGN_Informacion_Prestamo')->where('FuerzaMilitar',1)->where('EstadoPrestamo',"APROBADO")->get();
	    	$PlazoTotalesEjercito=0;
	    	$TotalMesesCanceladosEjercito=0;
	    	$TotalPrestamos=count($ResultadoTotalPrestamos);
	    	$TotalMiembrosEjercito=count($ResultadoConsultaPrestamosEjercito);


	    	foreach ($ResultadoConsultaPrestamosEjercito as $apuntador) {
	    		
	    		$PlazoTotalesEjercito=$PlazoTotalesEjercito+$apuntador->PlazoPrestamo;
	    		$ResultadoConsultaAmortizacionEjercito = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$apuntador->PK)->where('Estado',"CANCELADO")->get();
	    		$TotalMesesCanceladosEjercito=$TotalMesesCanceladosEjercito+count($ResultadoConsultaAmortizacionEjercito);

	    	}

	    	$ProbabilidadPagarEjercito=$TotalMesesCanceladosEjercito/$PlazoTotalesEjercito;
	    	$ProbabilidadPagarEjercito=$ProbabilidadPagarEjercito*100;

	    	$ProbabilidadNoPagarEjercito=$PlazoTotalesEjercito-$TotalMesesCanceladosEjercito;
	    	$ProbabilidadNoPagarEjercito=$ProbabilidadNoPagarEjercito/$PlazoTotalesEjercito;
	    	$ProbabilidadNoPagarEjercito=$ProbabilidadNoPagarEjercito*100;

	    	$ProbabilidadEjercito=$TotalMiembrosEjercito/$TotalPrestamos;
	    	$ProbabilidadEjercito=$ProbabilidadEjercito*100;

	    	$TotalCreditoEnMora=0;
	    	$ResultadoConsultaPrestamosEjercitoCancelados = DB::table('MGN_Informacion_Prestamo')->where('FuerzaMilitar',1)->where('EstadoPrestamo',"CANCELADO")->get();
	    	foreach ($ResultadoConsultaPrestamosEjercitoCancelados as $apuntador) {
	    		$ResultadoConsultaAmortizacionEjercitoTotal = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$apuntador->PK)->get();
	    		foreach ($ResultadoConsultaAmortizacionEjercitoTotal as $apuntador_auxiliar) {
	    			if($apuntador_auxiliar->InteresMora>0){
	    				$TotalCreditoEnMora=$TotalCreditoEnMora+1;
	    				break;
	    			}
	    		}
	    	}

	    	$ResultadoConsultaPrestamosEjercitoAprobadoCancelado = DB::table('MGN_Informacion_Prestamo')
		            ->where('FuerzaMilitar',1)
		            ->where(function($query) {
		                $query->orWhere('EstadoPrestamo',"APROBADO")->orWhere('EstadoPrestamo',"CANCELADO");
		            })
		            ->get();

	    	$RespuestaInformacionEjercito = array();
	    	$RespuestaInformacionEjercito[]=$ProbabilidadPagarEjercito;
	    	$RespuestaInformacionEjercito[]=$ProbabilidadNoPagarEjercito;
	    	$RespuestaInformacionEjercito[]=$ProbabilidadEjercito;
	    	$RespuestaInformacionEjercito[]=$TotalMesesCanceladosEjercito;
	    	$RespuestaInformacionEjercito[]=$PlazoTotalesEjercito-$TotalMesesCanceladosEjercito;
	    	$RespuestaInformacionEjercito[]=$TotalPrestamos;
	    	$RespuestaInformacionEjercito[]=count($ResultadoConsultaPrestamosEjercitoCancelados);
	    	$RespuestaInformacionEjercito[]=$TotalCreditoEnMora;
	    	$RespuestaInformacionEjercito[]=count($ResultadoConsultaPrestamosEjercitoAprobadoCancelado);

	    	return $RespuestaInformacionEjercito;

    	} catch (\Exception $e) {
    		return "FALLO 1";
    	}
    }

    /**
    *Metodo encargado de consultar la información sobre la
    *poblacion de la fuerza militar de la fuerza aerea
    */
    public function Consultar_Informacion_Fuerza_Aerea(){

    	try {
    		
    		$ResultadoTotalPrestamos=DB::table('MGN_Informacion_Prestamo')->get();
	    	$ResultadoConsultaPrestamosAerea = DB::table('MGN_Informacion_Prestamo')->where('FuerzaMilitar',2)->where('EstadoPrestamo',"APROBADO")->get();
	    	$PlazoTotalesAerea=0;
	    	$TotalCreditoEnMora=0;
	    	$TotalMesesCanceladosAerea=0;
	    	$TotalPrestamos=count($ResultadoTotalPrestamos);
	    	$TotalMiembrosAerea=count($ResultadoConsultaPrestamosAerea);


	    	foreach ($ResultadoConsultaPrestamosAerea as $apuntador) {
	    		
	    		$PlazoTotalesAerea=$PlazoTotalesAerea+$apuntador->PlazoPrestamo;
	    		$ResultadoConsultaAmortizacionAerea = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$apuntador->PK)->where('Estado',"CANCELADO")->get();
	    		foreach ($ResultadoConsultaAmortizacionAerea as $apuntador) {
	    			if(!is_null($apuntador->InteresMora)){
	    				$TotalCreditoEnMora=$TotalCreditoEnMora+1;
	    				break;
	    			}
	    		}
	    		$TotalMesesCanceladosAerea=$TotalMesesCanceladosAerea+count($ResultadoConsultaAmortizacionAerea);

	    	}

	    	$ProbabilidadPagarAerea=$TotalMesesCanceladosAerea/$PlazoTotalesAerea;
	    	$ProbabilidadPagarAerea=$ProbabilidadPagarAerea*100;

	    	$ProbabilidadNoPagarAerea=$PlazoTotalesAerea-$TotalMesesCanceladosAerea;
	    	$ProbabilidadNoPagarAerea=$ProbabilidadNoPagarAerea/$PlazoTotalesAerea;
	    	$ProbabilidadNoPagarAerea=$ProbabilidadNoPagarAerea*100;

	    	$ProbabilidadAerea=$TotalMiembrosAerea/$TotalPrestamos;
	    	$ProbabilidadAerea=$ProbabilidadAerea*100;

	    	
	    	$TotalCreditoEnMora=0;
	    	$ResultadoConsultaPrestamosAereaCancelados = DB::table('MGN_Informacion_Prestamo')->where('FuerzaMilitar',2)->where('EstadoPrestamo',"CANCELADO")->get();
	    	foreach ($ResultadoConsultaPrestamosAereaCancelados as $apuntador) {
	    		$ResultadoConsultaAmortizacionAereaTotal = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$apuntador->PK)->get();
	    		foreach ($ResultadoConsultaAmortizacionAereaTotal as $apuntador_auxiliar) {
	    			if($apuntador_auxiliar->InteresMora>0){
	    				$TotalCreditoEnMora=$TotalCreditoEnMora+1;
	    				break;
	    			}
	    		}
	    	}

	    	$ResultadoConsultaPrestamosAereaAprobadoCancelado = DB::table('MGN_Informacion_Prestamo')
		            ->where('FuerzaMilitar',2)
		            ->where(function($query) {
		                $query->orWhere('EstadoPrestamo',"APROBADO")->orWhere('EstadoPrestamo',"CANCELADO");
		            })
		            ->get();

	    	$RespuestaInformacionAerea = array();
	    	$RespuestaInformacionAerea[]=$ProbabilidadPagarAerea;
	    	$RespuestaInformacionAerea[]=$ProbabilidadNoPagarAerea;
	    	$RespuestaInformacionAerea[]=$ProbabilidadAerea;
	    	$RespuestaInformacionAerea[]=$TotalMesesCanceladosAerea;
	    	$RespuestaInformacionAerea[]=$PlazoTotalesAerea-$TotalMesesCanceladosAerea;
	    	$RespuestaInformacionAerea[]=$TotalPrestamos;
	    	$RespuestaInformacionAerea[]=count($ResultadoConsultaPrestamosAereaCancelados);
	    	$RespuestaInformacionAerea[]=$TotalCreditoEnMora;
	    	$RespuestaInformacionAerea[]=count($ResultadoConsultaPrestamosAereaAprobadoCancelado);

	    	return $RespuestaInformacionAerea;

    	} catch (\Exception $e) {
    		return "FALLO 2";
    	}
    }

    /**
    *Metodo encargado de consultar la información sobre la
    *poblacion de la fuerza militar de la armada
    */
    public function Consultar_Informacion_Armada(){

    	try {
    		
    		$ResultadoTotalPrestamos=DB::table('MGN_Informacion_Prestamo')->get();
	    	$ResultadoConsultaPrestamosArmada = DB::table('MGN_Informacion_Prestamo')->where('FuerzaMilitar',3)->where('EstadoPrestamo',"APROBADO")->get();
	    	$PlazoTotalesArmada=0;
	    	$TotalCreditoEnMora=0;
	    	$TotalMesesCanceladosArmada=0;
	    	$TotalPrestamos=count($ResultadoTotalPrestamos);
	    	$TotalMiembrosArmada=count($ResultadoConsultaPrestamosArmada);


	    	foreach ($ResultadoConsultaPrestamosArmada as $apuntador) {
	    		
	    		$PlazoTotalesArmada=$PlazoTotalesArmada+$apuntador->PlazoPrestamo;
	    		$ResultadoConsultaAmortizacionArmada = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$apuntador->PK)->where('Estado',"CANCELADO")->get();
	    		foreach ($ResultadoConsultaAmortizacionArmada as $apuntador) {
	    			if(!is_null($apuntador->InteresMora)){
	    				$TotalCreditoEnMora=$TotalCreditoEnMora+1;
	    				break;
	    			}
	    		}
	    		$TotalMesesCanceladosArmada=$TotalMesesCanceladosArmada+count($ResultadoConsultaAmortizacionArmada);

	    	}

	    	$ProbabilidadPagarArmada=$TotalMesesCanceladosArmada/$PlazoTotalesArmada;
	    	$ProbabilidadPagarArmada=$ProbabilidadPagarArmada*100;

	    	$ProbabilidadNoPagarArmada=$PlazoTotalesArmada-$TotalMesesCanceladosArmada;
	    	$ProbabilidadNoPagarArmada=$ProbabilidadNoPagarArmada/$PlazoTotalesArmada;
	    	$ProbabilidadNoPagarArmada=$ProbabilidadNoPagarArmada*100;

	    	$ProbabilidadArmada=$TotalMiembrosArmada/$TotalPrestamos;
	    	$ProbabilidadArmada=$ProbabilidadArmada*100;
	    	
	    	$TotalCreditoEnMora=0;
	    	$ResultadoConsultaPrestamosArmadaCancelados = DB::table('MGN_Informacion_Prestamo')->where('FuerzaMilitar',3)->where('EstadoPrestamo',"CANCELADO")->get();
	    	foreach ($ResultadoConsultaPrestamosArmadaCancelados as $apuntador) {
	    		$ResultadoConsultaAmortizacionArmadaTotal = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$apuntador->PK)->get();
	    		foreach ($ResultadoConsultaAmortizacionArmadaTotal as $apuntador_auxiliar) {
	    			if($apuntador_auxiliar->InteresMora>0){
	    				$TotalCreditoEnMora=$TotalCreditoEnMora+1;
	    				break;
	    			}
	    		}
	    	}

	    	$ResultadoConsultaPrestamosArmadaAprobadoCancelado = DB::table('MGN_Informacion_Prestamo')
		            ->where('FuerzaMilitar',3)
		            ->where(function($query) {
		                $query->orWhere('EstadoPrestamo',"APROBADO")->orWhere('EstadoPrestamo',"CANCELADO");
		            })
		            ->get();

	    	$RespuestaInformacionArmada = array();
	    	$RespuestaInformacionArmada[]=$ProbabilidadPagarArmada;
	    	$RespuestaInformacionArmada[]=$ProbabilidadNoPagarArmada;
	    	$RespuestaInformacionArmada[]=$ProbabilidadArmada;
	    	$RespuestaInformacionArmada[]=$TotalMesesCanceladosArmada;
	    	$RespuestaInformacionArmada[]=$PlazoTotalesArmada-$TotalMesesCanceladosArmada;
	    	$RespuestaInformacionArmada[]=$TotalPrestamos;
	    	$RespuestaInformacionArmada[]=count($ResultadoConsultaPrestamosArmadaCancelados);
	    	$RespuestaInformacionArmada[]=$TotalCreditoEnMora;
	    	$RespuestaInformacionArmada[]=count($ResultadoConsultaPrestamosArmadaAprobadoCancelado);

	    	return $RespuestaInformacionArmada;

    	} catch (\Exception $e) {
    		return "FALLO 3";
    	}
    }

    /**
    *Metodo encargado de consultar la información sobre la
    *poblacion de la fuerza militar de la naval
    */
    public function Consultar_Informacion_Naval(){

    	try {
    		
    		$ResultadoTotalPrestamos=DB::table('MGN_Informacion_Prestamo')->get();
	    	$ResultadoConsultaPrestamosNaval = DB::table('MGN_Informacion_Prestamo')->where('FuerzaMilitar',4)->where('EstadoPrestamo',"APROBADO")->get();
	    	$PlazoTotalesNaval=0;
	    	$TotalMesesCanceladosNaval=0;
	    	$TotalCreditoEnMora=0;
	    	$TotalPrestamos=count($ResultadoTotalPrestamos);
	    	$TotalMiembrosNaval=count($ResultadoConsultaPrestamosNaval);


	    	foreach ($ResultadoConsultaPrestamosNaval as $apuntador) {
	    		
	    		$PlazoTotalesNaval=$PlazoTotalesNaval+$apuntador->PlazoPrestamo;
	    		$ResultadoConsultaAmortizacionNaval = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$apuntador->PK)->where('Estado',"CANCELADO")->get();
	    		foreach ($ResultadoConsultaAmortizacionNaval as $apuntador) {
	    			if(!is_null($apuntador->InteresMora)){
	    				$TotalCreditoEnMora=$TotalCreditoEnMora+1;
	    				break;
	    			}
	    		}
	    		$TotalMesesCanceladosNaval=$TotalMesesCanceladosNaval+count($ResultadoConsultaAmortizacionNaval);

	    	}

	    	$ProbabilidadPagarNaval=$TotalMesesCanceladosNaval/$PlazoTotalesNaval;
	    	$ProbabilidadPagarNaval=$ProbabilidadPagarNaval*100;

	    	$ProbabilidadNoPagarNaval=$PlazoTotalesNaval-$TotalMesesCanceladosNaval;
	    	$ProbabilidadNoPagarNaval=$ProbabilidadNoPagarNaval/$PlazoTotalesNaval;
	    	$ProbabilidadNoPagarNaval=$ProbabilidadNoPagarNaval*100;

	    	$ProbabilidadNaval=$TotalMiembrosNaval/$TotalPrestamos;
	    	$ProbabilidadNaval=$ProbabilidadNaval*100;

	    	$TotalCreditoEnMora=0;
	    	$ResultadoConsultaPrestamosNavalCancelados = DB::table('MGN_Informacion_Prestamo')->where('FuerzaMilitar',4)->where('EstadoPrestamo',"CANCELADO")->get();
	    	foreach ($ResultadoConsultaPrestamosNavalCancelados as $apuntador) {
	    		$ResultadoConsultaAmortizacionNavalTotal = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$apuntador->PK)->get();
	    		foreach ($ResultadoConsultaAmortizacionNavalTotal as $apuntador_auxiliar) {
	    			if($apuntador_auxiliar->InteresMora>0){
	    				$TotalCreditoEnMora=$TotalCreditoEnMora+1;
	    				break;
	    			}
	    		}
	    	}

	    	$ResultadoConsultaPrestamosNavalAprobadoCancelado = DB::table('MGN_Informacion_Prestamo')
		            ->where('FuerzaMilitar',4)
		            ->where(function($query) {
		                $query->orWhere('EstadoPrestamo',"APROBADO")->orWhere('EstadoPrestamo',"CANCELADO");
		            })
		            ->get();

	    	$RespuestaInformacionNaval = array();
	    	$RespuestaInformacionNaval[]=$ProbabilidadPagarNaval;
	    	$RespuestaInformacionNaval[]=$ProbabilidadNoPagarNaval;
	    	$RespuestaInformacionNaval[]=$ProbabilidadNaval;
	    	$RespuestaInformacionNaval[]=$TotalMesesCanceladosNaval;
	    	$RespuestaInformacionNaval[]=$PlazoTotalesNaval-$TotalMesesCanceladosNaval;
	    	$RespuestaInformacionNaval[]=$TotalPrestamos;
	    	$RespuestaInformacionNaval[]=count($ResultadoConsultaPrestamosNavalCancelados);
	    	$RespuestaInformacionNaval[]=$TotalCreditoEnMora;
	    	$RespuestaInformacionNaval[]=count($ResultadoConsultaPrestamosNavalAprobadoCancelado);

	    	return $RespuestaInformacionNaval;

    	} catch (\Exception $e) {
    		return "FALLO 4";
    	}
    }

    /**
    *Metodo encargado de redireccionar todos los mensajes de errores con respecto
    *a la aplicacion del algoritmo Naive Bayes
    */
    private function Redireccionar_Mensajes_Fallos($TipoFallo){

    	if($TipoFallo==1){
    		return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo la consulta de la probabilidad del ejercito.");
    	}else{
    		if($TipoFallo==2){
	    		return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo la consulta de la probabilidad de la fuerza aerea.");
	    	}else{
	    		if($TipoFallo==3){
		    		return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo la consulta de la probabilidad de la armada.");
		    	}else{
		    		if($TipoFallo==4){
			    		return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo la consulta de la probabilidad de la naval.");
			    	}else{
			    		if($TipoFallo==5){
				    		return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo la consulta de la probabilidad de los tabajadores inpendientes.");
				    	}else{
				    		if($TipoFallo==6){
				    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo la consulta de la probabilidad de los tabajadores dependientes.");
				    		}else{
				    			if($TipoFallo==7){
					    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo la consulta de la probabilidad de los comerciantes.");
					    		}else{
					    			if($TipoFallo==8){
						    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo la consulta de la probabilidad de los empresarios.");
						    		}else{
						    			if($TipoFallo==9){
							    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo el calculo de la probabilidad.");
							    		}else{
							    			if($TipoFallo==10){
								    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo la consulta del total de cuotas en mora.");
								    		}else{
								    			if($TipoFallo==11){
									    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo el calculo del monto máximo de dinero que se puede prestar a un miembro de las fuerzas militares.");
									    		}else{
									    			if($TipoFallo==12){
										    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo el calculo del interes de la fuerza militar a la cual pertenece el cliente.");
										    		}else{
										    			if($TipoFallo==13){
											    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo el calculo del monto máximo de dinero que se puede prestar a cierta dedicación comercial.");
											    		}else{
											    			if($TipoFallo==14){
												    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo el calculo del interes de la dedicación comercial del cliente.");
												    		}else{
												    			if($TipoFallo==15){
													    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo el calculo del interes de mora.");
													    		}else{
													    			if($TipoFallo==16){
														    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo el calculo del plazo.");
														    		}else{
														    			if($TipoFallo==17){
															    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo el calculo de la cuota.");
															    		}else{
															    			if($TipoFallo==18){
																    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo realizar la aplicación del algoritmo. Fallo el calculo de la información de simulación.");
																    		}else{
																    			if($TipoFallo==19){
																	    			return redirect()->route('fallos.mensaje')->with('Fallo', "No se pudo graficar los datos obtenidos.");
																	    		}
																    		}
															    		}
														    		}
													    		}
												    		}
											    		}
										    		}
									    		}
								    		}
							    		}
						    		}
					    		}
				    		}
				    	}
			    	}
		    	}
	    	}
    	}
    }

    /**
    *Metodo encargado de retornar la vista donde se puede ver los erroes que arroja la vista
    *de estadisticas de la aplicación del algoritmo Naive Baye
    */
    public function Mostrar_Vista_Algoritmo_Fallos(){

    	$TotalCuotasCanceladasEjercito=0;
    	$TotalCuotasCanceladasNaval=0;
    	$TotalCuotasCanceladasArmada=0;
    	$TotalCuotasCanceladasFuerzaAerea=0;

    	$TotalCuotasDeudaEjercito=0;
    	$TotalCuotasDeudaFuerzaAerea=0;
    	$TotalCuotasDeudaArmada=0;
    	$TotalCuotasDeudaNaval=0;

    	$ProbabilidadTotalEjercito=0;
	    $ProbabilidadTotalNaval=0;
	    $ProbabilidadTotalArmada=0;
	    $ProbabilidadTotalFuerzaAerea=0;

	    $TotalCuotasMoraEjercito=0;
	    $TotalCuotasMoraFuerzaAerea=0;
	    $TotalCuotasMoraArmada=0;
	    $TotalCuotasMoraNaval=0;

	    $DineroSimulado=0;
	    $InteresSimulado=0;
	    $PlazoSimulado=0;
	    $CuotaSimulada=0;

	    $DineroSolicitado=0;
	    $InteresSolicitado=0;
	    $PlazoSolicitado=0;
	   	$CoutaSolicitada=0;
	   	$CedulaCliente=0;

	   	$IdPrestamo=0;
    	
    	$PCAE=0;
		$PCCE=0;
		$PCAECCE=0;
		$PCAF=0;
		$PCCF=0;
		$PCAFCCF=0;
		$PCAA=0;
		$PCCA=0;
		$PCAACCA=0;
		$PCAN=0;
		$PCCN=0;
		$PCANCCN=0;
		$totalPrestamos=0;
		$FuerzaPerteneciente=0;

		return view('Algoritmo.VMGN_Estadisticas_Algoritmo',compact('ProbabilidadTotalEjercito','ProbabilidadTotalNaval','ProbabilidadTotalArmada','ProbabilidadTotalFuerzaAerea','TotalCuotasCanceladasEjercito','TotalCuotasDeudaEjercito','TotalCuotasCanceladasFuerzaAerea','TotalCuotasDeudaFuerzaAerea','TotalCuotasCanceladasArmada','TotalCuotasDeudaArmada','TotalCuotasCanceladasNaval','TotalCuotasDeudaNaval','TotalCuotasMoraEjercito','TotalCuotasMoraFuerzaAerea','TotalCuotasMoraArmada','TotalCuotasMoraNaval','DineroSimulado','InteresSimulado','PlazoSimulado','CuotaSimulada','DineroSolicitado','InteresSolicitado','PlazoSolicitado','CoutaSolicitada','CedulaCliente','IdPrestamo','PCAE','PCCE','PCAECCE','PCAF','PCCF','PCAFCCF','PCAA','PCCA','PCAACCA','PCAN','PCCN','PCANCCN','totalPrestamos','FuerzaPerteneciente'));
    
    }





























































    public function temporal(){
    	
    	$ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('EstadoPrestamo',"SOLICITADO")->get();

    	foreach ($ResultadoConsultaPrestamos as $apuntador) {
    		
    		$FechaActual = Carbon::now();
    		$FechaPago=$FechaActual;
		    $Contador=0;
		    $Mes = $FechaActual->month;
			$AbonoCapital=0;
		    $AbonoInteres=0;
			$Saldo=$apuntador->ValorPrestamo;
			$CalularInteres=$apuntador->InteresPrestamo/100;
			$Bandera=0;

			while ($Contador <= $apuntador->PlazoPrestamo) {
				
				if($Bandera==0){

					$GuardarInformacionAmortizacion = DB::insert('INSERT INTO MGN_Informacion_Amortizacion (FK_MGN_Inf_Amortizacion, AbonoCapital,AbonoInteres,InteresMora,Saldo,Mes,Estado,FechaPago) VALUES (?,?,?,?,?,?,?,?)', [$apuntador->PK,$AbonoCapital,$AbonoInteres,0,$Saldo,$Mes,"CANCELADO",date('Y-m-d', strtotime($FechaPago))]);
		                        
					$Bandera=1;
					$Contador=$Contador+1;
					$AbonoInteres=round($Saldo*$CalularInteres,2);
					$AbonoCapital=round($apuntador->CuotaPrestamo-$AbonoInteres,2);
					$Saldo=round($Saldo-$AbonoCapital,2);

					if($Saldo<0){
						$Saldo=0;
		            }

		            $Mes=$Mes+1;
		            $FechaPago = $FechaPago->addMonth(1);

		            if($Mes==13){
		                $Mes=1;
		            }

		        }else{

		            $GuardarInformacionAmortizacion = DB::insert('INSERT INTO MGN_Informacion_Amortizacion (FK_MGN_Inf_Amortizacion, AbonoCapital,AbonoInteres,InteresMora,Saldo,Mes,Estado,FechaPago) VALUES (?,?,?,?,?,?,?,?)', [$apuntador->PK,$AbonoCapital,$AbonoInteres,0,$Saldo,$Mes,"DEBE",date('Y-m-d', strtotime($FechaPago))]);

		            $AbonoInteres=round($Saldo*$CalularInteres,2);
		            $AbonoCapital=round($apuntador->CuotaPrestamo-$AbonoInteres,2);
		            $Saldo=round($Saldo-$AbonoCapital,2);

		           	if($Saldo<0){
		            	$Saldo=0;
		            }

		            $Mes=$Mes+1;
		            $FechaPago = $FechaPago->addMonth(1);

		            if($Mes==13){
		            	$Mes=1;
		            }
					$Contador=$Contador+1;
		        }
			}

			$ActualizacionEstadoPrestamo= DB::table('MGN_Informacion_Prestamo')->where('PK', $apuntador->PK)->update(['EstadoPrestamo' => "APROBADO",'ValorPrestamo' => $apuntador->ValorPrestamo,'InteresPrestamo' => $apuntador->InteresPrestamo,'PlazoPrestamo' => $apuntador->PlazoPrestamo,'CuotaPrestamo' => $apuntador->CuotaPrestamo]);	
    	}
    }
}
