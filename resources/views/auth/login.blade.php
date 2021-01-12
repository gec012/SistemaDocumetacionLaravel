
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>{{ config('app.name', 'OSUNSa Documentacion') }}</title>
    
        <!-- Scripts -->
       
    
    
    
        <!-- Fonts -->
        
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}" >
         
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('css/barra1.css') }}">
    
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="css/sb-admin-2.css" rel="stylesheet">
    
    </head>
    <body style=" background-color:#b2ff59; " >
            <div class="container">

            <!-- Outer Row -->
   <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
        <br>
        <div class="card o-hidden border-0 shadow-lg my-5">

                <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                        <div class="p-5"> 
                                <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Iniciar Sesión!</h1>
                                </div>
                    <form class="user" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                           

                            
                                <input id="email" type="email"  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-user" name="email" value="{{ old('email') }}" required  placeholder="Ingrese Correo Electronico...">
                             

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group ">
                            

                           
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-user" name="password" required  placeholder="Ingrese Contraseña...">
                                
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                          
                        </div>

                        <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                               
                                        <input type="checkbox" class="custom-control-input" name="remember" id="customCheck" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="custom-control-label text-dark" for="customCheck">Recordame</label>
                                  
                               
                            </div>
                        </div>

                        
                            
                                <button type="submit" class="btn btn-primary btn-user btn-dark btn-block" style="background-color:#212121;" >
                                       
                                        <strong> <i class="fas fa-sign-in-alt fa-1x"></i>  Iniciar</strong>
                                </button>
                                <hr>


                                
                              
                            
                       
                    </form>
                                        </div>
                                </div>

                    
                </div>
            </div>
        </div>
        </div>
    </div>
</div>


<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip(); 
        });
</script>
<script src="{{ asset('js/barra1.js')}}"></script>
</body>