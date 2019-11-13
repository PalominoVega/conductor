<html>
    <head>
        <style>
            *{
                font-family: Calibri,Arial,sans-serif;
            }

            body{
                background-color: #fafafa;
            }
            .container-vespro{
                /* border: 1px solid #eee; */
                /* padding: 15px 30px; */
                width: 600px;
                margin-left: auto;
                margin-right: auto;
                background-color: #ffffff;
            }
            .logo{
                width: 300px;
            }
            .car-border{
                border: 1px solid #403d391a;
                padding: 10px 10px;
            }
            .title{
                color: #d8232a;
            }
            .card-logo{
                background-color: #f6f6f6;
                color: #fff;
                padding: 20px 20px;
                text-align: center;
                border: 1px solid #403d391a;
            }
            .card{
                color: black;
                margin-bottom: 20px;
            }
            .table{
                 border-spacing: 0;
                border-collapse: collapse;
                width: 75%;
                text-align: left;
                margin: auto;
                margin-bottom: 20px;
            }
            .table td, .table th{
                padding: 5px 10px;
                border: 1px solid #403D39;
            }
            .card-link-web{
                background-color: yellowgreen;
                color: black;
                padding: 10px 20px;
                text-align: center;
            }
            .text-right{
                text-align: right;
            }
            
            .block{
                display: block;
            }
            .center{
                text-align: center;
            }
            a {
                text-decoration: none;
                background-color: transparent;
                -webkit-text-decoration-skip: objects;
            }
            .card-footer{
                background-color: #403D39;
                color: #fff;
                padding: 10px 20px;
            }
            .contraseña{
                box-sizing: border-box;
                border-radius: 3px;
                color: #fff !important;
                display: inline-block;
                text-decoration: none;
                background-color: #3097d1;
                border-top: 10px solid #3097d1;
                border-right: 18px solid #3097d1;
                border-bottom: 10px solid #3097d1;
                border-left: 18px solid #3097d1;
            }
            .link{
                font-size: 12px;
            }
            hr{
                border: 1px solid #edeff2;
            }
            .info{
                font-size: 14px;
            }

        </style>
    </head>
    <body>
        <div class="container-vespro">
            <div class="card-logo">
                <img class="logo" src="{{ asset('img/vespro.png') }}" alt="">
            </div>
            <div class="car-border">

                <div class="title">
                    <h3>Estimado(a) {{ strtoupper($usuario->nombre.' '.$usuario->apellido) }} de {{ strtoupper($usuario->empresa->nombre) }}</h3>
                </div>
                <div class="card">
                    <p>
                        Está recibiendo este correo electrónico porque recibimos una solicitud de restablecimiento de contraseña para su cuenta del sistema GESTION DE EMPRESAS
                    </p>
                    <div class="center">
                        <a class="contraseña" href="{{env('APP_URL').'password/nueva/'.$usuario->api_token}}">Reestrablecer contraseña</a>
                    </div>
                    <p>
                        Si no solicitó un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.
                    </p>
                    <span class="block">¡Saludos!!!</span>
                </div>
                <hr>
                <div class="card">
                    <span class="link">
                        Si tienes problemas abriendo el link en  "Reestrablecer contraseña", copia y pega la URL a continuación en su navegador web: <a href="{{env('APP_URL').'passwordNew/'.$usuario->api_token}}"> {{env('APP_URL').'passwordNew/'.$usuario->api_token}}</a>
                    </span>
                </div>
                <hr>
                <div class="card ">
                    <h5><b> ASISTENCIA - CANALES DE ATENCIÓN</b></h5>
                    <div class="center info" >
                        <span class="block"><b>Teléfono: </b>(+51)997630413</span>
                        <span class="block">Lun a vie de 9:00AM - 6:00PM</span>
                        <span class="block"><b>Correo:</b> ventas@corporacionvespro.com</span>
                        <b>Siguemos en facebook</b>
                        <a class="block" href="https://www.facebook.com/www.vespro.com.pe/">facebook.com/www.vespro.com.pe</a>
                    </div>
                </div>
                <div class="card-footer text-right">
                    Gestione tu flota con Nosotros,
                    <b>Corporacion Vespro.</b>   
                </div>
            </div>
        </div>
    </body>    
</html>