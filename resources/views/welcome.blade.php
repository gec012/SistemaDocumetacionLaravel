<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}" >
        <link rel="stylesheet" href="{{ asset('css/all.css') }}">

        <title>OSUNSa Incidentes</title>

        <!-- Fonts -->
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="css/estilo.css">

        <style>
            html, body {
                background-color: #fff;
             
                font-family:Alcubierre;
                font-weight: 200;
                height: 200vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }
            .titulo {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
                text-decoration: underline;
                color: #333333;
              }

            .links > a {
                color:dark;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                font-family:Alcubierre;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .botones {
                width: 100%;
                text-align: center;
              }
              
              #separar {
                padding: 3%;
                display: inline-block;
              }
              
            .boton2 {
                color: #fff !important;
                font-size: 20px;
                font-weight: 500;
                padding: 0.5em 1.2em;
                background: #212121;
                border: 2px solid;
                border-color: #01DF3A;
                position: relative;
                border-radius:50%
              }
              .boton2:before {
                content:"";
                position: absolute;
                top: 0px;
                left: 0px;
                width: 100%;
                height: 0px;
                background: rgba(255, 255, 255, 0.1);
                
                transition: all 1s ease;
              } 
              .boton2:hover:before {
              
               
                height: 100%;
                border-radius:50%
               
              }
            

    
        </style>
    </head>
    <body style=" background-size:cover; "   >
        <div class="flex-center position-ref full-height">
            

            <div class="content">
                <div class="card" style="background-color: rgba(245, 245, 245, 0.1);">
                    <div class="card-body">
                    <h1   style="font-size:80px;font-size: 8vw;" class="text-dark">Documentación</h1>
                    <h6 class="text-dark">by <strong>OSUNSa</strong></h6>
                   
                    </div>  
                     
                </div>
                @if (Route::has('login'))
                <div class=" links">
                    @auth
                       <a class="btn btn-dark m-3 p-3 boton2" href="{{ url('/home') }}" data-toggle="tooltip" title="Home"> <i class="fas fa-igloo fa-3x" ></i> </a>
                 
                    @else
                        <a  class="btn btn-dark m-3 p-3 boton2"  href="{{ route('login') }}" class="text-dark">Iniciar sesion</a>
                              
                       
          
                    @endauth
                </div>
            @endif
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <script>
                $(document).ready(function(){
                  $('[data-toggle="tooltip"]').tooltip(); 
                });
        </script>
    </body>
</html>
