@extends('home')
@section('content')


@if ($message = Session::get('success'))
<div class="alert alert-danger">
    <p>{{ $message }}</p>
</div>
@endif

<div class="card text-center">
    <div class="card-header"  style="background-color:#212121">
        <h2 class="card-title" style="color:#ccd4c2" >Nuevo Usuarios</h2>   
    </div>

    <div class="card-body"  style="background-color:#ccff90";>
        <div class="row"> 
            <a class="btn btn-dark float-right" style=" border-radius: 20px;" href="{{ route('usuario.index') }}">Volver</a>
        </div>

        <form action="{{url('usuario')}}" method="POST">
            @csrf
            <div class="row">
                    <div class="form-group col-md-6 col-lg-6">
                            <strong for="name">Nombre</strong>
                            <input type="text" name="name" required class="form-control" style="border-radius:20px" >
                    </div>
                    <div class="form-group col-md-6 col-lg-6">
                             <strong for="email">Email</strong>
                             <input type="email" name="email" required class="form-control" style="border-radius:20px" >
                    </div>
            </div>

            <div class="row">
                
                    <div class="form-group col-md-6 col-lg-6">
                            <strong for="password">Password</strong>
                            <input type="password" name="password"  class="form-control"  style="border-radius:20px">
                        </div>

                    <div class="form-group col-md-6 col-lg-6">
                                <strong for="rol">Rol</strong>
                                <select name="rol" id="" class="form-control" style="border-radius:20px">
                                    @foreach ($roles as $key => $value)
                                       
                                            <option value="{{$value}}">{{$value}}</option> 
                                        
                                    @endforeach
                                </select>
                            </div> 
            </div>

            
                         <div class="form-group">
                          <strong for="sector">Sector</strong>
                          <select name="sector" id="sector" class="form-control" style="border-radius:20px">
                              @foreach ($sectores as $sector )
                              <option value="{{ $sector->id }}">{{ $sector->nombre }}</option>
                                  
                              @endforeach
                          
                         </select>    
                         </div>       
                        <div class=" mt-4">
                                <input type="submit" value="Guardar" class="btn btn-success" style="border-radius:20px">
                        </div>
        </form>
                </div>

</div>       
               
@endsection