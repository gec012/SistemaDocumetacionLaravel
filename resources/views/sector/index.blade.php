@extends('home')
@section('content')
<div class="card  text-center" style="font-size:12px">
    <div class="card-header"style="background-color:#212121">
       
                <h1 class="card-title"> Sectores  </h1>
         
            <hr>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

           
          
        
    </div>    
    <div class="card-body" style="background-color:#ccff90">
            <div class=" col">
                    <a class="btn float-right m-2 btn-lg btn-dark rounded-circle" data-toggle="tooltip" title="Agregar Sector"style="background-color:#b2ff59;" href ="{{ route('sector.create') }}"><i class="fas fa-plus-circle" style="color:black"></i> </a>
                </div>
        
           
                <table class="table  table-sm  table-striped table-hover">
                       <thead>
                            <tr  style="background-color:#212121;">
                                    <th >Nombre</th>
                                    <th > Descripcion</th>
                                    <th >Estado</th>
                                    <th  width="280px">Acciones</th>
                                </tr>
                       </thead>
                       <tbody class="text-dark"  style="background-color:#eeeeee ">
                           
                            @foreach ($sectores as $sector)                         
                           <tr>                              
                                <td >{{ $sector->nombre}}</td>
                                        
                                <td >{{ $sector->descripcion}}</td>
                                @if  ($sector->estado == true)          
                                    <td style=" background-color:#388e3c;">Activo</td>
                                    <td  >
                                    <a class="btn btn-dark btn-sm" data-toggle="tooltip" style="background-color:#b2ff59;border-radius: 50px;" href="{{ route('sector.edit',$sector->id) }}" title="Editar"><i class="fas fa-sm fa-edit" style="color:black"></i></a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['sector.destroy',$sector->id],'style'=>'display:inline']) !!}
                                    {{ Form::button('<i class="fa fa-sm fa-thumbs-down" style="color:black"></i>', ['class' => 'btn btn-dark btn-sm','data-toggle'=>"tooltip",'style'=>'border-radius: 50px;background-color:#b2ff59;','title'=>'Desabilitar' ,'type' => 'submit']) }}
                                    {!! Form::close() !!}

                                </td>
                                @else 
                                <td style=" background-color:#c62828;">Inactivo</td>
                                <td  >
                                    <a class="btn btn-dark btn-sm" data-toggle="tooltip" style="background-color:#b2ff59;border-radius: 50px;" href="{{ route('sector.edit',$sector->id) }}" title="Editar"><i class="fas fa-sm fa-edit" style="color:black"></i></a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['sector.destroy',$sector->id],'style'=>'display:inline']) !!}
                                    
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
    {{$sectores->render()}}

    <script type="text/javascript">
        function actualizar(){location.reload(true);}
      //Función para actualizar cada 40 segundos(40000 milisegundos)
        setInterval("actualizar()",60000);
      </script>
@endsection

  