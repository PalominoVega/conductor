<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\LoginValidation;


class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function postLogin(Request $request)
    {
        $credentials=$this->validate($request, [
            'email' => 'required', 
            'password' => 'required',
        ]);
       
        if(Auth::attempt($credentials)){
            if (Auth::user()->estado!='1' && Auth::user()->empresa->estado=='0') {
                // dd('hola');
                return redirect()->route('conductor.index');
            }
            
            if (Auth::user()->empresa->estado=='1') {
                Auth::logout(); Session::flush();
                return back()
                ->withInput(request(['email']))
                ->withErrors(['email'=>trans('Removar contrato')]); 
            }
            Auth::logout(); Session::flush();
            return back()
            ->withInput(request(['email']))
            ->withErrors(['email'=>trans('Su cuenta está deshabilitada')]); 
        }

        return back()
                ->withInput(request(['email']))
                ->withErrors(['email'=>trans('auth.failed')]);
    }

    public function cerrar_session(Request $request){
        Auth::logout(); Session::flush();
        return json_encode('salir');   
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
