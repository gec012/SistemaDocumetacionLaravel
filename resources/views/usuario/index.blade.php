@extends('home')
@section('content')
  


<div class="card text-center"style="font-size:12px" >
    <div class="card-header" style="background-color:#212121">
        
        
                    <h1 class="card-title">    Usuarios  </h1>
    </div>
             
        
      

          @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
          @endif
     <div class="card-body" style="background-color:#ccff90">
       <div class="row">
          <div   class="col">
              <a href="{{route('usuario.create')}}" class="btn float-right btn-lg btn-dark mb-2 rounded-circle " style="background-color:#b2ff59 "><i class="fas fa-plus-circle "style="color:black"></i></a>
      </div>
       </div>
     
   
    
      <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
            <thead style="background-color:#212121;">
              
                <th>Nombre</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Rol</th>
                <th>Acciones</th>
            
              
            </thead> 
            <tbody style="background-color:#eeeeee ;" class="text-dark">
                
                @foreach ($users as $usuario)
                
               
               <tr >
                 
                    <td >{{$usuario->name}}</td>
                    <td >{{$usuario->email}}</td>
                    @if($usuario->estado)
                        <td style="background-color:#388e3c;">Activo</td>
                    @else
                      <td style=" background-color:#c62828;">Inactivo</td>
                    @endif    
                    <td >{{$usuario->roles->implode('name',',')}}</td>
  
             
                        @if  ($usuario->estado)          
                       
                        <td  >
                        <a class="btn btn-dark btn-sm" data-toggle="tooltip" style="background-color:#b2ff59;border-radius: 50px;" href="{{ route('usuario.edit',$usuario->id) }}" title="Editar"><i class="fas fa-sm fa-edit" style="color:black"></i></a>
                        {!! Form::open(['method' => 'DELETE','route' => ['usuario.destroy',$usuario->id],'style'=>'display:inline']) !!}
                        {{ Form::button('<i class="fa fa-sm fa-thumbs-down" style="color:black"></i>', ['class' => 'btn btn-dark btn-sm','data-toggle'=>"tooltip",'style'=>'border-radius: 50px;background-color:#b2ff59;','title'=>'Desabilitar' ,'type' => 'submit']) }}
                        {!! Form::close() !!}

                    </td>
                    @else 
                    
                    <td  >
                        <a class="btn btn-dark btn-sm" data-toggle="tooltip" style="background-color:#b2ff59;border-radius: 50px;" href="{{ route('usuario.edit',$usuario->id) }}" title="Editar"><i class="fas fa-sm fa-edit" style="color:black"></i></a>
                        {!! Form::open(['method' => 'DELETE','route' => ['usuario.destroy',$usuario->id],'style'=>'display:inline']) !!}
                        
                        {{ Form::button('<i class="fa fa-sm fa-thumbs-up" style="color:black"></i>', ['class' => 'btn btn-dark btn-sm','data-toggle'=>"tooltip",'style'=>'border-radius: 50px;background-color:#b2ff59;','title'=>'Habilitar' ,'type' => 'submit']) }}

                        {!! Form::close() !!}

                    </td>
                    @endif     
  
  
                </tr>
                    
              
  
                @endforeach
              
              
              
  
            
            </tbody>
          </table>
       
      </div>
       
    
      
     </div>
    
</div> 
     
{{$users->render()}}      
    
@endsection