<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Flota  </title>
  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
  {{-- Booststrap  --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  {{-- datatble --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  {{-- datatable responsible --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
  {{-- css app --}}
  <link href="{{asset('css/style.css')}}" rel="stylesheet">
  <link href="{{asset('icon/style.css')}}" rel="stylesheet">

  <link rel='shortcut icon' type='image/x-icon' href='{{asset('img/icon.png')}}'/> 
  {{-- agregar esto para enviar el token en ajax --}}
  <meta name="csrf_token" content="{{csrf_token()}}"/>

</head>

<body >
    <div class="dashboard">
        <div class="sidebar">
            <div class="sidebar-header">
                <a class="sidebar-close" onclick=cerrar()>
                    <i class="icon-borrar text-primary" aria-hidden="true"></i>
                </a>
                <h3 class="text-center my-3">SISTEMAS</h3>
            </div>
            <div class="sidebar-body">
                <div class="navbar-content-oculta">
                  
                    <ul>
                      <li class="dropdown">
                        <a class="dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class=" icon-user"></i>
                          {{auth()->user()->nombre}} {{auth()->user()->apellido}}
                        </a>
                        <ul class="dropdown-menu">
                          <li class="dropdown-item"><a onclick="salir()">Cerrar Sesión</a></li>
                          <li class="dropdown-item"><a href="{{ route('cambiar_contrasenia') }}" >Cambiar contraseña</a></li>
                        </ul>
                      </li>
                      <li class="">
                        <a href="{{ route('conductor.cumpleanios') }}" class="cumpleanio">
                          <i class="icon-cumplenio2"></i> Cumpleaños
                        </a>
                      </li>
                    </ul>
                    <hr>
                </div>

                <ul>
                    <li >
                        <a href="{{ route('conductor.index') }}"><i class="icon-user" aria-hidden="true"></i>Lista de Conductores</a>
                    </li> 
                    <li>
                        <a href="{{ route('vehiculo.index') }}"><i class="icon-vehiculo" aria-hidden="true"></i>Lista de Vehículos</a>
                    </li> 
                    <li>
                        <a href="{{ route('asignador.index') }}"><i class="icon-car" aria-hidden="true"></i>Asignación</a>
                    </li> 
                    <li>
                        <a href="{{ route('alert.doc') }}"><i class="icon-notificaciones" aria-hidden="true"></i>Notificaciones</a>
                    </li> 

                    
                      
                    <li>
                        <a href="{{ route('cambioaceite') }}"><i class="icon-gas" aria-hidden="true"></i>Cambio de Aceite</a>
                    </li> 
                    
                    
                    {{-- <li>
                        <a href=""><i class="fa fa-calendar-o" aria-hidden="true"></i>Agenda</a>
                    </li>  --}}
                    

                  </ul>
                
            </div>
        </div>
        <div class="show-sidebar" onclick=cerrar()></div>
        <div class="content">
            <div class="navbar">
                <div class="navbar-content">
                    {{-- <i class="fa fa-bell" aria-hidden="true"></i> DIEGO FRANCISCO MENDOZA FRIAS <i class="fa fa-user" aria-hidden="true"></i> --}}
                    <ul>
                        <li class="dropdown">
                            <a href="{{ route('conductor.cumpleanios') }}" class="cumpleanio">
                                <i class="icon-cumplenio2"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a  href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="user">
                                {{auth()->user()->nombre}} {{auth()->user()->apellido}}
                                <i class=" icon-user ml-2"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" onclick="salir()">Cerrar Sesión</a>
                                <a href="{{ route('cambiar_contrasenia') }}" class="dropdown-item" >Cambiar contraseña</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <button class="navbar-open" onclick=abrir()>
                    <i class="icon-bars" aria-hidden="true"></i>
                </button>
            </div>
             {{-- <div class="img-panel-superior">
                <img src="{{asset('img/lineas-superior.png')}}" alt="">
             </div> --}}
             @yield('content') 
             {{-- <div class="img-panel-inferior">
                <img src="{{asset('img/lineas-inferior.png')}}" alt="">
             </div> --}}
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

    {{-- datable --}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    {{-- datatable resposible --}}
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

  {{-- scripts app --}}
  {{-- alertas --}}
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @yield('script') 
  
  @include('sweet::alert')
  
  <script>
   //DATOS GENERALES
    var nombre_empresa="{{ Auth::user()->empresa->nombre  }}";
    var csrf_token="{{csrf_token()}}";

    var URLactual = window.location.href.replace("http://","").replace("https://","");

    $(document).ready(function(){
        $(".sidebar .sidebar-body ul li ").each(function(){
          var a=$(this).children('a').attr('href').replace("http://","").replace("https://","");
          
          if(URLactual.indexOf(a)==0){
            $(this).addClass('active');
            // var uls=$(this).parents('ul.sidenav-second-level');
            // if(uls.length==1){
            //   uls.addClass('show');
            // }
          }
        });
    });

  </script>
    <!-- firebase -->
    <script src="https://www.gstatic.com/firebasejs/6.4.2/firebase.js"></script>
  <script>

    var firebaseConfig = {
        apiKey: "AIzaSyC5EcTYyELdaKrBATYDCcoVXz7E1w01AH4",
        authDomain: "tecnologia-vespro.firebaseapp.com",
        databaseURL: "https://tecnologia-vespro.firebaseio.com",
        projectId: "tecnologia-vespro",
        storageBucket: "",
        messagingSenderId: "185741590134",
        appId: "1:185741590134:web:c08241ac25b6a566"
      };
      firebase.initializeApp(firebaseConfig);
      var nombre_topic='flota-'+"{{ Auth::user()->empresa_id}}";
  
      navigator.serviceWorker.register("{{asset('sw.js')}}").then((registration) => {
        var messaging;
        messaging=firebase.messaging();
        messaging.useServiceWorker(registration);
        messaging.requestPermission().then(function () {
            return messaging.getToken();
        }).then(function (token) {
            if(window.localStorage.getItem('push')===null){
                window.localStorage.setItem('push',token);
                $.ajax({        
                    type : 'POST',
                    url : "https://iid.googleapis.com/iid/v1:batchAdd",
                    headers : {Authorization : 'key=AIzaSyCRRFu54sUpJaRpnWiR13Z5Zce_AzCPPhg'},
                    contentType : 'application/json',
                    dataType: 'json',
                    data: JSON.stringify({"to": "/topics/"+nombre_topic, "registration_tokens": [token]}),
                    success : function(response) {
                        console.log("Push Registrado en TOPIC");
                    }
                });
            }
        });
      });




    function cerrar(){
      $('.sidebar.open').removeClass('open');
      $('.show-sidebar.open').removeClass('open');
    };
    function abrir(){
      
      $('.sidebar').addClass('open');
      $('.show-sidebar').addClass('open');
    }

    function salir() {

      if(window.localStorage.getItem('push')!==null){
            var token=window.localStorage.getItem('push');
            window.localStorage.removeItem('push');
            $.ajax({        
                type : 'POST',
                url : "https://iid.googleapis.com/iid/v1:batchRemove",
                headers : {Authorization : 'key=AIzaSyCRRFu54sUpJaRpnWiR13Z5Zce_AzCPPhg'},
                contentType : 'application/json',
                dataType: 'json',
                data: JSON.stringify({"to": "/topics/"+nombre_topic, "registration_tokens": [token]}),
                success : function(response) {
                  window.localStorage.removeItem('push');
                  navigator.serviceWorker.getRegistrations().then(function(registrations) {
                  for(let registration of registrations) {
                  registration.unregister()
                  } })
                  Notification.permissions = 'default';
                  
                  $.ajax({
                      url: "{{route('cerrar')}}",
                      type: 'GET',
                      data: {
                      },
                      success: function(data){
                          var url =  "{{route('login')}}"; 
                          $(location).attr('href',url);
                      }
                  });
                }
            });
        }else{
          $.ajax({
              url: "{{route('cerrar')}}",
              type: 'GET',
              data: {
              },
              success: function(data){
                  var url =  "{{route('login')}}"; 
                  $(location).attr('href',url);
              }
          });
        }



      
    }

    setTimeout(() => {
      
      $.get("{{route('check')}}", {_csrf:csrf_token},function( data ) {
        if(data.status==false){
          window.location.href="{{route('login')}}";
        }
      });  
    }, 1000);

    $(document).ready(function(){
      
      @if (count($errors))
        error = <?php echo str_replace(["[","]"], "", json_encode($errors->default)); ?>;
      
        var errores=error;
        var arrKeys=Object.keys(errores);
        
        for (let index = 0; index < arrKeys.length; index++) {
            var indexName=arrKeys[index];
            if(index==0){
                $('form [name='+indexName+']').addClass('input-error').focus().parents('div.form-group').addClass('has-error')
                .append($('<span>').html(errores[indexName]).addClass('error'));
            }else{
                $(' [name='+indexName+']').addClass('input-error').parents('div.form-group').addClass('has-error')
                    .append($('<span>').html(errores[indexName]).addClass('error'));
            }
        }

        $("form").find(':input').each(function(){
            $(this).removeAttr('readonly');
        });
            
      @endif


      // if(@json($errors->any())){
      //   error = <?php echo str_replace(["[","]"], "", json_encode($errors->default)); ?>;
          
      //   var errores=error;
      //   var arrKeys=Object.keys(errores);
        
      //   for (let index = 0; index < arrKeys.length; index++) {
      //       var indexName=arrKeys[index];
      //       if(index==0){
      //           $('form [name='+indexName+']').addClass('input-error').focus().parents('div.form-group').addClass('has-error')
      //           .append($('<span>').html(errores[indexName]).addClass('error'));
      //       }else{
      //           $(' [name='+indexName+']').addClass('input-error').parents('div.form-group').addClass('has-error')
      //               .append($('<span>').html(errores[indexName]).addClass('error'));
      //       }
      //   }

      //   $("form").find(':input').each(function(){
      //       $(this).removeAttr('readonly');
      //   });
      // }
    });

  </script>
</body>
</html>
