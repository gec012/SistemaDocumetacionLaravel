<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OSUNSa Incidentes') }}</title>

    <!-- Scripts -->
   



    <!-- Fonts -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"">
     <link rel="stylesheet" href="css/estilo.css">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/barra1.css') }}">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/barra1.js')}}"></script>

    






</head>
<body style="background-color:#b2ff59">
    <div id="app">
       
            <div>
                    <div class="page-wrapper chiller-theme toggled" >
                            <p id="show-sidebar" class="btn btn-sm btn-dark " disabled>
                            <i class="fas fa-angle-double-right fa-2x"></i>
                            </p>
                            @auth
                            <nav id="sidebar" class="sidebar-wrapper">
                            <div class="sidebar-content">
                                <div class="sidebar-brand">
                                <a href="#">DOCUMENTACIÓN OSUNSa</a>
                                <div id="close-sidebar">
                                    <i class="fas fa-angle-double-left fa-1x"></i>
                                </div>
                                </div>
                                <div class="sidebar-header">
                                <div class="user-pic">
                                    <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg"
                                    alt="User picture">
                                </div>
                                <div class="user-info">
                                    <span class="user-name">
                                    <h5><strong>{{ Auth::user()->name }}
                                        <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"  data-toggle="tooltip"   data-placement="bottom"  title="Cerrar Sesión">
                                                <i class="fa fa-power-off"></i>
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                    
                                </strong></h5>
                                    </span>
                                    
                                    <span class="user-role">{{ Auth::user()->roles->implode('name',"\n") }}</span>
                                    <span class="user-status">
                                        
                                    <span>     <a class="spinner-grow text-success" role="status">
                                            <span class="sr-only">Loading...</span>
                                    </a>    Online</span>
                                    </span>
                                    <ul>
                                        
                                    </ul>
                                </div>
                                
                                <!-- sidebar-header  -->
                                <hr>
                                <!-- sidebar-search  -->
                                <div class="sidebar-menu">
                                <ul>
                                
                                                                
                                            @if( Auth::check()  )
                                            @include('shared.navbar')
                                        @endif
                                
                                </ul>
                                </div>
                                <!-- sidebar-menu  -->
                            </div>
                            <!-- sidebar-content  -->
                            
                            </nav>
                            @endauth
                            <!-- sidebar-wrapper  -->
                            <main class="page-content" style="background-color:#b2ff59">
                            
                                    <div class="container" style="background-color:#b2ff59" >
    
                                                 @yield('content')
                                            
                                        </div>
                            </main>
                            <!-- page-content -->
                        </div>
                        <!-- page-wrapper -->
                
            </div>
          

    </div>
 
    

    
   
    
    
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
   
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.4/js/buttons.print.min.js"></script>
    <script src="{{ asset('js/barra1.js')}}"></script>



</body>
</html>
