<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Flota  </title>

  <link rel="stylesheet" href="css/font-montserrat/Montserrat-Black.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-BlackItalic.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-Bold.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-BoldItalic.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-ExtraBold.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-ExtraBoldItalic.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-ExtraLight.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-ExtraLightItalic.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-Italic.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-Light.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-LightItalic.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-Medium.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-MediumItalic.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-Regular.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-SemiBold.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-SemiBoldItalic.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-Thin.ttf" />
  <link rel="stylesheet" href="css/font-montserrat/Montserrat-ThinItalic.ttf" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  {{-- Booststrap  --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  {{-- css app --}}
  <link href="{{asset('css/style.css')}}" rel="stylesheet">

  <link rel='shortcut icon' type='image/x-icon' href='{{asset('img/icon.png')}}'/> 
  {{-- agregar esto para enviar el token en ajax --}}
  <meta name="csrf_token" content="{{csrf_token()}}"/>

</head>

<body >
    <div class="dashboard">
        <div class="sidebar">
            <div class="sidebar-header">
                <a class="sidebar-close" onclick=cerrar()>
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
                <h3 class="text-center my-3">SISTEMAS</h3>
            </div>
            <div class="sidebar-body">
                <ul>
                    <li class="active">
                        <a href=""><i class="fa fa-user" aria-hidden="true"></i>Lista de Conductores</a>
                    </li> 
                    <li>
                        <a href=""><i class="fa fa-calendar-o" aria-hidden="true"></i>Lista de Vehículos</a>
                    </li> 
                    <li>
                        <a href=""><i class="fa fa-calendar-o" aria-hidden="true"></i>Asignación</a>
                    </li> 
                    <li>
                        <a href=""><i class="fa fa-calendar-o" aria-hidden="true"></i>Notificaciones</a>
                    </li> 
                    <li>
                        <a href=""><i class="fa fa-calendar-o" aria-hidden="true"></i>Agenda</a>
                    </li> 
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
                            <a href="http://example.com" >
                                <i class="fa fa-user"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a  href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                palomino vega 
                                <i class=" fa fa-user ml-1"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" onclick="salir()">Cerrar Sesión</a>
                                <a class="dropdown-item" >Cambiar contraseña</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <button class="navbar-open" onclick=abrir()>
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>
            </div>
             <div class="img-panel-superior">
                <img src="{{asset('img/lineas-superior.png')}}" alt="">
             </div>
             @yield('content') 
             <div class="img-panel-inferior">
                <img src="{{asset('img/lineas-inferior.png')}}" alt="">
             </div>
        </div>
    </div>
    
    {{-- <footer class="sticky-footer">
      <div class="text-center">
        <small>Copyright © 2019 - CORPORACIÓN VESPRO</small>
      </div>
    </footer> --}}
    
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
   
    

    var URLactual = window.location.href.replace("http://","").replace("https://","");
    $(document).ready(function(){
        $(".navbar-sidenav .nav-item").each(function(){
          var a=$(this).children('a.nav-link').attr('href').replace("http://","").replace("https://","");
          if(URLactual==a){
            $(this).addClass('active');
            var uls=$(this).parents('ul.sidenav-second-level');
            if(uls.length==1){
              uls.addClass('show');
            }
          }
        });
    });

  </script>
  <script>
    function cerrar(){
      console.log('hola');
      $('.sidebar.open').removeClass('open');
      $('.show-sidebar.open').removeClass('open');
    };
    function abrir(){
      
      $('.sidebar').addClass('open');
      $('.show-sidebar').addClass('open');

    }

    setTimeout(() => {
      
      $.get("{{route('check')}}", {_csrf:csrf_token},function( data ) {
        if(data.status==false){
          window.location.href="{{route('login')}}";
        }
      });  
    }, 1000);
  </script>
</body>
</html>
