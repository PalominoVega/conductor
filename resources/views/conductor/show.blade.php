@extends('layouts.admin')
@section('content')
@if (count($errors))
{{$errors}}
@foreach ($errors->all() as $item)
    <span class="error">{{$item}}</span><br>
@endforeach
@endif
    <div class="row align-items-center justify-content-center row-perfil">
        <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-perfil">
            <div class="card card-perfil ">
                <div class="card-title-perfil text-center">
                    <h4 class="text-white">EDITAR DE CONDUCTOR</h4>
                    <div class="card-avatar " >
                        <img id=imgSalida src="{{asset('storage/afiliado').'/'.$conductor->foto}}" alt="" >
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('conductor.update.foto',$conductor->id) }}" method="post" enctype="multipart/form-data" class="mb-2">
                        @csrf {{ method_field('PUT') }}
                        <span class="file-wrapper">
                            <span class="button"><i class="fa fa-plus text-white" aria-hidden="true"></i></span>
                            <input id="txt-foto" name="file" type="file"readonly>
                        </span>
                        <button type="submit" class="btn btn-primary mt-2" id="guardar-foto" hidden>Guardar Foto</button>
                    </form>
                        {{-- <div class="upload-btn-wrapper mt-2" >
                            <button class="btn" id="btn-foto"><i class="fa fa-plus-circle" aria-hidden="true"></i></button> 
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <form action="" method="get">
                                <input id="txt-foto" name="file" type="file"readonly>
                                <button type="submit" class="btn btn-primary" hidden>Guardar Foto</button>
                            </form>
                        </div> --}}
                    <div class="card-body-data">
                        {{-- <div class="form-group"> --}}
                            {{-- <label for=""><i class="fa fa-user" aria-hidden="true"></i>NOMBRES Y APELLIDOS</label> --}}
                        {{-- </div> --}}
                        {{-- <div class="form-group"> --}}
                            {{-- <label for=""> <i class="fa fa-id-card" aria-hidden="true"></i>12345678 </label> --}}
                        {{-- </div> --}}
                        {{-- <div class="form-group"> --}}
                            {{-- <label for=""><i class="fa fa-phone" aria-hidden="true"></i>123456789</label> --}}
                        {{-- </div> --}}
                        <p>
                        <i class="fa fa-user" aria-hidden="true"></i> {{$conductor->nombre.' '.$conductor->apellidos}}<br>
                            <i class="fa fa-id-card" aria-hidden="true"></i>{{$conductor->dni}} <br>
                            <i class="fa fa-phone" aria-hidden="true"></i>{{$conductor->celular}}
                        </p>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary" id="editar">Editar</button>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-xl-6">
            <form action="{{ route('conductor.update', $conductor->id) }}" method="post">
                @csrf {{ method_field('PUT') }}
                <div class="card ">
                    <div class="card-header">
                        <div class="card-title">Datos del Conductor</div>
                    </div>

                    <div class="card-body ">
                        @if (old('dni'))
                            hola
                        @else
                            hola2
                        @endif
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="">DNI</label>
                                        <input type="text" name="dni" id="dni" class="form-control form-control-sm"  value="{{ old('dni',$conductor->dni)  }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="">E-MAIL</label>
                                        <input type="text" name="email" id="email" class="form-control form-control-sm" value="{{ old('email', $conductor->email)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="">NOMBRES</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" value="{{old('nombre' ,$conductor->nombre)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="">APELLIDOS</label>
                                        <input type="text" name="apellido" id="apellido" class="form-control form-control-sm" value="{{old('apellido' ,$conductor->apellido)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="">CELULAR</label>
                                        <input type="text" name="celular" id="celular" class="form-control form-control-sm" value="{{old('celular' ,$conductor->celular)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="">TIPO DE SANGRE</label>
                                        <input type="text" name="tipo_sangre" id="tipo_sangre" class="form-control form-control-sm" value="{{old('tipo_sangre' ,$conductor->tipo_sangre)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="">DIRECCIÓN</label>
                                        <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" value="{{old('direccion' ,$conductor->direccion)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="">FECHA DE NACIMIENTO</label>
                                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-sm" value="{{old('fecha_nacimiento' ,$conductor->fecha_nacimiento)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="">LICENCIA DE CONDUCIR </label>
                                        <input type="text" name="categoria_licencia" id="categoria_licencia" class="form-control form-control-sm" value="{{old('categoria_licencia' ,$conductor->categoria_licencia)}}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group">
                                        <label for="">FECHA DE CADUCIDAD</label>
                                        <input type="date" name="fecha_licencia" id="fecha_licencia" class="form-control form-control-sm" value="{{old('fecha_licencia' ,$conductor->fecha_licencia)}}" readonly>
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
                </div>
            </form>
        </div>
    </div>

@endsection


@section('script')
    <script>
        $(function() {
          $('#txt-foto').change(function(e) {
            addImage(e); 
          });

          function addImage(e){
            var file = e.target.files[0],
            imageType = /image.*/;
          
            if (!file.type.match(imageType))
              return;
        
            var reader = new FileReader();
            reader.onload = fileOnload;
            reader.readAsDataURL(file);
          }
        
          function fileOnload(e) {
            $('#imgSalida').removeAttr('hidden');
            var result=e.target.result;
            $('#imgSalida').attr("src",result);
            }
          }
        );

        $('body').on('click', '#editar', function(event) {
            $("form").find(':input').each(function(){
       		    $(this).removeAttr('readonly');
            });
            $('#guardar').removeAttr('hidden'); 
            $('.upload-btn-wrapper').removeAttr('hidden'); 
            $('#editar').attr('hidden','hidden');
        });

        $('body').on('click', '.file-wrapper', function(event) {
            $('.file-wrapper').css({'margin-left':'90px'});
            $('#guardar-foto').removeAttr('hidden'); 
            $('#editar').attr('hidden','hidden');
        });

        @if (count($errors)>0)
            $("form").find(':input').each(function(){
       		    $(this).removeAttr('readonly');
            });
        @endif

    </script>
@endsection