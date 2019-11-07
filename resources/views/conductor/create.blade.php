@extends('layouts.admin')
@section('content')
 
<form action="{{ route('conductor.store') }}" method="post" enctype="multipart/form-data"   >
    @csrf
    <div class="registrar text-center">
        <h4 class="">REGISTRO DE CONDUCTOR</h4>
        <div class="card-avatar mb-2" hidden>
            <img id=imgSalida src="" alt="" >
        </div>
        {{-- <div class="upload-btn-wrapper mt-2 ">
            <button class="btn" id="btn-foto">Subir Foto</button>                                
            <input id="txt-foto" name="file" type="file">
        </div> --}}
        <span class="create-foto ">
            <span class="button btn btn-primary"><i class="fa fa-file-image-o"></i> Subir</span>
            <input id="txt-foto" name="file" type="file">
        </span>
    </div>
    <div class="card registrar my-5">
        <div class="card-header">
            <div class="card-title">Datos del Conductor</div>
        </div>

        <div class="card-body ">
            <div class="row">
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
                        <label for="">CELULAR</label>
                        <input type="text" name="celular" id="celular" class="form-control form-control-sm" value="{{old('celular')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">TIPO DE SANGRE</label>
                        {{-- <input type="text" name="tipo_sangre" id="tipo_sangre" class="form-control form-control-sm" value="{{old('')}}" > --}}
                        {{-- <label>Tipo de Sangre</label> --}}
                        <select name="tipo_sangre" class="form-control">
                            <option value=""></option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">DIRECCIÓN</label>
                        <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" value="{{old('direccion')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">FECHA DE NACIMIENTO</label>
                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-sm" value="{{old('fecha_nacimiento')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">LICENCIA DE CONDUCIR </label>
                        <input type="text" name="categoria_licencia" id="categoria_licencia" class="form-control form-control-sm" value="{{old('categoria_licencia')}}" >
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                    <div class="form-group">
                        <label for="">FECHA DE CADUCIDAD</label>
                        <input type="date" name="fecha_licencia" id="fecha_licencia" class="form-control form-control-sm" value="{{old('fecha_licencia')}}" >
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
            $('.card-avatar').removeAttr('hidden');
            var result=e.target.result;
            $('#imgSalida').attr("src",result);
            }
          }
        );
        
        $(document).ready(function(){
            if(@json($errors->any())){

                // var p=@json($errors->default);
                
                 var error = <?php echo str_replace(["[","]"], "", json_encode($errors->default)); ?>;
                 
                var errores=error;
                var arrKeys=Object.keys(errores);
                
                for (let index = 0; index < arrKeys.length; index++) {
                    var indexName=arrKeys[index];
                    if(index==0){
                        $(' [name='+indexName+']').addClass('input-error').focus().parents('div.form-group').addClass('has-error')
                        .append($('<span>').html(errores[indexName]).addClass('error'));
                    }else{
                        $(' [name='+indexName+']').addClass('input-error').parents('div.form-group').addClass('has-error')
                            .append($('<span>').html(errores[indexName]).addClass('error'));
                    }
                }
            }
        
        });

    </script>
@endsection