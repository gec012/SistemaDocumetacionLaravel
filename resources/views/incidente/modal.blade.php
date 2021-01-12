
    <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-show">
  
       <div class="modal-dialog modal-lg" >

        <div class="modal-content"  >
            <div class="modal-header" style="background-color:#212121;">
                <h3   style="color:#ccd4c2">Detalles:</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-light"> X </span>
                </button>
                
            </div>
            <div class="modal-body text-light"  style="background-color:#ccff90;">
           
                                <table   class="table table-sm ">
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
                                            @php
                                                $band = true
                                            @endphp  
                                            @foreach ($detallesInci as $di)
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
                                                 {!! Form::open(['method' => 'PATCH','route' => ['incidente.update',$incidente->id],'style'=>'display:inline']) !!}
                                    
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
            <div class="modal-footer"style="background-color:#212121;">
               <button type="button" class="btn btn-dark " style="background-color:#b2ff59;color:black; border-radius:20px;" data-dismiss="modal">Cerrar</button>
             
            </div>
        </div>
     </div>
  
 
  
</div>