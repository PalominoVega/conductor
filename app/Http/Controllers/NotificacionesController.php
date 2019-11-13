<?php

namespace App\Http\Controllers;

use App\Model\Conductor;
use App\Model\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class NotificacionesController extends Controller
{
    public function alerta_docs(Request $request){
        $fechaprevencion=Carbon::now()->format('Y-m-d');
        $fechaprevencion2=Carbon::now()->addDays(7)->format('Y-m-d');
        $fechaprevencion3=Carbon::now()->addDays(1)->format('Y-m-d');
        $docs_soat=Vehiculo::select('id','placa','fecha_soat as fecha','unidad', DB::Raw('DATEDIFF(fecha_soat,CURDATE()) as dias'))
                        ->where(function ($query) use ($fechaprevencion, $fechaprevencion2) {
                            return $query->whereBetween('fecha_soat',[$fechaprevencion,$fechaprevencion2])
                            ->orWhere('fecha_soat','<',$fechaprevencion2);
                        })
                        ->where('empresa_id',auth()->user()->empresa_id)
                        ->orderBy('dias','asc')
                        ->get();
        $docs_licencia=Conductor::select('nombre','apellido','fecha_licencia as fecha','celular', DB::Raw('DATEDIFF(fecha_licencia,CURDATE()) as dias'))
                        ->where(function ($query) use ($fechaprevencion, $fechaprevencion3) {
                            return $query->whereBetween('fecha_licencia',[$fechaprevencion,$fechaprevencion3])
                            ->orWhere('fecha_licencia','<',$fechaprevencion3);
                        })
                        // ->whereBetween('fecha_licencia',[$fechaprevencion,$fechaprevencion3])
                        // ->orWhere('fecha_licencia','<',$fechaprevencion3)
                        ->where('empresa_id',auth()->user()->empresa_id)
                        ->orderBy('dias','asc')
                        ->get(); 
        $doc_revicion_tecnica=Vehiculo::select('id','placa','fecha_revision_tecnica as fecha','unidad', DB::Raw('DATEDIFF(fecha_revision_tecnica,CURDATE()) as dias'))
                        ->where(function ($query) use ($fechaprevencion, $fechaprevencion2) {
                            return $query->whereBetween('fecha_revision_tecnica',[$fechaprevencion,$fechaprevencion2])
                            ->orWhere('fecha_revision_tecnica','<',$fechaprevencion2);
                        })
                        // ->whereBetween('fecha_tecnica',[$fechaprevencion,$fechaprevencion2])
                        // ->orWhere('fecha_tecnica','<',$fechaprevencion2)
                        ->where('empresa_id',auth()->user()->empresa_id)
                        ->orderBy('dias','asc')
                        ->get(); 
        return view('notificacion.index',compact('docs_soat','docs_licencia','doc_revicion_tecnica'));
    }
}
