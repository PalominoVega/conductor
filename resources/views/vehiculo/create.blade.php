@extends('layouts.admin')
@section('content')
    {{-- <div class="registrar text-center">
        <h4 class="">REGISTRO DE V</h4>
    </div> --}}
    <div class="card registrar my-5">
        <div class="card-header">
            <div class="card-title">Datos del Vehiculo</div>
        </div>

        <div class="card-body ">
            <form action="" method="post" >
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">Placa</label>
                            <input type="text" name="placa" id="placa" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">Marca</label>
                            <input type="text" name="marca" id="marca" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">Modelo </label>
                            <input type="text" name="modelo" id="modelo" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">color</label>
                            <input type="text" name="color" id="color" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">año</label>
                            <input type="text" name="año" id="año" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">soat</label>
                            <input type="text" name="direccion" id="direccion" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">FECHA DE caducidad</label>
                            <input type="date" name="fecha_soat" id="fecha_soat" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">revisión técnica </label>
                            <input type="text" name="empresa_revision_tecnica" id="empresa_revision_tecnica" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group">
                            <label for="">FECHA DE CADUCIDAD</label>
                            <input type="date" name="fecha_revision_tecnica" id="fecha_revision_tecnica" class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    
                </div>    
            </form>
        </div>
        <div class="card-footer text-center" >
            <button class="btn btn-primary">Guardar</button>
        </div>
    </div>

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

    </script>
@endsection