<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Vehiculo;
use App\Model\Configuracion;
use Carbon\Carbon;
use App\Logica\Curl;
use App\Model\Recorrido;

class TareaCambioAceite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tarea:cambioaciete';

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
        /**
         * Datos Globales
         */
        $hora_actual=Carbon::now();
        $hora_60m=Carbon::now()->subMinutes(60);
        $app_url=env('APP_URL');
        /**
         * Algoritmo de Evaluacion
         */
        $configuraciones=Configuracion::all();
        foreach ($configuraciones as $key => $configuracion){
            
            /**
             * Obtener Datos de 00:01:30 de tiempo
             */
            $url = 'http://gps.corporacionvespro.com:8080/eventsperu/data.jsonx?a='.$configuracion->a.'&p='.$configuracion->p.'&u='.$configuracion->u.'&g='.$configuracion->g.'&l=1&at=false';
            $data=Curl::get($url);
            if($data!=null){
                foreach ($data['DeviceList'] as $key => $device) {                
                    $eventos=$device['EventData'];
                    if(count($eventos)>0){
                        $firstEvento=$eventos[0];
                        $placa=$firstEvento['Device'];
                        $odometro=$firstEvento['Odometer'];
                        $vehiculo=Vehiculo::where('placa',$firstEvento['Device'])
                            ->where('empresa_id',$configuracion->empresa_id)
                            ->where('estado','0')
                            ->first();
                        if($vehiculo!=null){
                            $vehiculo->odometro=$odometro;
                            $vehiculo->save();
        
                            $kilometraje=Recorrido::where('vehiculo_id',$vehiculo->id)->where('estado','0')->first();
                            if($kilometraje!=null){
                                $kilometraje->recorrido=$odometro-$kilometraje->recorrido_aux;
                                $kilometraje->save();
        
                                if($kilometraje->recorrido>=$vehiculo->kilometraje && $kilometraje->bandera==0){
            
                                    $apiKey="AIzaSyCRRFu54sUpJaRpnWiR13Z5Zce_AzCPPhg";
                                    $fields=array('to'=>'/topics/flota-'.$configuracion->empresa_id,
                                    'notification'=>array(
                                        'title'=>"Gestion de Flota",
                                        'body'=>("vehiculo requiere cambio de aceita, placa: ").$vehiculo->placa,
                                        'icon'=>$app_url.'storage/'.$configuracion->empresa->logo,
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
                                    $kilometraje->bandera='1';
                                    $kilometraje->save();
                                }
                                
                            }
                        }
                    }
                }
            }
        }
    }
}
