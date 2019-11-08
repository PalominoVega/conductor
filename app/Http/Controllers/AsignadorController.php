<?php

namespace App\Http\Controllers;

use App\Model\Asignador;
use App\Model\Vehiculo;
use App\Model\Conductor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AsignadorController extends Controller
{
    
    public function index()
    {
        $vehiculos=Vehiculo::with('conductor')->select('vehiculo.id' ,'placa')->where('estado','0')->get();
        $conductores=Conductor::select('id', 'nombre', 'apellido')
            ->where('empresa_id',auth()->user()->empresa_id)
            ->where('estado','0')
            // ->isnullWwhere('vehiculo_id')
            ->where('vehiculo_id','=',null)
            ->get();
        return view('asignador.index', compact('vehiculos','conductores'));
    }

    public function updateVehiculo($conductor_id)
    {
        DB::beginTransaction();

        try {
            $conductor= Conductor::where('id',$conductor_id)->first();
            $conductor->vehiculo_id=null;
            $conductor->save();
            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  'Conductor fue borrado del vehículo ',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"    =>  "DANGER",
                "data"      =>  $e->getMessage()
            ]);
        }
    }

    public function ajax()
    {
        $conductores=Conductor::select('id', 'nombre', 'apellido')
            ->where('empresa_id',auth()->user()->empresa_id)
            ->where('estado','0')
            // ->isnullWwhere('vehiculo_id')
            ->where('vehiculo_id','=',null)
            ->get();
        return json_encode($conductores);
    }

    public function storeVehiculo(Request $request )
    {
        echo json_encode($request->all());
        DB::beginTransaction();

        try {
            $conductor= Conductor::where('id',$request->conductor_id)->first();
            $conductor->vehiculo_id=$request->vehiculo_id;
            $conductor->save();
            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  'Conductor fue asignado al vehículo ',
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
