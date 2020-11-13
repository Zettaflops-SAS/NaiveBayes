<?php

namespace App\Http\Controllers;
use DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class CMGN_Controlador_Reporte extends Controller
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
    *Metodo encargado de cargar la vista donde se puede ver todos los prestamos aprobados
    *para realizar la visualización del pdf con le información del prestamo
    */
    public function Mostrar_Vista_Prestamos_Aprobados_Reporte_PDF(){

    	try {

            $ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('EstadoPrestamo',"APROBADO")->paginate(10);
            return view('Reportes.VMGN_Prestamo_Aprobados_Reportes',compact('ResultadoConsultaPrestamos'));

        } catch (\Exception $e) {
            return $this->Redireccionar_Mensajes_Fallos(1);
        }

    }

    /**
    *Metodo encargado de redireccionar todos los mensajes de errores con respecto a los prestamos
    *aprobados pero que tambien se utiliza para realizar los reportes
    */
    private function Redireccionar_Mensajes_Fallos($TipoFallo){

    	if($TipoFallo==1){
    		return redirect()->route('reportepdffallos.mensaje')->with('Fallo', "No se pudo cargar la información de los prestamos aprobados para realizar la visualización de la información del prestamo del cliente.");
    	}else{
            if($TipoFallo==2){
                return redirect()->route('reportepdffallos.mensaje')->with('Fallo', "No se pudo cargar la información de los prestamos aprobados en el PDF para realizar la visualización de la información.");
            }else{
                if($TipoFallo==3){
                    return redirect()->route('reportepdffallos.mensaje')->with('Fallo', "No se filtrar la información del cliente.");
                }else{
                    if($TipoFallo==4){
                        return redirect()->route('reportepdffallos.mensaje')->with('Alerta', "No se encontro información relacionada con el N° de Identificación ingresado.");
                    }else{
                       if($TipoFallo==5){
                            return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general.");
                        }else{
                            if($TipoFallo==6){
                                return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta de la información del ejercito.");
                            }else{
                                if($TipoFallo==7){
                                    return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta de la información de la fuerza aerea.");
                                }else{
                                    if($TipoFallo==8){
                                        return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta de la información de la armada.");
                                    }else{
                                        if($TipoFallo==9){
                                            return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta de la información de la naval.");
                                        }else{
                                            if($TipoFallo==10){
                                                return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta de la información de la dedicaión comercial independiente.");
                                            }else{
                                                if($TipoFallo==11){
                                                    return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta de la información de la dedicaión comercial dependiente.");
                                                }else{
                                                    if($TipoFallo==12){
                                                        return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta de la información de la dedicaión comercial comerciente.");
                                                    }else{
                                                        if($TipoFallo==13){
                                                            return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta de la información de la dedicaión comercial empresario.");
                                                        }else{
                                                            if($TipoFallo==14){
                                                                return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta de la información de las cuotas canceladas.");
                                                            }else{
                                                               if($TipoFallo==15){
                                                                    return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta de las probabilidades de pago.");
                                                                }else{
                                                                    if($TipoFallo==16){
                                                                        return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta del monto máximo que se le puede prestar a las fuerzas militares.");
                                                                    }else{
                                                                       if($TipoFallo==17){
                                                                            return redirect()->route('reportegeneralfallos.mensaje')->with('Fallo', "No se pudo cargar la información del reporte gráfico general. Fallo la consulta del monto máximo que se le puede prestar a la dedicación comercial.");
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
    *Metodo encargado de retornar la vista donde se puede ver los errores que arroja la vista
    *de prestamos aprobados para realizar la visualización de la información del prestamo
    *en el pdf
    */
    public function Mostrar_Vista_Prestamo_Aprobados_Reporte_Fallos(){

        $ResultadoConsultaPrestamos = array();
        return view('Reportes.VMGN_Prestamo_Aprobados_Reportes',compact('ResultadoConsultaPrestamos'));
    }

    /**
    *Metodo encargado de visualizar el pdf con la información del prestamo del cliente
    */
    public function Descargar_Informacion_Prestamo_PDF($IdPrestamo){

        try {
            
            $ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('PK',$IdPrestamo)->first();
            $ResultadoConsultaAmortizacion = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$ResultadoConsultaPrestamos->PK)->get();
            $FechaActual = date('d/m/Y', strtotime(Carbon::now()));
            $PrimeraParteHTML="
            <div style='margin: 50px;'>
                <div>
                    <center><img src='../public/img/ri_1.png' width='550' height='150'></center>
                </div>
                <br>
                <div>
                    <center><h2>Información detallada del préstamo</h2></center>
                </div>
                <div>
                    <p style='text-align: justify;font-family: monospace;'>Este reporte se genera a petición del cliente identificado con el <strong>N° ".$ResultadoConsultaPrestamos->CedulaCliente."</strong> el día <strong>".$FechaActual."</strong> para fines informativos.</p>
                </div>
                <div>
                    <p style='text-align: justify;font-family: monospace;'>Hasta el día de hoy <strong>".$FechaActual."</strong> el cliente identificado con el <strong>N° ".$ResultadoConsultaPrestamos->CedulaCliente."</strong> solicito el prestamo por el monto de <strong> ".number_format($ResultadoConsultaPrestamos->ValorPrestamo)." (pesos colombianos)</strong> con un interés del <strong> ".$ResultadoConsultaPrestamos->InteresPrestamo."% </strong> y a un plazo de <strong> ".$ResultadoConsultaPrestamos->PlazoPrestamo." meses</strong>. El estado del crédito es <strong> ".$ResultadoConsultaPrestamos->EstadoPrestamo.".</strong></p>
                </div>
                
                <div>
                    <br>
                    <table class='table table-bordered table-hover' border='4'>
                        <thead>
                            <tr BGCOLOR='#A7A7A7'>
                                <th>Abono a Capital</th>
                                <th>Abono a Interes</th>
                                <th>Interes de Mora</th>
                                <th>Saldo</th>
                                <th>Mes</th>
                                <th>Estado</th>
                                <th>Fecha de Pago</th>
                            </tr>
                        </thead>
                        <tbody>";

            $SeguntaParteHTML="";

            foreach ($ResultadoConsultaAmortizacion as $apuntador) {

                $ColorEstado="";
                if($apuntador->Estado=="CANCELADO"){
                    $ColorEstado="BGCOLOR='#179B11'";
                }else{
                    if($apuntador->Estado=="DEBE"){
                        $ColorEstado="BGCOLOR='#FF3200'";
                    }else{
                        if($apuntador->Estado=="MORA"){
                            $ColorEstado="BGCOLOR='#ECBB22'";
                        }
                    }
                }
                $SeguntaParteHTML=$SeguntaParteHTML."<tr BGCOLOR='#E6E6E6'>";
                $SeguntaParteHTML=$SeguntaParteHTML."<td>".number_format($apuntador->AbonoCapital)."</td>";
                $SeguntaParteHTML=$SeguntaParteHTML."<td>".number_format($apuntador->AbonoInteres)."</td>";
                $SeguntaParteHTML=$SeguntaParteHTML."<td>".number_format($apuntador->InteresMora)."</td>";
                $SeguntaParteHTML=$SeguntaParteHTML."<td>".number_format($apuntador->Saldo)."</td>";
                $SeguntaParteHTML=$SeguntaParteHTML."<td>".$apuntador->Mes."</td>";
                $SeguntaParteHTML=$SeguntaParteHTML."<td ".$ColorEstado.">".$apuntador->Estado."</td>";
                $SeguntaParteHTML=$SeguntaParteHTML."<td>".date('d/m/Y', strtotime($apuntador->FechaPago))."</td>";
                $SeguntaParteHTML=$SeguntaParteHTML."</tr>";
            }

            $SeguntaParteHTML=$SeguntaParteHTML."</tbody></table></div></div>";
            $HTMLCompleto=$PrimeraParteHTML.$SeguntaParteHTML;


            $pdf=PDF::loadHTML($HTMLCompleto);
            return $pdf->stream();

        } catch (\Exception $e) {
            return $this->Redireccionar_Mensajes_Fallos(2);
        }
    }

    /**
    *Metodo encargado de filtrar los prestamos aprobados
    *para realizar el cargue de la información del prestamo en el pdf
    */
    public function Mostrar_Vista_Prestamos_Aprobados_Reporte_Filtrados(Request $request){

        try {

            $ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('CedulaCliente', $request->input('CVMGN_Numero_Documento'))->paginate(10);

            if(count($ResultadoConsultaPrestamos)==0){
                return $this->Redireccionar_Mensajes_Fallos(4);
            }else{
                return view('Reportes.VMGN_Prestamo_Aprobados_Reportes',compact('ResultadoConsultaPrestamos'));
            }

        } catch (\Exception $e) {
            return $this->Redireccionar_Mensajes_Fallos(3);
        }
    }

    /**
    *Metodo encargado de retornar la vista donde se puede ver el reporte grafico general
    */
    public function Mostrar_Vista_Reporte_Grafico_General(){

        try {
            
            $CMGN_Controlador_Decision=new CMGN_Controlador_Decision();
            $CMGN_Controlador_Algoritmo=new CMGN_Controlador_Algoritmo();

            $RespuestaEjercito=$CMGN_Controlador_Algoritmo->Consultar_Informacion_Ejercito();

            if($RespuestaEjercito=="FALLO 1"){
                return $this->Redireccionar_Mensajes_Fallos(6);
            }

            $RespuestaFuerzaAerea=$CMGN_Controlador_Algoritmo->Consultar_Informacion_Fuerza_Aerea();

            if($RespuestaFuerzaAerea=="FALLO 2"){
                return $this->Redireccionar_Mensajes_Fallos(7);
            }

            $RespuestaArmada=$CMGN_Controlador_Algoritmo->Consultar_Informacion_Armada();

            if($RespuestaArmada=="FALLO 3"){
                return $this->Redireccionar_Mensajes_Fallos(8);
            }

            $RespuestaNaval=$CMGN_Controlador_Algoritmo->Consultar_Informacion_Naval();

            if($RespuestaNaval=="FALLO 4"){
                return $this->Redireccionar_Mensajes_Fallos(9);
            }
            
            $RespuestaCuotasCanceladasEjercito=$CMGN_Controlador_Decision->Consultar_Informacion_Cuotas(1);

            if($RespuestaCuotasCanceladasEjercito=="FALLO 15"){
                return $this->Redireccionar_Mensajes_Fallos(14);
            }

            $RespuestaCuotasCanceladasFuerzaAerea=$CMGN_Controlador_Decision->Consultar_Informacion_Cuotas(2);

            if($RespuestaCuotasCanceladasFuerzaAerea=="FALLO 15"){
                return $this->Redireccionar_Mensajes_Fallos(14);
            }

            $RespuestaCuotasCanceladasArmada=$CMGN_Controlador_Decision->Consultar_Informacion_Cuotas(3);

            if($RespuestaCuotasCanceladasArmada=="FALLO 15"){
                return $this->Redireccionar_Mensajes_Fallos(14);
            }

            $RespuestaCuotasCanceladasNaval=$CMGN_Controlador_Decision->Consultar_Informacion_Cuotas(4);

            if($RespuestaCuotasCanceladasNaval=="FALLO 15"){
                return $this->Redireccionar_Mensajes_Fallos(14);
            }
            
            $RespuestaProbabilidad=$CMGN_Controlador_Algoritmo->Calcular_Probabilidades($RespuestaEjercito,$RespuestaFuerzaAerea,$RespuestaArmada,$RespuestaNaval);

            if($RespuestaProbabilidad=="FALLO 9"){
                return $this->Redireccionar_Mensajes_Fallos(15);
            }

            $ProbabilidadEjercito=$RespuestaProbabilidad[0];
            $ProbabilidadFuerzaAerea=$RespuestaProbabilidad[3];
            $ProbabilidadArmada=$RespuestaProbabilidad[2];
            $ProbabilidadNaval=$RespuestaProbabilidad[1];

            $MontoTotalDineroEjercito=$CMGN_Controlador_Decision->Calcular_Dinero_Maximo_Fuerza_Militar($ProbabilidadEjercito);

            if($MontoTotalDineroEjercito=="FALLO 11"){
                return $this->Redireccionar_Mensajes_Fallos(16);
            }

            $MontoTotalDineroFuerzaAerea=$CMGN_Controlador_Decision->Calcular_Dinero_Maximo_Fuerza_Militar($ProbabilidadFuerzaAerea);

            if($MontoTotalDineroFuerzaAerea=="FALLO 11"){
                return $this->Redireccionar_Mensajes_Fallos(16);
            }

            $MontoTotalDineroArmada=$CMGN_Controlador_Decision->Calcular_Dinero_Maximo_Fuerza_Militar($ProbabilidadArmada);

            if($MontoTotalDineroArmada=="FALLO 11"){
                return $this->Redireccionar_Mensajes_Fallos(16);
            }

            $MontoTotalDineroNaval=$CMGN_Controlador_Decision->Calcular_Dinero_Maximo_Fuerza_Militar($ProbabilidadNaval);

            if($MontoTotalDineroNaval=="FALLO 11"){
                return $this->Redireccionar_Mensajes_Fallos(16);
            }

            $TotalCuotasCanceladasEjercito=$RespuestaEjercito[3];
            $TotalCuotasCanceladasFuerzaAerea=$RespuestaFuerzaAerea[3];
            $TotalCuotasCanceladasArmada=$RespuestaArmada[3];
            $TotalCuotasCanceladasNaval=$RespuestaNaval[3];

            $TotalCuotasDebeEjercito=$RespuestaCuotasCanceladasEjercito[0];
            $TotalCuotasDebeFuerzaAerea=$RespuestaCuotasCanceladasFuerzaAerea[0];
            $TotalCuotasDebeArmada=$RespuestaCuotasCanceladasArmada[0];
            $TotalCuotasDebeNaval=$RespuestaCuotasCanceladasNaval[0];

            return view('Reportes.VMGN_Reporte_Grafico_General',compact('TotalCuotasCanceladasEjercito','TotalCuotasCanceladasFuerzaAerea','TotalCuotasCanceladasArmada','TotalCuotasCanceladasNaval','TotalCuotasDebeEjercito','TotalCuotasDebeFuerzaAerea','TotalCuotasDebeArmada','TotalCuotasDebeNaval','ProbabilidadEjercito','ProbabilidadFuerzaAerea','ProbabilidadArmada','ProbabilidadNaval','MontoTotalDineroEjercito','MontoTotalDineroFuerzaAerea','MontoTotalDineroArmada','MontoTotalDineroNaval'));
        } catch (\Exception $e) {
            return $this->Redireccionar_Mensajes_Fallos(5);
        }
    }

    /**
    *Metodo encargado de retornar la vista donde se puede ver los errores que arroja la vista
    *de reporte general donde se puede ver el reporte gráfico general
    */
    public function Mostrar_Vista_Reporte_Grafico_General_Fallos(){

        $TotalCuotasCanceladasEjercito=0;
        $TotalCuotasCanceladasFuerzaAerea=0;
        $TotalCuotasCanceladasArmada=0;
        $TotalCuotasCanceladasNaval=0;
            
        $TotalCuotasDebeEjercito=0;
        $TotalCuotasDebeFuerzaAerea=0;
        $TotalCuotasDebeArmada=0;
        $TotalCuotasDebeNaval=0;

        $ProbabilidadEjercito=0;
        $ProbabilidadFuerzaAerea=0;
        $ProbabilidadArmada=0;
        $ProbabilidadNaval=0;

        $MontoTotalDineroEjercito=0;
        $MontoTotalDineroFuerzaAerea=0;
        $MontoTotalDineroArmada=0;
        $MontoTotalDineroNaval=0;

        return view('Reportes.VMGN_Reporte_Grafico_General',compact('TotalCuotasCanceladasEjercito','TotalCuotasCanceladasFuerzaAerea','TotalCuotasCanceladasArmada','TotalCuotasCanceladasNaval','TotalCuotasDebeEjercito','TotalCuotasDebeFuerzaAerea','TotalCuotasDebeArmada','TotalCuotasDebeNaval','ProbabilidadEjercito','ProbabilidadFuerzaAerea','ProbabilidadArmada','ProbabilidadNaval','MontoTotalDineroEjercito','MontoTotalDineroFuerzaAerea','MontoTotalDineroArmada','MontoTotalDineroNaval'));
    }
}
