@extends('home')
@section('content')

<div class="card text-center">
    <div class="card-header"  style="background-color:#212121">
        <h2 class="card-title" style="color:#ccd4c2" >Editar Usuarios</h2>   
    </div>

    <div class="card-body"  style="background-color:#ccff90";>
        <div class="row"> 
            <a class="btn btn-dark float-right" style=" border-radius: 20px;" href="{{ route('usuario.index') }}">Volver</a>
        </div>
        
        <form action="{{ route('usuario.update',$usuario->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                    <div class="form-group col-md-6 col-lg-6">
                            <strong for="name">Nombre</strong>
                            <input type="text" name="name" required class="form-control" style="border-radius:20px" value="{{$usuario->name}}">
                    </div>
                    <div class="form-group col-md-6 col-lg-6">
                             <strong for="email">Email</strong>
                             <input type="email" name="email" required class="form-control" style="border-radius:20px" value="{{$usuario->email}}">
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
                                        @if ($usuario->hasRole($value))                    
                                            <option value="{{ $value}}" selected>{{ $value}}</option>
                                        @else 
                                            <option value="{{$value}}">{{$value}}</option> 
                                        @endif
                                    @endforeach
                                </select>
                            </div> 
            </div>

            
            <table class="table table-sm table-striped">
                    <thead class="thead-dark" style="background-color:#212121;">
                            <th>Sectores</th>
                            <th>Habilitar o Deshabilitar</th>
                        
                    </thead>

                    <tbody style="background-color:#eeeeee ;" class="text-dark">
                            @php
                                $band1 = true
                            @endphp 
                            @foreach ($sectores as $sector )
                                @if($band1)
                                    <tr style="background:lightgray">
                                        @php
                                            $band1 = false
                                        @endphp 
                                @else     
                                    <tr style="background:whitesmoke">
                                        @php
                                            $band1 = true
                                        @endphp 
                                @endif 

                                    <td  >{{ $sector->nombre }}</td>
                                    @php
                                     $band=false
                                    @endphp                                                                 
                                    @foreach ($selectborrar as $sb)
                                        @if($sector->id == $sb->id)
                                             
                                            @php
                                            $band= true
                                            @endphp
                                        @endif
                                    @endforeach                                    
                                    @if($band)
                                        
                                        <td  >{!! Form::checkbox( $sector->id, 'value', true)!!} </td>
                                    @else
                                    
                                        <td  > {!! Form::checkbox( $sector->id, 'value', false)!!}</td>
                                    @endif
                                                                             
                                </tr>
                            @endforeach
                    </tbody>
            </table>

                                           
            <div class=" mt-4">
                <input type="submit" value="Guardar" class="btn btn-success" style="border-radius:20px">
            </div>
        </form>
    </div>
</div>         
      
@endsection