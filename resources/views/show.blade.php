@extends('layouts.admin')
@section('content')
    <div class="row align-items-center justify-content-center row-perfil">
        <div class="col-12 col-sm-12 col-md-6 col-xl-4 col-perfil">
            <div class="card card-perfil ">
                <div class="card-title-perfil text-center">
                    <h4 class="text-white">REGISTRO DE CONDUCTOR</h4>
                    <div class="card-avatar">
                            {{-- <div class="div-config-logo"> --}}
                                    <img id=imgSalida src="https://www.conoceatuconductor.com/iconos/user.png" alt="" >
                            {{-- </div> --}}
                            {{-- <div class="upload-btn-wrapper ">
                                <button class="btn" id="btn-foto">Subir Foto</button>                                
                                <input id="txt-foto" name="file" type="file"readonly>
                            </div> --}}

                    </div>
                </div>
                <div class="card-body">
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
                            <i class="fa fa-user" aria-hidden="true"></i>NOMBRES Y APELLIDOS <br>
                            <i class="fa fa-id-card" aria-hidden="true"></i>12345678 <br>
                            <i class="fa fa-phone" aria-hidden="true"></i>123456789
                        </p>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary">Editar</button>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-xl-6">
            <div class="card registrar">
                <div class="card-header">
                    <div class="card-title">Datos del Conductor</div>
                </div>

                <div class="card-body ">
                    <form action="" method="post" >
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">DNI</label>
                                    <input type="text" name="dni" id="dni" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">E-MAIL</label>
                                    <input type="text" name="emial" id="emial" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">NOMBRES</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">APELLIDOS</label>
                                    <input type="text" name="apellido" id="apellido" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">CELULAR</label>
                                    <input type="text" name="celular" id="celular" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">TIPO DE SANGRE</label>
                                    <input type="text" name="tipo_sangre" id="tipo_sangre" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">DIRECCIÓN</label>
                                    <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">FECHA DE NACIMIENTO</label>
                                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">LICENCIA DE CONDUCIR </label>
                                    <input type="text" name="categoria-licencia" id="categoria-licencia" class="form-control form-control-sm" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group">
                                    <label for="">FECHA DE CADUCIDAD</label>
                                    <input type="date" name="fecha_licencia" id="fecha_licencia" class="form-control form-control-sm" readonly>
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
                    </form>
                </div>
                <div class="card-footer text-center" >
                    <button class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
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

    </script>
@endsection