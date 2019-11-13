@extends('layouts.login')

@section('content')
<div class=" div-login" >
  <div class="login text-center">
      <hr>
      <div class="title">Nueva Contraseña</div>
  </div>
  {{-- {{dd(request()->route()->parameters['token'])}} --}}
  <form  action="{{ route('new.password',request()->route()->parameters["token"]) }}" method="post" class="card">
      @csrf {{ method_field('PUT') }}
      <div class="card-body">
          <div class="form-group">
            <i class="icon-contrania" aria-hidden="true"></i><input type="password" name="password" id="password" class="form-control " placeholder="contraseña">
          </div>
          <div class="form-group">
            <i class="icon-contrania" aria-hidden="true"></i><input type="password" name="repassword" id="repassword" class="form-control " placeholder="repitir contraseña" >
          </div>
          <div class="form-group text-center">
              <button class="btn btn-primary mb-3 mt-3 form-control">Guardar</button>
          </div>
      </div>
  </form>
</div> 
@endsection

@section('script')
    <script>

      
      

    </script>
@endsection 