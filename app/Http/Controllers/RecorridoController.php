<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Recorrido;
use App\Model\Vehiculo;
use App\Model\Configuracion;
use Carbon\Carbon;
use App\Logica\Curl;
use Illuminate\Support\Facades\DB;
use Alert;


class RecorridoController extends Controller
{

    public function index()
    {
        $reporte=Recorrido::with('vehiculo')->where('bandera','1')->where('estado','0')->where('empresa_id', auth()->user()->empresa_id)->get();
        return view('notificacion.cambio-aceite', compact('reporte'));
    }

    public function store(Request $request, $vehiculo_id)
    {   
        DB::beginTransaction();
        try {

            $vehiculo=Vehiculo::where('id',$vehiculo_id)
                        ->where('estado','0')
                        ->first();
            $vehiculo->kilometraje=$request->recorrido;
            $vehiculo->save();

            $configuracion=Configuracion::where('empresa_id', $vehiculo->empresa_id)->first();
            if($vehiculo!=null)
            {
                $url = 'http://gps.corporacionvespro.com:8080/eventsperu/data.jsonx?a='.$configuracion->a.'&p='.$configuracion->p.'&u='.$configuracion->u.'&d='.$vehiculo->placa.'&l=1';
                $data=Curl::get($url);
                
                if($data!=null && count($data)>=2){
                    if(count($data['DeviceList'][0]['EventData'])>0){
                        $firstEvento=$data['DeviceList'][0]['EventData'][0];
                        $placa=$firstEvento['Device'];
                        $odometro=$firstEvento['Odometer'];
            
                        $recorrido= new Recorrido();
                        $recorrido->recorrido_aux=$odometro;
                        $recorrido->vehiculo_id=$vehiculo->id;
                        $recorrido->empresa_id=auth()->user()->empresa_id;

                        $recorrido->save();
                        DB::commit();
                        Alert::success('Operecion','Datos Guardados ')->autoclose(4000);
                        return redirect()->route('vehiculo.recorrido');
                    }
                }    
                DB::rollback();
                Alert::warning('Operecion','Fallo conexion con la plataforma GPS o vehiculo no tiene GPS')->autoclose(4000);
                return brack();

            }
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            Alert::warning('No se registro <br>'.$error,$vehiculo->placa )->persistent('Ok')->html();
            return redirect()->back();
        };
    }

    public function update(Request $request,$recorrido_id)
    {   
        DB::beginTransaction();
        try {

            $recorridoUpdate=Recorrido::where('id',$recorrido_id)
                        ->first();
            $recorridoUpdate->estado='1';
            $recorridoUpdate->save();

            $configuracion=Configuracion::where('empresa_id', auth()->user()->empresa_id)->first();
            
            $url = 'http://gps.corporacionvespro.com:8080/eventsperu/data.jsonx?a='.$configuracion->a.'&p='.$configuracion->p.'&u='.$configuracion->u.'&d='.$request->placa.'&l=1';
            $data=Curl::get($url);
            if($data!=null && count($data)>=2){
                if(count($data['DeviceList'][0]['EventData'])>0){
                    $firstEvento=$data['DeviceList'][0]['EventData'][0];
                    $placa=$firstEvento['Device'];
                    $odometro=$firstEvento['Odometer'];
                            
                    $recorrido= new Recorrido();
                    $recorrido->recorrido_aux=$odometro;
                    $recorrido->vehiculo_id=$recorridoUpdate->vehiculo_id;
                    $recorrido->empresa_id=auth()->user()->empresa_id;
                    $recorrido->save();
                    
                    DB::commit();
                    return response()->json([
                        "status"    =>  "OK",
                        "data"      => 'Datos Guardados',
                    ]);
                }
            }
            DB::rollback();
            return response()->json([
                "status"    =>  "DANGER",
                "data"      =>  'Fallo conexion con la plataforma GPS o vehiculo no tiene GPS',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"    =>  "DANGER",
                "data"      =>  $e->getMessage()
            ]);
        }
    }

    public function recorrido()
    {
        $vehiculos=Vehiculo::where('empresa_id',auth()->user()->empresa_id)->where('estado','0')->get();
        return view('vehiculo.recorrido', compact('vehiculos'));
    }
}
