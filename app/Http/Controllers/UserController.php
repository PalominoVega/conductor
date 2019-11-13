<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use Carbon\Carbon;
use Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function view_cambiar_contrasenia()
    {
        return view('password.cambiar-contrasenia');
    }
    
    public function cambiar_contrasenia(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'newpassword' => 'required',
            'repassword' => 'required|same:newpassword',
        ]);
        DB::beginTransaction();

        if (Hash::check(Input::get('password'), auth()->user()->password)){
            try{
                $user = auth()->user();
                $user->password = Hash::make(Input::get('newpassword'));
                $user->save();
                DB::commit();
                alert()->success($user->nombre,'Nueva contraseña guardada correctamente');
                return back();
            }catch(\Exception $e){
                DB::rollback();
                $error = $e->getMessage();
                alert()->warning('No se ha podido guardar la nueva contaseña <br>'.$error, $user->nombre )->persistent('Ok')->html();
                return back();
            };
        }
        else{
            return back()
            ->withInput(request(['password']))
            ->withErrors(['password'=>trans('La contraseña actual no es correcta')]); 
        }
    }
    public function password()
    {
        return view('password.email-password');
    }  
    
    public function email_contrasenia(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        DB::beginTransaction();

        try{
            $usuario=User::where('email',$request->email)->first();
            
            if(is_null($usuario)){
                alert()->warning('Correo no ha sido encontrado', $user->nombre )->persistent('Ok')->html();
                return back();
            }
            $usuario->api_token=$usuario->empresa_id.'_'.Carbon::now()->format('YmdHisu');
            $usuario->save();

            Mail::send('password.email', ["empresa"=>$usuario->empresa->nombre,"usuario"=>$usuario], function ($message) use ($usuario) {
                $message->subject('Recuperación de Contraseña');
                $message->to($usuario->email);
            });

            // Mail::to($usuario->email)->send(new CredencialesUserMail($usuario));

            DB::commit();
            alert()->success($usuario->nombre,'Verifique su correo');
            return back();

        }catch(\Exception $e){
            DB::rollback();
            alert()->warning('No se ha podido enviar el mensaje a su correo <br>'.$e->getMessage(), 'usuario')->persistent('Ok')->html();
            return back();
        };
    }


    public function nueva_contrasenia(Request $request, $token)
    {
        $this->validate($request, [
            'password' => 'required',
            'repassword' => 'required|same:password',
        ]);

        DB::beginTransaction();
        
        $usuario=User::where('api_token',$token)->first();

        if(is_null($usuario)){
            alert()->warning('Token invalido', 'usuario')->persistent('Ok')->html();
            return back();
        }

        try{
            // $usuario->password = Hash::make($request->password);
            $usuario->password = bcrypt($request->password);
            $usuario->api_token=session('empresa_id').'_'.Carbon::now()->format('YmdHisu');
            $usuario->save();

            // Mail::send('Mail.prueba', ["empresa"=>$usuario->empresa->nombre,"usuario"=>$usuario, "contrasenia"=>$request->password], function ($message) use ($usuario) {
            //     $message->subject('Credenciales del usuario');
            //     $message->to($usuario->email);
            // });
            DB::commit();
            alert()->success($usuario->nombre,'Nueva contraseña registrada');
            return view('login.login');

        }catch(\Exception $e){
            DB::rollback();
            alert()->warning('Surgio un error <br>'.$e->getMessage(), $usuario->nombre)->persistent('Ok')->html();
            return back();
            // return response()->json([
            //     "status"    =>  "DANGER",
            //     "data"      =>  $e->getMessage()
            // ]);
        };
        
    }
}
