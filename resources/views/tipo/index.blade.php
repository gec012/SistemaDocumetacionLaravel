@extends('home')
@section('content')
<div class="card text-center " style=";font-size:12px">
    <div class="card-header"  style="background-color:#212121">
        
            <div >
                <h1 class="card-title"> Tipos de Documentos  </h1>
            </div>

            <hr>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

           
          
        
    </div>    
    <div class="card-body" style="background-color:#ccff90">
            <div class="float-right mb-2">
                    <a class="btn btn-lg btn-dark rounded-circle" data-toggle="tooltip" title="Agregar Tipo"style="background-color:#b2ff59 ;" href ="{{ route('tipo.create') }}"><i class="fa fa-sm fa-plus-circle" style="color:black"></i> </a>
                </div>
       
            
                <table class="table table-sm table-striped table-hover">
                    <thead class="thead-dark" style="background:darkslategray">
                            <tr>
                                    <th >Nombre</th>
                                    <th > Descripcion</th>
                                    <th >Estado</th>
                                    <th  width="280px">Acciones</th>
                                </tr>
                    </thead>
                    <tbody class="text-dark"  style="background-color:#eeeeee ">
                            @foreach ($tipos as $tipo)
                            <tr >
                                <td >{{ $tipo->nombre}}</td>
                                        
                                <td >{{ $tipo->descripcion}}</td>
                                @if  ($tipo->estado == true)          
                                    <td style="background-color:lawngreen">Activo</td>
                                    <td  >
                                        <a class="btn btn-dark btn-sm" data-toggle="tooltip" style="background-color:#b2ff59;border-radius: 50px;" href="{{ route('tipo.edit',$tipo->id) }}" title="Editar"><i class="fa fa-sm fa-edit" style="color:black"></i></a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['tipo.destroy',$tipo->id],'style'=>'display:inline']) !!}
                                    {{ Form::button('<i class="fa fa-sm fa-thumbs-down" style="color:black"></i>', ['class' => 'btn btn-dark btn-sm','data-toggle'=>"tooltip",'title'=>'Desabilitar' ,'type' => 'submit','style'=>'border-radius: 50px; background-color:#b2ff59;']) }}
                                    {!! Form::close() !!}

                                </td>
                                @else 
                                <td style=" background-color:#ef5350 ">Inactivo</td>
                                <td >
                                    <a class="btn btn-dark btn-sm" data-toggle="tooltip" style="background-color:#b2ff59;border-radius: 50px;" href="{{ route('tipo.edit',$tipo->id) }}" title="Editar"><i class="fa fa-sm fa-edit" style="color:black"></i></a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['tipo.destroy',$tipo->id],'style'=>'display:inline']) !!}
                                    
                                    {{ Form::button('<i class="fa fa-sm fa-thumbs-up" style="color:black"></i>', ['class' => 'btn btn-dark btn-sm','data-toggle'=>"tooltip" ,'title'=>'Habilitar' ,'type' => 'submit','style'=>'border-radius: 50px;background-color:#b2ff59;']) }}

                                    {!! Form::close() !!}

                                </td>
                                @endif        
                               
                            </tr>
                        @endforeach
                    
                    </tbody>    
                       
                </table>
          
        
    </div> 
</div> 
    {{$tipos->render()}}

    <script type="text/javascript">
        function actualizar(){location.reload(true);}
      //Función para actualizar cada 40 segundos(40000 milisegundos)
        setInterval("actualizar()",60000);
      </script>
@endsection

  