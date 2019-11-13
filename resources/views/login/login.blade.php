@extends('layouts.login')

@section('content')
<div class=" div-login" >
    
  <div class="login text-center">
      <hr>
      <div class="title">INICIAR SESIÓN</div>
  </div>
  <form  action="{{ route('postlogin') }}" method="post" class="card">
      @csrf
      <div class="card-body">
          <div class="form-group">
            <i class="icon-user" aria-hidden="true"></i><input type="text" name="email" id="email" class="form-control " placeholder="usuario" >
          </div>
          <div class="form-group">
            <i class="icon-contrania" aria-hidden="true"></i><input type="password" name="password" id="password" class="form-control " placeholder="contraseña">
          </div>
          <div class="form-group text-center">
              <button class="btn btn-primary mb-3 mt-3 form-control">INGRESAR</button>
              <a href="{{ route('recuperar.password') }}">Olvidé mi contraseña</a>

          </div>
      </div>
  </form>
</div> 
@endsection

