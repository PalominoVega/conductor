<?php

namespace App\Http\Controllers;

use App\Model\Empresa;
use Illuminate\Http\Request;

use App\Model\User;
use App\Model\Configuracion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmpresaValidation;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa=Empresa::all();
        return response()->json($empresa);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            
            $empresa = new Empresa();
            $nombre="logoFC.png";
            $empresa->nombre=$request->nombreempresa;
            $empresa->direccion=mb_strtoupper($request->direccionempresa);
            $empresa->telefono=$request->telefonoempresa;
            $empresa->email=$request->emailempresa;
            $empresa->ruc=$request->ruc;
        
            $id=str_random(3);
            if($request->file('file')!=""){
                $file = $request->file('file');
                $extension=$file->getClientOriginalExtension();
                $nombre='item'.$id.'.'.$extension;            
                Storage::disk('public/storage/logo/')->put($nombre,  \File::get($file));
                // public_path('/storage/producto/'.$fileName)
            }
            $empresa->logo=$nombre;
            $empresa->save();
            $id_empresa=$empresa->id;
            
            /* registrar usuarios */
            $user=new User();
            $user->nombre=mb_strtoupper($request->nombre);
            $user->apellido=mb_strtoupper($request->apellido);
            $user->email=$request->email;
            $user->dni=$request->dni;
            $user->numero=$request->numero;
            $user->password=bcrypt($request->contrasenia);
            $user->direccion=$request->direccion;
            $user->api_token=$id_empresa.'_'.Carbon::now()->format('YmdHisu');
            $user->estado='2';
            $user->empresa_id=$id_empresa;
            $user->save();

            /**
             * cuenta
             */
            $cuenta=new Configuracion();
            $cuenta->a=$request->cuenta;
            $cuenta->u=$request->usuario;
            $cuenta->p=$request->contraseniacuenta;
            $cuenta->g=$request->grupo;
            $cuenta->empresa_id=$id_empresa;
            $cuenta->save();
            DB::commit();
            alert()->success($empresa->nombre,'Datos registrados correctamente');
            return redirect()->back();
        }catch(\Exception $e){

            DB::rollback();
            $error = $e->getMessage();
            alert()->warning('No se ha podido registrar los datos <br>'.$error, $empresa->nombre )->persistent('Ok')->html();
            return redirect()->back();
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show($empresa_id)
    {
        $empresa= Empresa::where('id',$id)->first();
        return response()->json($empresa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit($empresa_id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $empresa_id)
    {
        DB::beginTransaction();

        try {
            $empresa= Empresa::where('id',$id)->first();
            $empresa->nombre=$request->nombreempresa;
            $empresa->ruc=$request->ruc;
            $empresa->direccion=mb_strtoupper($request->direccionempresa);
            $empresa->telefono=$request->telefonoempresa;
            $empresa->email=$request->emailempresa;
            $nombre=$empresa->logo;
            if($request->file('file')!=""){
                $file = $request->file('file');
                $extension=$file->getClientOriginalExtension();
                $nombre='item'.$empresa_id.'.'.$extension;            
                Storage::disk('public/storage/logo/')->put($nombre,  \File::get($file));
            }
            $empresa->logo=$nombre;
            $empresa->save();
            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  ($request->data==true) ? $empresa : "Empresa  actualizada",
            ]);


        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"    =>  "DANGER",
                "data"      =>  $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy($empresa_id)
    {
        //
    }

    public function cambiar_Estado($id)
    {
        DB::beginTransaction();

        try {

            $empresa= Empresa::where('id',$id)->first();
            
            $estado = ($empresa->estado=='0') ? '1': '0'; //saber el estado actual y cambiarlo
            
            $empresa->estado=$estado;
            $empresa->save();

            $estado = ($empresa->estado=='0') ? 'La cuenta de la empresa fue desactivado': 'La cuenta de la empresa fue activado'; //saber el estado cambiado para mostrar el mensaje

            DB::commit();
            return response()->json([
                "status"    =>  "OK",
                "data"      =>  ($request->data==true) ? $empresa : $estado,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                "status"    =>  "DANGER",
                "data"      =>  $e->getMessage(),
            ]);
        }
    }
}