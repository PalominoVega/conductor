@extends('layouts.login')

@section('content')
<div class=" div-login" >
  <div class="login text-center">
      <hr>
      <div class="title">REGISTRO DE CUENTA</div>
  </div>
  <form action="{{ route('empresa.store') }}" method="post" enctype="multipart/form-data"   >
    @csrf
    
    <div class="card registrar my-5">
        <div class="card-header">
            <div class="card-title">Datos de la empresa</div>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label for="">NOMBRES</label>
                        <input type="text" name="nombreempresa" id="nombreempresa" class="form-control form-control-sm" value="{{old('nombreempresa')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">RUC</label>
                        <input type="text" name="ruc" id="ruc" class="form-control form-control-sm" value="{{old('ruc')}}"  >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">E-MAIL</label>
                        <input type="text" name="emailempresa" id="emailempresa" class="form-control form-control-sm" value="{{old('emailempresa')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">TELEFONO </label>
                        <input type="text" name="telefonoempresa" id="telefonoempresa" class="form-control form-control-sm" value="{{old('telefonoempresa')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">DIRECCIÓN</label>
                        <input type="text" name="direccionempresa" id="direccionempresa" class="form-control form-control-sm" value="{{old('direccionempresa')}}" >
                    </div>
                </div>
            </div>    
        </div>
        <div class="card-header">
            <div class="card-title">Datos GPS</div>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">CUENTA</label>
                        <input type="text" name="cuenta" id="cuenta" class="form-control form-control-sm" value="{{old('cuenta')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">USUARIO</label>
                        <input type="text" name="usuario" id="usuario" class="form-control form-control-sm" value="{{old('usuario')}}"  >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">CONTRASEÑA</label>
                        <input type="text" name="contraseniacuenta" id="contraseniacuenta" class="form-control form-control-sm" value="{{old('contraseniacuenta')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">GRUPO </label>
                        <input type="text" name="grupo" id="grupo" class="form-control form-control-sm" value="{{old('grupo')}}" >
                    </div>
                </div>
            </div>    
        </div>
        <div class="card-header">
            <div class="card-title">Datos del Usuario</div>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">NOMBRES</label>
                        <input type="text" name="nombre" id="nombre" class="form-control form-control-sm" value="{{old('nombre')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">APELLIDOS</label>
                        <input type="text" name="apellido" id="apellido" class="form-control form-control-sm" value="{{old('apellido')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control form-control-sm" value="{{old('dni')}}"  >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">E-MAIL</label>
                        <input type="text" name="email" id="email" class="form-control form-control-sm" value="{{old('email')}}" >
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">CELULAR</label>
                        <input type="text" name="numero" id="numero" class="form-control form-control-sm" value="{{old('numero')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">CONTRASEÑA</label>
                        <input type="password" name="contrasenia" id="contrasenia" class="form-control form-control-sm" value="{{old('contrasenia')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="form-group">
                        <label for="">DIRECCIÓN</label>
                        <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" value="{{old('direccion')}}" >
                    </div>
                </div>
            </div>    
        </div>
        <div class="card-footer text-center" >
            <button class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>
</div> 
@endsection