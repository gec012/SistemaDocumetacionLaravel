@extends('home')
@section('content')      


    <div class="card text-center"  >
        <div class="card-header" style="background-color:#212121">
                <div >
                        <h1 class="card-title" > Documentos </h1>
                    </div>
        </div>
        <div class="card-body" style="background-color:#ccff90">
                <div class="row" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           
                   
                            @if(Auth::user()->rol <> 3)
                                @include('incidente.search')
                            @endif
                                          
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            @if ($tam <> 0)
                            
                                <div class="alert alert-info">
                                    <strong>Se generaron {{ $tam }} nuevos incidentes</strong>
                                </div>
                                @endif
                            
                                    
                        </div> 
                    </div>
                    <div class="row ">
                       <div class="col">

                <a class=" float-right btn btn-lg m-2 btn-dark rounded-circle" style="background-color:#b2ff59" href ="{{ route('incidente.create') }}" data-toggle="tooltip" title="Nuevo Documento"> <i class="fas fa-plus-circle fa-sm" style="color:black"></i></a>
                       </div>
                    </div>
                    
                       
                    
                
                            <div class="row ">
                                   
                                        <div class="table-responsive ">
                                            <table   class=" table  table-hover table-sm   ">
                                                <thead class="thead-dark" style="background:darkslategray" >
                                                        <tr >
                                                                <th >Nombre</th>
                                                                <th >Estado</th>
                                                                <th >Caracter</th>
                                                                <th >Creado</th>
                                                                
                                                                <th >Usuario </th>
                                                                @if(Auth::user()->rol<>3) 
                                                                <th>Sector del usuario</th>
                                                                @endif
                                                               
                                                                <th  >Acciones</th>
                                                              
                                                            </tr>
                                                </thead>
                                                <tbody class="text-dark" style="background-color:#eeeeee ">
                                                    @php
                                                        $band = true
                                                    @endphp    
                                                    @foreach ($incidentes as $inci)
                                                      
                                                      @if($band)
                                                        <tr style="background:lightgray">
                                                                @php
                                                                $band = false
                                                            @endphp 
                                                       @else     
                                                       <tr style="background:whitesmoke">
                                                            @php
                                                            $band = true
                                                        @endphp 
                                                       @endif
                                                            <td >{{ $inci->nombre}}</td>
                                                            @if  ($inci->estado == 'Finalizado')      
                                                                <td style=" background-color:#388e3c;">{{ $inci->estado}}</td>
                                                            
                                                            @elseif($inci->estado == 'Pendiente')
                                                                    <td>{{ $inci->estado}}</td>
                                                                
                                                                    @else <td >{{ $inci->estado}}</td>
                                                             
                                                             
                                                            @endif
                            
                                                            <td >{{ $inci->caracter}}</td>
                                                            <td > {{ \Carbon\Carbon::parse($inci->created_at)->format('d/m/Y H:m:s')}}</td>
                                                            
                                                            <td>{{ $inci->usuario}}</td>
                                                          @if(Auth::user()->rol<>3)  
                                                           @foreach ($usuarios as $usuario )
                                                               @if($inci->idusuario ==$usuario->id)  
                                                             
                                                            <td >{{ $usuario->sectores->implode('nombre',",\n") }}</td>
                                                                @endif
                                                          @endforeach
                                                          @endif
                                                            <td>
                                                                
                                                                    <a class="btn btn-dark btn-sm rounded-circle" style="background-color:#b2ff59;" href="{{ route('incidente.show',$inci->id) }}"  title="Ver"><i class="fas fa-eye fa-sm" style="color:black"></i></a>
                                                                    
                                                                
                                                            @if($inci->estado == 'En Proceso')
                                                                @foreach($details as $det)
                                                                    @if($det->incidente_id == $inci->id and $det->estado == 'Recibido')
                                                                          
                                                                            <a class="btn  btn-dark btn-sm rounded-circle" style="background-color:#b2ff59;" href="{{ route('incidente.edit',$inci->id) }}"title="Editar"><i class="fas fa-edit fa-sm" style="color:black"></i></a>
                                                                       
                                                                    @endif
                                                                @endforeach 
                                                            @endif
                                                                
                            
                                                            
                                                            
                                                            </td>
                                                        </tr>
                                                       
                                                    @endforeach
                                                </tbody>
                                                   
                                                   
                                            </table>

                                        </div>
                                    
                                </div> 
                                
                    
                    
        </div>
    </div>
  
  
   
@endsection

  