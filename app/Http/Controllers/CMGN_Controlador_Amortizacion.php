<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use DB;
use Illuminate\Http\Request;

class CMGN_Controlador_Amortizacion extends Controller
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
    *Metodo encargado de generar y guardar la amortización calculada
    */
    public function Calcular_Amortizacion($IdPrestamo,$ValorPrestamo,$InteresPrestamo,$PlazoPrestamo,$CuotaPrestamo){
    	
    	try {

    		$FechaActual = Carbon::now();
    		$FechaPago=$FechaActual;
		    $Contador=0;
		    $Mes = $FechaActual->month;
			$AbonoCapital=0;
		    $AbonoInteres=0;
			$Saldo=$ValorPrestamo;
			$CalularInteres=$InteresPrestamo/100;
			$Bandera=0;

			while ($Contador <= $PlazoPrestamo) {
				
				if($Bandera==0){

					$GuardarInformacionAmortizacion = DB::insert('INSERT INTO MGN_Informacion_Amortizacion (FK_MGN_Inf_Amortizacion, AbonoCapital,AbonoInteres,InteresMora,Saldo,Mes,Estado,FechaPago) VALUES (?,?,?,?,?,?,?,?)', [$IdPrestamo,$AbonoCapital,$AbonoInteres,0,$Saldo,$Mes,"CANCELADO",date('Y-m-d', strtotime($FechaPago))]);
		                        
					$Bandera=1;
					$Contador=$Contador+1;
					$AbonoInteres=round($Saldo*$CalularInteres,2);
					$AbonoCapital=round($CuotaPrestamo-$AbonoInteres,2);
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

		            $GuardarInformacionAmortizacion = DB::insert('INSERT INTO MGN_Informacion_Amortizacion (FK_MGN_Inf_Amortizacion, AbonoCapital,AbonoInteres,InteresMora,Saldo,Mes,Estado,FechaPago) VALUES (?,?,?,?,?,?,?,?)', [$IdPrestamo,$AbonoCapital,$AbonoInteres,0,$Saldo,$Mes,"DEBE",date('Y-m-d', strtotime($FechaPago))]);

		            $AbonoInteres=round($Saldo*$CalularInteres,2);
		            $AbonoCapital=round($CuotaPrestamo-$AbonoInteres,2);
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

			$ActualizacionEstadoPrestamo= DB::table('MGN_Informacion_Prestamo')->where('PK', $IdPrestamo)->update(['EstadoPrestamo' => "APROBADO",'ValorPrestamo' => $ValorPrestamo,'InteresPrestamo' => $InteresPrestamo,'PlazoPrestamo' => $PlazoPrestamo,'CuotaPrestamo' => $CuotaPrestamo]);
			return $this->Redireccionar_Mensajes_Exitosos(2,$IdPrestamo);

    	} catch (\Exception $e) {
    		return $this->Redireccionar_Mensajes_Fallos(1,$IdPrestamo);
    	}
    }

    /**
    *Metodo encargado de rechazar el credito solicitado
    */
    public function Negar_Solicitud_Credito($IdPrestamo){

    	try {

    		$ActualizaciónEstadoPrestamo= DB::table('MGN_Informacion_Prestamo')->where('PK', $IdPrestamo)->update(['EstadoPrestamo' => "RECHAZADO"]);
    		return $this->Redireccionar_Mensajes_Exitosos(1,$IdPrestamo);

    	} catch (\Exception $e) {
    		return $this->Redireccionar_Mensajes_Fallos(2,$IdPrestamo);
    	}
    }

    /**
    *Metodo encargado de redireccionar todos los mensajes de errores con respecto
    *a la aprobación o negacion del prestamo
    */
    private function Redireccionar_Mensajes_Fallos($TipoFallo,$IdPrestamo){

    	if($TipoFallo==1){
    		return redirect()->route('algoritmo.mensaje',['IdPrestamo' => $IdPrestamo])->with('Fallo', "Fallo la aprobación. No se pudo aprobar el prestamo.");
    	}else{
    		if($TipoFallo==2){
	    		return redirect()->route('algoritmo.mensaje',['IdPrestamo' => $IdPrestamo])->with('Fallo', "Fallo la NO aprobación del prestamo. No se pudo negar el prestamo.");
	    	}else{
	    		if($TipoFallo==3){
	    			return redirect()->route('prestamossolicitados.mensaje')->with('Fallo', "Fallo el cargue de la informacón de la amortización.");
	    		}else{
	    			if($TipoFallo==4){
		    			return redirect()->route('amortización.mensaje',['IdPrestamo' => $IdPrestamo])->with('Fallo', "Fallo la cancelación de la cuota. No se pudo realizar el pago de la cuota.");
		    		}
	    		}
	    	}
    	}
    }

    /**
    *Metodo encargado de redireccionar todos los mensajes de éxito con respecto
    *a la aprobación o negacion del prestamo
    */
    private function Redireccionar_Mensajes_Exitosos($TipoExito,$IdPrestamo){

    	if($TipoExito==1){
    		return redirect()->route('prestamossolicitados.mensaje')->with('Exito', "Éxito, No se aprobo el prestamo.");
    	}else{
    		if($TipoExito==2){
    			return redirect()->route('amortización.mensaje',['IdPrestamo' => $IdPrestamo])->with('Exito', "Éxito, Se aprobo el prestamo.");
    		}else{
    			if($TipoExito==3){
	    			return redirect()->route('amortización.mensaje',['IdPrestamo' => $IdPrestamo])->with('Exito', "Éxito, Se realizo el pago de la cuota.");
	    		}else{
	    			if($TipoExito==4){
		    			return redirect()->route('prestamosaprobados.mensaje',['IdPrestamo' => $IdPrestamo])->with('Exito', "Éxito, Se realizo el pago de la cuota y el prestamo se a cancelado en su totalidad.");
		    		}
	    		}	
    		}
    	}
    }

    /**
    *Metodo encargado de cargar la vista donde se puede ver la amortización creada
  	*despues de la aprobación del prestamo
    */
    public function Mostrar_Vista_Amortización($IdPrestamo){

    	try {
    		
    		$ResultadoConsultaAmortizacion = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$IdPrestamo)->get();
    		return view('Prestamo.VMGN_Amortizacion_Prestamo',compact('ResultadoConsultaAmortizacion'));

    	} catch (\Exception $e) {
    		return $this->Redireccionar_Mensajes_Fallos(3,$IdPrestamo);
    	}
    }

    /**
    *Metodo encargado de realizar el pago de la cuota del prestamo
    */
    public function Pagar_Couta_Prestamo($IdAmortizacion){

    	$ResultadoConsultaAmortizacionPrimerRegistro = DB::table('MGN_Informacion_Amortizacion')->where('PK', $IdAmortizacion)->first();

    	try {
    		
    		$ActualizacionInformacionAmortizacion= DB::table('MGN_Informacion_Amortizacion')->where('PK', $IdAmortizacion)->update(['Estado' => "CANCELADO"]);
	    	$ResultadoConsultaAmortizacionCancelado = DB::table('MGN_Informacion_Amortizacion')->where('Estado',"CANCELADO")->where('FK_MGN_Inf_Amortizacion',$ResultadoConsultaAmortizacionPrimerRegistro->FK_MGN_Inf_Amortizacion)->get();
	    	$ResultadoConsultaAmortizacionTotal = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$ResultadoConsultaAmortizacionPrimerRegistro->FK_MGN_Inf_Amortizacion)->get();

	    	if(count($ResultadoConsultaAmortizacionTotal)==count($ResultadoConsultaAmortizacionCancelado)){
	    		$ActualizacionInformacionPrestamo= DB::table('MGN_Informacion_Prestamo')->where('PK', $ResultadoConsultaAmortizacionPrimerRegistro->FK_MGN_Inf_Amortizacion)->update(['EstadoPrestamo' => "CANCELADO"]);
	    		return $this->Redireccionar_Mensajes_Exitosos(4	,$ResultadoConsultaAmortizacionPrimerRegistro->FK_MGN_Inf_Amortizacion);
	    	}

	    	return $this->Redireccionar_Mensajes_Exitosos(3,$ResultadoConsultaAmortizacionPrimerRegistro->FK_MGN_Inf_Amortizacion);

    	} catch (\Exception $e) {
    		return $this->Redireccionar_Mensajes_Fallos(4,$ResultadoConsultaAmortizacionPrimerRegistro->FK_MGN_Inf_Amortizacion);
    	}
    }
}
