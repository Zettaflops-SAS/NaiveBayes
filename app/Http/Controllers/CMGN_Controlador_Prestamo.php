<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class CMGN_Controlador_Prestamo extends Controller
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
    *Metodo encargado de retornar la vista donde se puede solicitar el credito
    */
    public function Mostrar_Vista_Prestamo(){
    	return view('Prestamo.VMGN_Solicitar_Informacion_Prestamo');
    }

    /**
    *Metodo encargado de guardar la información de la solicitud de credito
    */
    public function Solicitar_Credito(Request $request){

    	$RespuestaCuota=$this->Calcular_Cuota($request->input('CVMGN_Interes_prestamo'),$request->input('CVMGN_Plazo_Prestamo'),$request->input('CVMGN_Dinero_Solicitado'));
    	
    	if($RespuestaCuota==-1){
    		return $this->Redireccionar_Mensajes_Fallos(1);
    	}else{

    		try {

    			$EstadoSolicitudPrestamo='SOLICITADO';
    			$GuardarInformacionSolicitudPrestamo = DB::insert('INSERT INTO MGN_Informacion_Prestamo (ValorPrestamo, InteresPrestamo,PlazoPrestamo,CuotaPrestamo,CedulaCliente,FuerzaMilitar,EstadoPrestamo) VALUES (?,?,?,?,?,?,?)', [$request->input('CVMGN_Dinero_Solicitado'), $request->input('CVMGN_Interes_prestamo'),$request->input('CVMGN_Plazo_Prestamo'),$RespuestaCuota,$request->input('CVMGN_Numero_Identificacion'),$request->input('CVMGN_Fuerza_Militar'),$EstadoSolicitudPrestamo]);
    			return $this->Redireccionar_Mensajes_Exitosos(1);

    		} catch (\Exception $e) {
    			return $this->Redireccionar_Mensajes_Fallos(2);
    		}
    	}
    }

    /**
    *Metodo encargado de calcular la cuota que debe pagar el cliente
    */
    public function Calcular_Cuota($InteresPrestamo,$PlazoPrestamo,$DineroSolicitado){

    	try {

    		$InteresDividido=$InteresPrestamo/100;
	    	$NumeroElevado=pow(1+$InteresDividido, $PlazoPrestamo);
	    	$NumeradorEcuacion=$NumeroElevado*$InteresDividido;
	    	$DenominadorEcuacion=$NumeroElevado-1;
	    	$ResultadoEcuacion=$NumeradorEcuacion/$DenominadorEcuacion;
	    	$Cuota=$DineroSolicitado*$ResultadoEcuacion;
	    	$Cuota=round($Cuota, 2);
	    	return $Cuota;

    	} catch (\Exception $e) {
    		return -1;
    	}
    }

    /**
    *Metodo encargado de redireccionar todos los mensajes de errores con respecto a los prestamos
    */
    private function Redireccionar_Mensajes_Fallos($TipoFallo){

    	if($TipoFallo==1){
    		return redirect()->route('prestamo.mensaje')->with('Fallo', "No se pudo realizar la solicitud. Fallo el calculo de la cuota.");
    	}else{
    		if($TipoFallo==2){
    			return redirect()->route('prestamo.mensaje')->with('Fallo', "No se pudo realizar la solicitud. Fallo en la inserción de la información.");
    		}else{
    			if($TipoFallo==3){
    				return redirect()->route('prestamossolicitadosfallos.mensaje')->with('Fallo', "No se pudo realizar la consulta de los prestamos solicitados. Fallo la consulta.");
    			}else{
    				if($TipoFallo==4){
	    				return redirect()->route('prestamossolicitadosfallos.mensaje')->with('Fallo', "No se pudo filtrar los prestamos. Fallo la consulta.");
	    			}else{
	    				if($TipoFallo==5){
		    				return redirect()->route('prestamossolicitadosfallos.mensaje')->with('Alerta', "No se encontro información relacionada con el N° de Identificación ingresado.");
		    			}else{
                            if($TipoFallo==6){
                                return redirect()->route('prestamosaprobadosfallos.mensaje')->with('Fallo', "No se pudo cargar la información de los prestamos aprobados.");
                            }else{
                               if($TipoFallo==7){
                                    return redirect()->route('prestamosaprobadosfallos.mensaje')->with('Fallo', "No se pudo realizar la consulta de los prestamos aprobados. Fallo la consulta.");
                                }else{
                                    if($TipoFallo==8){
                                        return redirect()->route('prestamosaprobadosfallos.mensaje')->with('Alerta', "No se encontro información relacionada con el N° de Identificación ingresado.");
                                    }else{
                                        if($TipoFallo==9){
                                            return redirect()->route('prestamosnoaprobadosocanceladosfallos.mensaje')->with('Fallo', "No se pudo realizar la consulta de los prestamos NO aprobados o prestamos cancelados. Fallo la consulta.");
                                        }else{
                                           if($TipoFallo==10){
                                                return redirect()->route('prestamosnoaprobadosocanceladosfallos.mensaje')->with('Fallo', "No se pudo realizar la consulta de los prestamos NO aprobados o prestamos cancelados para el usuario en específico. Fallo la consulta.");
                                            }else{
                                                if($TipoFallo==11){
                                                    return redirect()->route('prestamosnoaprobadosocanceladosfallos.mensaje')->with('Alerta', "No se encontro información relacionada con el N° de Identificación ingresado.");
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
    *Metodo encargado de redireccionar todos los mensajes de éxito con respecto a los prestamos
    */
    private function Redireccionar_Mensajes_Exitosos($TipoExito){

    	if($TipoExito==1){
    		return redirect()->route('prestamo.mensaje')->with('Exito', "Éxito, se almaceno su solicitud.");
    	}
    }

    /**
    *Metodo encargado de retornar la vista donde se puede ver los erroes que arroja la vista
    *de prestamos solitados
    */
    public function Mostrar_Vista_Prestamo_Fallos(){

    	$ResultadoConsultaPrestamos = array();
    	return view('Prestamo.VMGN_Prestamos_Solicitados',compact('ResultadoConsultaPrestamos'));
    }

    /**
    *Metodo encargado de retornar la vista donde se puede ver todos los prestamos solicitados
	*/
	public function Mostrar_Vista_Solicitud_Prestamos(){

		try {

    		$ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('EstadoPrestamo',"SOLICITADO")->paginate(10);
    		return view('Prestamo.VMGN_Prestamos_Solicitados',compact('ResultadoConsultaPrestamos'));

    	} catch (\Exception $e) {
    		return $this->Redireccionar_Mensajes_Fallos(3);
    	}
	}

	/**
    *Metodo encargado de retornar la vista donde se puede ver los prestamos solicitados por un usuario en específico
	*/
	public function Mostrar_Vista_Solicitud_Prestamos_Filtrados(Request $request){

		try {

    		$ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('CedulaCliente', $request->input('CVMGN_Numero_Documento'))->paginate(10);

    		if(count($ResultadoConsultaPrestamos)==0){
    			return $this->Redireccionar_Mensajes_Fallos(5);
    		}else{
    			return view('Prestamo.VMGN_Prestamos_Solicitados',compact('ResultadoConsultaPrestamos'));
    		}

    	} catch (\Exception $e) {
    		return $this->Redireccionar_Mensajes_Fallos(4);
    	}
	}

    /**
    *Metodo encargado de retornar la vista done se puede ver todos los prestamos aprobados
    */
    public function Mostrar_Vista_Prestamo_Aprobado(){

        try {

            $ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('EstadoPrestamo',"APROBADO")->paginate(10);
            return view('Prestamo.VMGN_Prestamos_Aprobados',compact('ResultadoConsultaPrestamos'));

        } catch (\Exception $e) {
            return $this->Redireccionar_Mensajes_Fallos(6);
        }
    }

    /**
    *Metodo encargado de retornar la vista donde se puede ver los erroes que arroja la vista
    *de prestamos aprobados
    */
    public function Mostrar_Vista_Prestamo_Aprobados_Fallos(){

        $ResultadoConsultaPrestamos = array();
        return view('Prestamo.VMGN_Prestamos_Aprobados',compact('ResultadoConsultaPrestamos'));
    }

    /**
    *Metodo encargado de retornar la vista donde se puede ver los prestamos aprobados por un usuario en específico
    */
    public function Mostrar_Vista_Aprobados_Prestamos_Filtrados(Request $request){
        
        try {

            $ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('CedulaCliente', $request->input('CVMGN_Numero_Documento'))->paginate(10);

            if(count($ResultadoConsultaPrestamos)==0){
                return $this->Redireccionar_Mensajes_Fallos(8);
            }else{
                return view('Prestamo.VMGN_Prestamos_Aprobados',compact('ResultadoConsultaPrestamos'));
            }

        } catch (\Exception $e) {
            return $this->Redireccionar_Mensajes_Fallos(7);
        }
    }

    /**
    *Metodo encargado de retornar la vista done se puede ver todos los prestamos no aprobados
    *o cancelados en su totalidad
    */
    public function Mostrar_Vista_Prestamo_No_Aprobado_O_Cancelado(){

        try {

            $ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('EstadoPrestamo', "RECHAZADO")->orWhere('EstadoPrestamo', 'CANCELADO')->orderByRaw('EstadoPrestamo')->paginate(10);
            return view('Prestamo.VMGN_Prestamos_No_Aprobados_O_Cancelados',compact('ResultadoConsultaPrestamos'));

        } catch (\Exception $e) {
            return $this->Redireccionar_Mensajes_Fallos(9);
        }
    }

    /**
    *Metodo encargado de retornar la vista donde se puede ver los erroes que arroja la vista
    *de prestamos no aprobados y los prestamos cancelados en su totalidad
    */
    public function Mostrar_Vista_Prestamo_No_Aprobados_O_Cancelados_Fallos(){

        $ResultadoConsultaPrestamos = array();
        return view('Prestamo.VMGN_Prestamos_No_Aprobados_O_Cancelados',compact('ResultadoConsultaPrestamos'));
    }

    /**
    *Metodo encargado de retornar la vista donde se puede ver los prestamos aprobados por un usuario en específico
    */
    public function Mostrar_Vista_No_Aprobados_O_Cancelados_Prestamos_Filtrados(Request $request){
        
        try {

            $ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('CedulaCliente', $request->input('CVMGN_Numero_Documento'))->paginate(10);

            if(count($ResultadoConsultaPrestamos)==0){
                return $this->Redireccionar_Mensajes_Fallos(11);
            }else{
                return view('Prestamo.VMGN_Prestamos_No_Aprobados_O_Cancelados',compact('ResultadoConsultaPrestamos'));
            }

        } catch (\Exception $e) {
            return $this->Redireccionar_Mensajes_Fallos(10);
        }
    }
}
