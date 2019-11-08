@extends('layouts.admin')
@section('content')
    <div class="row align-items-center justify-content-center row-perfil">
        <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-perfil">
            <div class="card card-perfil ">
                <div class="card-title-perfil text-center">
                    <h4 class="text-white">EDITAR DE CONDUCTOR</h4>
                    <div class="card-avatar " >
                        <img id=imgSalida src="https://cdn.forbes.com.mx/2019/03/chiron-640x360.jpg" alt="" >
                    </div>
                    
                </div>
                <div class="card-body">
                    <div class="card-body-data">
                        <p>
                            <i class="fa fa-user" aria-hidden="true"></i>{{$vehiculo->unidad}} <br>
                            <i class="fa fa-id-card" aria-hidden="true"></i>{{$vehiculo->placa}} <br>
                        </p>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary" id="editar">Editar</button>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-xl-6">
            <div class="card ">
                <div class="card-header">
                    <div class="card-title">Datos del Conductor</div>
                </div>
                <form action="{{ route('vehiculo.update',$vehiculo->id) }}" method="post"  class="mb-2">
                        @csrf {{ method_field('PUT') }}
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">unidad</label>
                                    <input type="text" name="unidad" id="unidad" class="form-control form-control-sm" value="{{ old('unidad', $vehiculo->unidad)}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">placa</label>
                                    <input type="text" name="placa" id="placa" class="form-control form-control-sm" value="{{ old('placa', $vehiculo->placa)}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">marca</label>
                                    <input type="text" name="marca" id="marca" class="form-control form-control-sm" value="{{ old('marca', $vehiculo->marca)}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">modelo</label>
                                    <input type="text" name="modelo" id="modelo" class="form-control form-control-sm" value="{{ old('modelo', $vehiculo->modelo)}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">color</label>
                                    <input type="text" name="color" id="color" class="form-control form-control-sm" value="{{ old('color', $vehiculo->color)}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">año</label>
                                    <input type="text" name="anio" id="anio" class="form-control form-control-sm" value="{{ old('anio', $vehiculo->anio)}}" readonly>
                                </div>
                            </div>
                            
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">soat</label>
                                    <input type="text" name="soat" id="soat" class="form-control form-control-sm" value="{{ old('soat', $vehiculo->soat)}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">FECHA DE CADUCIDAD</label>
                                    <input type="date" name="fecha_soat" id="fecha_soat" class="form-control form-control-sm" value="{{ old('fecha_soat', $vehiculo->fecha_soat)}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">revision tecnica </label>
                                    <input type="text" name="empresa_revision_tecnica" id="empresa_revision_tecnica" class="form-control form-control-sm" value="{{ old('empresa_revision_tecnica', $vehiculo->empresa_revision_tecnica)}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">FECHA DE CADUCIDAD</label>
                                    <input type="date" name="fecha_revision_tecnica" id="fecha_revision_tecnica" class="form-control form-control-sm" value="{{ old('fecha_revision_tecnica', $vehiculo->fecha_revision_tecnica)}}" readonly>
                                </div>
                            </div>
                            {{-- <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="text" name="" id="" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="text" name="" id="" class="form-control" readonly>
                                </div>
                            </div>     --}}
                        </div>    
                    </div>
                    <div class="card-footer text-center" >
                        <button type="submit" class="btn btn-primary" id="guardar" hidden>Guardar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection


@section('script')
    <script>

        $('body').on('click', '#editar', function(event) {
            $("form").find(':input').each(function(){
       		    $(this).removeAttr('readonly');
            });
            $('#guardar').removeAttr('hidden'); 
            $('#editar').attr('hidden','hidden');
        });

        // $(document).ready(function(){
            if(@json($errors->any())){
                $("form").find(':input').each(function(){
                    $(this).removeAttr('readonly');
                });

                $('#editar').attr('hidden','hidden');
                $('#guardar').removeAttr('hidden'); 
            }
        // });

    </script>
@endsection