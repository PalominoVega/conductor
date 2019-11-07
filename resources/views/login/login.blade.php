@extends('layouts.login')

@section('content')
<div class=" div-login" >
    @if (count($errors))
      {{-- {{$errors}} --}}
      @foreach ($errors->all() as $item)
          <span class="error">{{$item}}</span><br>
      @endforeach
    @endif
  <div class="login text-center">
      <hr>
      <div class="title">INICIAR SESIÓN</div>
  </div>
  <form  action="{{ route('postlogin') }}" method="post" class="card">
      @csrf
      <div class="card-body">
          <div class="form-group">
            <i class="fa fa-user" aria-hidden="true"></i><input type="text" name="email" id="email" class="form-control " >
          </div>
          <div class="form-group">
            <i class="fa fa-at" aria-hidden="true"></i><input type="password" name="password" id="password" class="form-control " >
          </div>
          <div class="form-group text-center">
              <button class="btn btn-primary mb-3 mt-3 form-control">INGRESAR</button>
              <a href="#">Olvidé mi contraseña</a>

          </div>
      </div>
  </form>
</div> 
@endsection

@section('script')
    <script>

      var error="{{$errors}}";
      console.log(error);

            
      $(document).ready(function(){
            var conceptos = @json($errors);
            console.log(conceptos);
            
           
        });

    </script>
@endsection