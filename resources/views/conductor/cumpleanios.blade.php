@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card-table my-3">
        <div class="card-header">
            <div class="card-title">Lista de cumpleaños de {{$nombre_mes}}</div>
            <button class="btn btn-primary card-title" data-toggle="modal" data-target="#fecha" data-placement="top" title="Busqueda por fecha"><span><i class="icon-calendario2"></i></button>
        </div>
        <div class="table-responsive-general">
            <table id="hola" class="table table-card dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>Nombres y Apellidos</th>
                        <th>Celular</th>
                        <th class="text-center">Día</th>
                        <th class="text-center">Edad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conductores as $conductor)
                        <tr>
                            <td>{{$conductor->nombre.' '.$conductor->apellido}}</td>
                            <td>{{$conductor->celular}}</td>
                            <td class="text-center">{{$conductor->dia}}</td>
                            <td class="text-center">{{$conductor->edad}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

    <div class="modal fade" id="fecha" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title titulo" id="exampleModalCenterTitle">Fechas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="get" action="{{route('conductor.cumpleanios')}}"> 
                        <div class="row justify-content-center titulo-table">
                            <div class="col-sm-7 form-group" >
                                <select name="mes_actual"  id="mes_actual" class="form-control {{ $errors->has('mes_actual') ? 'input-error' : '' }}">
                                    <option value="" selected>Selecionar opción</option>
                                    <option value=01 >Enero</option>
                                    <option value=02 >Febrero</option>
                                    <option value=03 >Marzo</option>
                                    <option value=04 >Abril</option>
                                    <option value=05 >Mayo</option>
                                    <option value=06 >Junio</option>
                                    <option value=07 >Julio</option>
                                    <option value=08 >Agosto</option>
                                    <option value=09 >Septiembre</option>
                                    <option value=10 >Octubre</option>
                                    <option value=11 >Noviembre</option>
                                    <option value=12 >Diciembre</option>
                                </select>
                            </div>
                            <div class="col-sm-2 col-6 form-group">
                                <button type="submit" class="btn btn-primary">Buscar</button>
                            </div>
                        </div>
                        {{-- <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">OK</button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{asset('js/datatable.js')}}"></script>
    <script>

        $(document).ready(function(){
            var url=document.URL;
            url=url.split("=");
            if(url.length==2){
                let url_parametro=parseInt(url[1]);
                $("#mes_actual option").each(function(){
                    if($(this).attr('value')==url_parametro){
                        $("#mes_actual option[value="+url_parametro+"]").attr("selected",true);
                    }
                });
            }
        });
    </script>
@endsection