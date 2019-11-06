@extends('layouts.login')

@section('content')
<div class=" div-login" >
  <div class="login text-center">
      <hr>
      <div class="title">INICIAR SESIÓN</div>
  </div>
  <form action="" method="get" class="card">
      <div class="card-body">
          <div class="form-group">
            <i class="fa fa-user" aria-hidden="true"></i><input type="text" name="dni" id="dni" class="form-control " >
          </div>
          <div class="form-group">
            <i class="fa fa-at" aria-hidden="true"></i><input type="text" name="dni" id="dni" class="form-control " >
          </div>
          <div class="form-group text-center">
              <button class="btn btn-primary mb-3 mt-3 form-control">INGRESAR</button>
              <a href="#">Olvidé mi contraseña</a>

          </div>
      </div>
  </form>
</div> 
@endsection