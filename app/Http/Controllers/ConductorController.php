<?php

namespace App\Http\Controllers;

use App\Model\Conductor;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\ConductorValidation;
use Peru\Http\ContextClient;
use Peru\Jne\{Dni, DniParser};
use Peru\Sunat\{HtmlParser, Ruc, RucParser};
use Alert;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conductores=Conductor::select('id', 'nombre', 'apellido','celular','estado')->where('empresa_id',auth()->user()->empresa_id)->where('estado','0')->get();
        // return response()->json($conductores);
        return view('conductor.index', compact('conductores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('conductor.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConductorValidation $request)
    {   
        // dd($request->all());

        DB::beginTransaction();
        try {
            /**
             * Datos del Cliente
             */
            $conductor=new Conductor();
            $conductor->dni=$request->get('dni');
            $conductor->email=$request->get('emial');
            $conductor->nombre=mb_strtoupper($request->get('nombre'));
            $conductor->apellido=mb_strtoupper($request->get('apellido'));
            $conductor->tipo_sangre=mb_strtoupper($request->get('tipo_sangre'));
            $conductor->celular=$request->get('celular');
            $conductor->direccion=mb_strtoupper($request->get('direccion'));
            $conductor->fecha_nacimiento=$request->fecha_nacimiento;

            if($request->file('file')!=null){
                $foto=$request->file('file');
                $fileName = 'item-'.$conductor->dni.'.'.$foto->getClientOriginalExtension();
                \Image::make($foto)
                    ->resize(600, null, function ($constraint) {$constraint->aspectRatio();})
                    ->save(public_path('/storage/afiliado/'.$fileName));
                $conductor->foto=$fileName;
            }
            // dd($foto=$request->file('file'));
            /**
             * Documentacion y fecha de vigencia de los mismos
             */
            $conductor->categoria_licencia=mb_strtoupper($request->categoria_licencia);
            $conductor->fecha_licencia=$request->get('fecha_licencia');

            $conductor->empresa_id=auth()->user()->empresa_id;
            $conductor->save();
            DB::commit();
            Alert::success($conductor->nombre,'Se registró correctamente')->autoclose(4000);
            return redirect()->route('conductor.index');
        }catch(\Exception $e){
            DB::rollback();
            $error = $e->getMessage();
            Alert::warning('No se ha podido registrar <br>'.$error,$conductor->nombre )->persistent('Ok')->html();
            return redirect()->back();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Conductor  $conductor
     * @return \Illuminate\Http\Response
     */
    public function show($conductor_id)
    {
        $conductor=Conductor::where('id',$conductor_id)->first();
        return view('conductor.show', compact('conductor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Conductor  $conductor
     * @return \Illuminate\Http\Response
     */
    public function edit($conductor_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Conductor  $conductor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $conductor_id)
    {
        // dd($request->all());

        DB::beginTransaction();

        try {
            /**
             * Datos del Cliente
             */
            $conductor=Conductor::where('id',$conductor_id)->first();
            $conductor->dni=$request->get('dni');
            $conductor->email=$request->get('emial');
            $conductor->nombre=mb_strtoupper($request->get('nombre'));
            $conductor->apellido=mb_strtoupper($request->get('apellido'));
            $conductor->tipo_sangre=mb_strtoupper($request->get('tipo_sangre'));
            $conductor->celular=$request->get('celular');
            $conductor->direccion=mb_strtoupper($request->get('direccion'));
            $conductor->fecha_nacimiento=$request->fecha_nacimiento;

            if($request->file('file')!=null){
                $foto=$request->file('file');
                $fileName = 'item-'.$conductor->dni.'.'.$foto->getClientOriginalExtension();
                \Image::make($foto)
                    ->resize(600, null, function ($constraint) {$constraint->aspectRatio();})
                    ->save(public_path('/storage/afiliado/'.$fileName));
                $conductor->foto=$fileName;
            }
            /**
             * Documentacion y fecha de vigencia de los mismos
             */
            $conductor->categoria_licencia=mb_strtoupper($request->categoria_licencia);
            $conductor->fecha_licencia=$request->get('fecha_licencia');

            $conductor->save();
            DB::commit();
            alert()->success($conductor->nombre,'Datos actualizados correctamente');
            // return redirect()->route('conductor.index');
            return redirect()->route('conductor.show',$conductor_id);
        }catch(\Exception $e){

            DB::rollback();
            $error = $e->getMessage();
            alert()->warning('No se ha podido actualizar los datos <br>'.$error, $conductor->nombre )->persistent('Ok')->html();
            return redirect()->back();
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Conductor  $conductor
     * @return \Illuminate\Http\Response
     */
    public function destroy($conductor_id)
    {
        //
    }

    public function cambiar_Estado($conductor_id)
    {
        DB::beginTransaction();

        try {

            $usuario= Conductor::where('id',$conductor_id)->first();
                        
            $estado = ($usuario->estado=='0') ? '1': '0'; //saber el estado actual y cambiarlo
            
            $usuario->estado=$estado;
            $usuario->save();

            $estado = ($usuario->estado=='0') ? 'Usuario activado ': 'Usuario desactivado'; //saber el estado cambiado para mostrar el mensaje

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

    public function updateFoto(Request $request,$conductor_id )
    {
        DB::beginTransaction();

        try {
            /**
             * Datos del Cliente
             */
            $conductor=Conductor::where('id',$conductor_id)->first();

            if($request->file('file')!=null){
                $foto=$request->file('file');
                $fileName = 'item-'.$conductor->dni.'.'.$foto->getClientOriginalExtension();
                \Image::make($foto)
                    ->resize(600, null, function ($constraint) {$constraint->aspectRatio();})
                    ->save(public_path('/storage/afiliado/'.$fileName));
                $conductor->foto=$fileName;
            }
            

            $conductor->save();
            DB::commit();
            alert()->success($conductor->nombre,'Foto actualizado');
            return redirect()->route('conductor.show',$conductor_id);
        }catch(\Exception $e){

            DB::rollback();
            $error = $e->getMessage();
            alert()->warning('No se ha podido actualizar la foto de  <br>'.$error, $conductor->nombre )->persistent('Ok')->html();
            return redirect()->back();
        };
    }

    public function deshabilitados()
    {
        $conductores=Conductor::select('id', 'nombre', 'apellido','celular','estado')->where('empresa_id',auth()->user()->empresa_id)->where('estado','1')->get();
        // return response()->json($conductores);
        return view('conductor.deshabilitados', compact('conductores'));
    }

    public function buscar(Request $request){
        if (strlen($request->get('documento'))==8) {
            $dni = $request->documento;
    
            $cs = new Dni(new ContextClient(), new DniParser());
            $person = $cs->get($dni);
            if (!$person) {
                echo ' No se encontró el DNI o falló conexion con JNE';
                exit();
            }
            return response()->json($person);
        }
        if (strlen($request->get('documento'))==11) {
            $ruc = $request->get('documento');

            $cs = new Ruc(new ContextClient(), new RucParser(new HtmlParser()));

            $company = $cs->get($ruc);
            if (!$company) {
                echo 'No se encontró el RUC o falló conexion con SUNAT';
                exit();
            }

            return response()->json($company);
        }
    }

    
}
