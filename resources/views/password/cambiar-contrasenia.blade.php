@extends('layouts.admin')
@section('content')
 
<form action="{{ route('store_cambiar_contrasenia') }}" method="post" enctype="multipart/form-data"   >
    @csrf {{ method_field('PUT') }}
    
    <div class="card registrar my-5  container-contrasenia">
        <div class="card-header">
            <div class="card-title">Cambiar Contraseña</div>
        </div>

        <div class="card-body ">
            <div class="row">
                <div class="col-12 ">
                    <div class="form-group">
                        <label for="">Contraseña Actual</label>
                        <input type="password" name="password" id="password" class="form-control form-control-sm" value="{{old('password')}}"  >
                    </div>
                </div>
                <div class="col-12 ">
                    <div class="form-group">
                        <label for="">Nueva Contraseña</label>
                        <input type="password" name="newpassword" id="newpassword" class="form-control form-control-sm" value="{{old('newpassword')}}" >
                    </div>
                </div>
                <div class="col-12 ">
                    <div class="form-group">
                        <label for="">Repetir Contraseña</label>
                        <input type="password" name="repassword" id="repassword" class="form-control form-control-sm" value="{{old('repassword')}}" >
                    </div>
                </div>
                
            </div>    
        </div>
        <div class="card-footer text-center" >
            <button class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>
@endsection


@section('script')
    
@endsection