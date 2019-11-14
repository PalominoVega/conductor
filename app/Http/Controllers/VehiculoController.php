<?php

namespace App\Http\Controllers;

use App\Model\Vehiculo;
use App\Model\Configuracion;
use Illuminate\Http\Request;
use App\Logica\Curl;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\VehiculoValidation;
use App\Http\Requests\VehiculoUpdateValidation;


class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos=Vehiculo::where('empresa_id',auth()->user()->empresa_id)->where('estado','0')->get();
        return view('vehiculo.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehiculo.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehiculoValidation $request)
    {
        DB::beginTransaction();
        try {
        $mensaje='';
            /**
             * datos del vehiculo
             */
            $vehiculo=new Vehiculo();
            $vehiculo->unidad=mb_strtoupper($request->get('unidad'));
            $vehiculo->placa=mb_strtoupper($request->get('placa'));
            $vehiculo->marca=mb_strtoupper($request->get('marca'));
            $vehiculo->modelo=mb_strtoupper($request->get('modelo'));
            $vehiculo->color=mb_strtoupper($request->get('color'));
            $vehiculo->anio=$request->get('anio');

            /**
             * Documentacion y fecha de vigencia de los mismos
             */
            $vehiculo->empresa_soat=mb_strtoupper($request->soat);
            $vehiculo->fecha_soat=$request->get('fecha_soat');
            $vehiculo->empresa_revision_tecnica=mb_strtoupper($request->get('empresa_revision_tecnica'));
            $vehiculo->fecha_revision_tecnica=$request->get('fecha_revision_tecnica');

            $vehiculo->empresa_id=auth()->user()->empresa_id;
            $vehiculo->save();

            // poner el odometro
            $configuracion=Configuracion::where('empresa_id', $vehiculo->empresa_id)->first();

            $url = 'http://gps.corporacionvespro.com:8080/eventsperu/data.jsonx?a='.$configuracion->a.'&p='.$configuracion->p.'&u='.$configuracion->u.'&d='.$vehiculo->placa.'&l=1';
            $data=Curl::get($url);

            if($data!=null && count($data)>=2){
                if(count($data['DeviceList'][0]['EventData'])>0){
                    $firstEvento=$data['DeviceList'][0]['EventData'][0];
                    // $placa=$firstEvento['Device'];
                    $odometro=$firstEvento['Odometer'];
                    $vehiculo->odometro=$odometro;
                    $vehiculo->save();
                    
                }
            }else{
                $mensaje='Datos registrado correctamente sin datos del GPS';            
            }

            DB::commit();
            alert()->success($vehiculo->placa,$mensaje);
            return redirect()->route('vehiculo.index');
        }catch(\Exception $e){

            DB::rollback();
            $error = $e->getMessage();
            alert()->warning('No se ha podido registrar <br>'.$error, $vehiculo->placa )->persistent('Ok')->html();
            return redirect()->back();
        };
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show($vehiculo_id)
    {
        $vehiculo=Vehiculo::where('id',$vehiculo_id)->first();
        // dd($vehiculo);
        return view('vehiculo.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($vehiculo_id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(VehiculoUpdateValidation $request, $vehiculo_id)
    {
        DB::beginTransaction();
        try {
            /**
             * datos del vehiculo
             */
            $vehiculo=Vehiculo::where('id',$vehiculo_id)->first();
            $vehiculo->unidad=mb_strtoupper($request->get('unidad'));
            $vehiculo->placa=mb_strtoupper($request->get('placa'));
            $vehiculo->marca=mb_strtoupper($request->get('marca'));
            $vehiculo->modelo=mb_strtoupper($request->get('modelo'));
            $vehiculo->color=mb_strtoupper($request->get('color'));
            $vehiculo->anio=$request->get('anio');

            /**
             * Documentacion y fecha de vigencia de los mismos
             */
            $vehiculo->empresa_soat=mb_strtoupper($request->soat);
            $vehiculo->fecha_soat=$request->get('fecha_soat');
            $vehiculo->empresa_revision_tecnica=mb_strtoupper($request->get('empresa_revision_tecnica'));
            $vehiculo->fecha_revision_tecnica=$request->get('fecha_revision_tecnica');

            $vehiculo->save();
            DB::commit();
            alert()->success($vehiculo->placa,'Datos actualizados correctamente');
            return redirect()->route('vehiculo.show',$vehiculo->id);
        }catch(\Exception $e){

            DB::rollback();
            $error = $e->getMessage();
            alert()->warning('No se ha podido actualizar los datos <br>'.$error, $vehiculo->placa )->persistent('Ok')->html();
            return redirect()->back();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy($vehiculo_id)
    {
        //
    }

    public function cambiar_Estado($vehiculo_id)
    {

        DB::beginTransaction();

        try {
            $vehiculo=Vehiculo::where('id',$vehiculo_id)->first();
                        
            $estado = ($vehiculo->estado=='0') ? '1': '0'; //saber el estado actual y cambiarlo
            
            $vehiculo->estado=$estado;
            $vehiculo->save();

            $estado = ($vehiculo->estado=='0') ? 'Vehículo activado ': 'Vehículo desactivado'; //saber el estado cambiado para mostrar el mensaje

            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  $estado,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"    =>  "DANGER",
                "data"      =>  $e->getMessage()
            ]);
        }
    }
}
