<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Flota  </title>
  
  {{-- Booststrap  --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  {{-- css app --}}
  <link href="{{asset('css/login.css')}}" rel="stylesheet">

  <link rel='shortcut icon' type='image/x-icon' href='{{asset('img/icon.png')}}'/> 
  {{-- agregar esto para enviar el token en ajax --}}
  <meta name="csrf_token" content="{{csrf_token()}}"/>

</head>

<body >
    <div class="cuerpo">
        <div class="row">
            <div class="col-6 col-sm-6">
                <p>TECNOLOGIA VESPRO</p>
            </div>
            <div class="col-6 col-sm-6 text-right">
                <P class="text-left">GESTIÓN DE FLOTA</P>
            </div>
        </div>
        <div class="container ">
            @yield('content')     
        </div>
    </div>
    <footer class="sticky-footer">
      <div class="text-center">
        <small>Copyright © 2019 - CORPORACIÓN VESPRO</small>
      </div>
    </footer>



    
  {{-- booststrap y jquery --}}
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  {{-- scripts app --}}
  {{-- alertas --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @yield('script') 
  @include('sweet::alert')

  <script>

    
    
    /**
    * Validaciones
    */
    function limpiarErrores(){$('.has-error strong').remove();$('div.form-group.has-error').removeClass('has-error');$('.input-error').removeClass('input-error')}
    function mostrarErrores(form, error){
        var errores=error.responseJSON.errors;
        limpiarErrores();
        var arrKeys=Object.keys(errores);
        for (let index = 0; index < arrKeys.length; index++) {
            var indexName=arrKeys[index];
            if(index==0){
                $('#'+form+' [name='+indexName+']').addClass('input-error').focus().parents('div.form-group').addClass('has-error')
                .append($('<strong>').html(errores[indexName]).addClass('error'));
            }else{
                $('#'+form+' [name='+indexName+']').addClass('input-error').parents('div.form-group').addClass('has-error')
                    .append($('<strong>').html(errores[indexName]).addClass('error'));
            }
        }
    }
    function limpiarCampos(form){
        $('#'+form+' input[name!=_token][name!=_method][type!=radio]').val("");
        $('#'+form+' select').val("")
    }
    
  </script>
  
</body>
</html>
