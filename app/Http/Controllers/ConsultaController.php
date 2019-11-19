<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Peru\Http\ContextClient;
use Peru\Jne\{Dni, DniParser};
use Peru\Sunat\{HtmlParser, Ruc, RucParser};

class ConsultaController extends Controller
{
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
