@extends('home')
@section('content')
    <div class="card ">
        <div class="card-header"  style="background-color:#212121">
            <h1 class="card-title text-center" style="color:#ccd4c2" >Documento</h1>                      
                            
        </div>
        <div class="card-body " style="background-color:#ccff90 ; ">
                <div class="row">
                        <a class="btn  btn-dark" style="border-radius:20px;" href="{{ route('documento.index') }}"> Volver </a>
                </div>
                <hr>
                <div>
                 
                        <div class="row">
                            <div class="form-group col-md-3 col-lg-3 ">
                                    <strong>Creado:</strong>
                            </div>
                            <div  class="form-group col-md-9 col-lg-9 ">
                                {{ \Carbon\Carbon::parse($documento->created_at)->format('d/m/Y H:m:s')}}
                            </div>
                           
                        </div>
                        
                        
                    
                    
                        @if($documento->created_at <> $documento->updated_at)
                            
                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                                    <strong>Modificado:</strong>
                                </div>
                                <div class="form-group col-md-3 col-lg-3 "> 
                                        {{ \Carbon\Carbon::parse($documento->updated_at)->format('d/m/Y H:m:s')}}
                                </div>
                        </div>
                            
                        @endif
                        
                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                          
                                    <strong>Nombre:</strong>
                                </div >
                        <div class="form-group col-md-3 col-lg-3 ">
                                        
                                    {{ $documento->titulo}}
                            </div>
                        </div>
                      

                  
                               
                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                                    <strong>Estado:</strong>
                                </div>
                                <div class="form-group col-md-3 col-lg-3 "> 
                                       
                                {{ $documento->estado}}
                                </div>
                        </div>

                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                                    <strong>Tipo de Documento:</strong>
                                </div>
                                <div class="form-group col-md-3 col-lg-3 "> 
                                        {{ $tipos->nombre}}
                                </div>
                        </div>
                      
                        
                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                                        <strong>Generado por:</strong>
                                </div>
                                <div class="form-group col-md-3 col-lg-3 "> 
                                        {{ $reporter->name}}
                                </div>
                        </div> 
                        
                        
                        
                     

                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                                        <strong>Descripcion:</strong>
                                </div>
                                <div class="form-group col-md-3 col-lg-3 "> 
                                        {{ $documento->observacion}}
                                </div>
                        </div> 
                       
                                                    
                        
                      
                       
                        
                       
                        <div >
                            
                            <button class="btn  btn-success btn-lg" style="border-radius:20px;" id="mostrar" onclick="ocultar()" title="mostrar" value="1" >Detalles</button>
         
                        </div>
                </div>     
               
        </div>
        <div class="card-footer table-responsive text-center"id="tabla" style="font-size:12px;background-color:#ccff90 ;">
                <table   class="table table-hover table-striped table-sm ">
                        <thead  class="thead-dark" style="background:darkslategray" >
                               <tr >
                                       <th >Enviado por </th>
                                       <th >Recibido por</th>
                                       <th >Hora de recibido</th>
                                       <th >Sector al que se envio</th>
                                       <th >Tareas Realizadas</th>
        
                                       <th >Estado </th>
                                       <th>Recibir</th>
                                   
                                      
                                   </tr>
                        </thead>
                          <tbody  class="text-dark" style="background-color:#eeeeee ">
                               
                               @foreach ($detallesDoc as $di)
                                  
                                   <tr>                             
                              
        
                                  @foreach($users as $user)
                                   @if($di->send_id == $user->id )
                                       <td >{{ $user->name}}</td>
                                   @endif
                                  @endforeach
                                   @if($di->recived_id <> null)
                                       @foreach($users as $user)
                                           @if($di->recived_id == $user->id   )
                                               <td >{{ $user->name}}</td>
                                                @endif
                                       @endforeach
                                   @else
                                       <td >Sin recepcion</td>
                                   @endif
                                   
                                   @if($di->hora_de_recibido <> null)
                                   <td >{{ $di->hora_de_recibido}}</td>
                                  @else
                                  <td ></td>
                                  @endif
                                  @if($di->sector_id <> null)
                                       @foreach($sectores as $sec)
                                           @if($di->sector_id == $sec->id   )
                                               <td >{{ $sec->nombre}}</td>
                                           
                                           @endif
                                       @endforeach
                                   @else
                                       <td ></td>
                                   @endif
        
                                  <td >{{ $di->observaciones}}</td>
                                  <td >{{ $di->estado}}</td>
                                  @if($di->estado == 'Pendiente' or $di->estado == 'Enviado')
                                  <td >
                                    {!! Form::open(['method' => 'PATCH','route' => ['documento.update',$documento->id],'style'=>'display:inline']) !!}
                       
                                    {{ Form::button('<i class="fa fa-sm fa-check" style="color:black"></i>', ['class' => 'btn btn-dark btn-sm rounded-circle','name'=>'check','value'=>'1','style'=>'background-color:#b2ff59;','title'=>'Habilitar' ,'type' => 'submit']) }}
        
                                    {!! Form::close() !!}
                                  </td>
                                  @else 
                                       <td ></td>
                                  @endif
                                          
                                
                           @endforeach
                          </tbody>
                   </table>
            </div>        
    </div>
  
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('#tabla').fadeToggle();
        });

        function ocultar(){
           var  opc=document.getElementById('mostrar').value;
            
            if(opc == 1){
                
                $('#tabla').fadeToggle();
                
                $("#mostrar").val("0");
                
            }else{
              
                $('#tabla').slideToggle();
               
                $("#mostrar").val("1");
            }
        }
        
    </script>
@endsection 