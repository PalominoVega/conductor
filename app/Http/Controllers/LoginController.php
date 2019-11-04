<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Validator;
use App\Model\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function postLogin(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()
                ->json([
                    "status"=>'VALIDATION',
                    "data"=>$validator->messages()
                ]);
        }
        
        $usuario=User::where('email',$request->email)->first();
        if(is_null($usuario))
            return response()->json([
                "status"    =>  "WARNING",
                "data"=>"Email no encontrado",
            ]);
        
        if(Hash::check($request->password, $usuario->password)){

            if (($usuario->estado=='0' || $usuario->estado=='2') && $usuario->empresa->tipo=='Activo'){
                return redirect()->route('home');
            }elseif ($usuario->empresa->tipo=='Inactivo') {
                return response()->json([
                    "status"    =>  "WARNING",
                    "data"=>"Removar contrato",
                ]);
            }
            return response()->json([
                "status"    =>  "WARNING",
                "data"=>"Su cuenta está deshabilitada",
            ]);
        };
                
    }

    public function cerrar_session(Request $request){
        session()->forget('user');
        return redirect('/home');   
    }

    public function redirectPath()
    {
        if(Auth::check()){
            return '/home';
        }
        return '/';
    }

    public function check(){
        if(Auth::check()) return ['status'=>true];
        else return ['status'=>false];
    }

}
