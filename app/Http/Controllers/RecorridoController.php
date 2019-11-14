<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Recorrido;
use App\Model\Vehiculo;
use App\Model\Configuracion;
use Carbon\Carbon;
use App\Logica\Curl;

class RecorridoController extends Controller
{

    public function index()
    {
        $reporte=Recorrido::where('bandera','1')->where('empresa_id', auth()->user()->empresa_id)->get();
        return view('notificacion.cambio-aceite', compact('reporte'));
    }

    public function store(Request $request)
    {   
        DB::beginTransaction();
        try {

            $vehiculo=Vehiculo::where('id',$request->vehiculo_id)
                        ->where('estado','0')
                        ->first();
            
            $configuracion=Configuraciones::where('empresa_id', $vehiculo->empresa_id)->first();
            if($vehiculo!=null)
            {
                $url = 'http://gps.corporacionvespro.com:8080/eventsperu/data.jsonx?a='.$configuracion->a.'&p='.$configuracion->p.'&u='.$configuracion->u.'&d='.$vehiculo->placa.'&l=1';
                $data=Curl::get($url);
                
                if(count($data['DeviceList'][0]->EventData)>0){
                    $firstEvento=$data['DeviceList'][0]->EventData[0];
                    $placa=$firstEvento['Device'];
                    $odometro=$firstEvento['Odometer'];
                            
        
                    $recorrido= new Recorrido();
                    $recorrido->recorrido_aux=$odometro;
                    $recorrido->vehiculo_id=$vehiculo->id;
                    $recorrido->save();
                    DB::commit();
                    Alert::success('Operecion','Datos Guardados ')->autoclose(4000);
                    return redirect()->route('conductor.index');

                }
                DB::rollback();
                Alert::warning('Operecion','Fallo conexion con la plataforma GPS o vehiculo no tiene GPS')->autoclose(4000);
                return brack();

            }
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            Alert::warning('No se registro <br>'.$error,$conductor->nombre )->persistent('Ok')->html();
            return redirect()->back();
        };
    }

    public function update(Request $request)
    {   
        DB::beginTransaction();
        try {

            $recorridoUpdate=Recorrido::where('id',$request->vehiculo_id)
                        ->where('estado','0')
                        ->first();
            $recorridoUpdate->estado=1;
            $recorridoUpdate->save();

            $configuracion=Configuraciones::where('empresa_id', auth()->user()->empresa_id)->first();
            
            $url = 'http://gps.corporacionvespro.com:8080/eventsperu/data.jsonx?a='.$configuracion->a.'&p='.$configuracion->p.'&u='.$configuracion->u.'&d='.$vehiculo->placa.'&l=1';
            $data=Curl::get($url);
            
            if(count($data['DeviceList'][0]->EventData)>0){
                $firstEvento=$data['DeviceList'][0]->EventData[0];
                $placa=$firstEvento['Device'];
                $odometro=$firstEvento['Odometer'];
                        
    
                $recorrido= new Recorrido();
                $recorrido->recorrido_aux=$odometro;
                $recorrido->vehiculo_id=$vehiculo->id;
                $recorrido->save();
                DB::commit();
                Alert::success('Operecion','Datos Guardados ')->autoclose(4000);
                return redirect()->route('conductor.index');
            }
            DB::rollback();
            Alert::warning('Operecion','Fallo conexion con la plataforma GPS o vehiculo no tiene GPS')->autoclose(4000);
            return brack();

        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            Alert::warning('No se registro <br>'.$error,$conductor->nombre )->persistent('Ok')->html();
            return redirect()->back();
        };
    }
}
