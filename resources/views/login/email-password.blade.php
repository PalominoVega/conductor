@extends('layouts.login')

@section('content')
<div class=" div-login" >
  <div class="login text-center">
      <hr>
      <div class="title">RECUPERAR CONTRASEÑA</div>
  </div>
  <form action="" method="get" class="card">
      <div class="card-body">
          <div class="form-group">
            <i class="fa fa-at" aria-hidden="true"></i><input type="text" name="dni" id="dni" class="form-control " >
          </div>
          <div class="form-group text-center">
              <button class="btn btn-primary mb-3 mt-3 form-control">ENVIAR</button>

          </div>
      </div>
  </form>
</div> 
@endsection