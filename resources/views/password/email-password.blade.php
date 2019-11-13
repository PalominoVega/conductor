@extends('layouts.login')

@section('content')
<div class=" div-login" >
  <div class="login text-center">
      <hr>
      <div class="title">RECUPERAR CONTRASEÑA</div>
  </div>
  <form action="{{ route('recuperar.password.email') }}" method="post" class="card">
    @csrf
      <div class="card-body">
          <div class="form-group">
            <i class="icon-at" aria-hidden="true"></i><input type="email" name="email" id="email" class="form-control " placeholder="correo electronico" >
          </div>
          <div class="form-group text-center">
              <button class="btn btn-primary mb-3 mt-3 form-control">ENVIAR</button>

          </div>
      </div>
  </form>
</div> 
@endsection