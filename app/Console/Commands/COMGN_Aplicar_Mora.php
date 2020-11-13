<?php

namespace App\Console\Commands;
use DB;
use Log;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class COMGN_Aplicar_Mora extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Mora:AplicarMora';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando aplica el interes de mora al prestamo.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        $ResultadoConsultaPrestamos = DB::table('MGN_Informacion_Prestamo')->where('EstadoPrestamo',"APROBADO")->get();
        $FechaActual = Carbon::parse(Carbon::now());

        foreach ($ResultadoConsultaPrestamos as $apuntador) {

            $ResultadoConsultaAmortizacion=0;
            $InteresMora=0;
            $ActualizarInformaciónAmortizacion=0;
            $DiasDiferencia=0;
            
            $ResultadoConsultaAmortizacion = DB::table('MGN_Informacion_Amortizacion')->where('FK_MGN_Inf_Amortizacion',$apuntador->PK)->whereIn('Estado',["DEBE","MORA"])->first();
            $FechaDePago=Carbon::parse($ResultadoConsultaAmortizacion->FechaPago);
            $DiasDiferencia=$FechaDePago->diffInDays($FechaActual);

            if($DiasDiferencia>30){
                $InteresMora=$ResultadoConsultaAmortizacion->Saldo*(2/366)*$DiasDiferencia;
                $ActualizarInformaciónAmortizacion = DB::table('MGN_Informacion_Amortizacion')->where('PK',$ResultadoConsultaAmortizacion->PK)->update(['Estado' => "MORA",'InteresMora' => $InteresMora]);
            }
        }
        //Log::info("ENTRE :D");
    }
}
