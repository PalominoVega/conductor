<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Model\Vehiculo;

class TareaRevisionTecnicaVencida extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tarea:reviciontecnicavencida';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $app_url=env('APP_URL');
        $prevent=Carbon::now()->addDays(7)->format('Y-m-d');
        $vencidos=Vehiculo::with('empresa')->where('fecha_revision_tecnica',$prevent)
                ->get();
                
        foreach ($vencidos as $key => $vencido) {
            $apiKey="AIzaSyCRRFu54sUpJaRpnWiR13Z5Zce_AzCPPhg";
            $fields=array('to'=>'/topics/flota-'.$vencido->empresa_id,
            'notification'=>array(
                'title'=>"Gestion de Flota",
                'body'=>("Revición Técnica por VENCER del vehiculo placa ").$vencido->placa,
                'icon'=>$app_url.'storage/'.$vencido->empresa->logo,
                'click_action'=>$app_url."notificacion"
            ));
            $url='https://fcm.googleapis.com/fcm/send';
            $headers=array('Authorization: key='.$apiKey,'Content-Type: application/json');
            $curl=curl_init();
            curl_setopt($curl,CURLOPT_URL,$url);
            curl_setopt($curl,CURLOPT_POST,true);
            curl_setopt($curl,CURLOPT_HTTPHEADER,$headers);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($fields));
            echo curl_exec($curl);
            curl_close($curl);
            
        }        
        //Obtenido desde consola de PHP
    }
}
