<div >
    <div class="row">
        <div class="form-group  col-md-6 col-lg-6">
                <strong>Nombre:</strong>
                    @if(Auth::user()->rol <> 3)
                        {!! Form::text('nombre', $incidente->nombre, array('placeholder' => 'Nombre','class' => 'form-control','style'=>'border-radius: 20px;','required' => 'required')) !!}
                    @else
                        {!! Form::text('nombre', $incidente->nombre, array('placeholder' => 'Nombre','class' => 'form-control','style'=>'border-radius: 20px;','required' => 'required','disabled'=>'disabled')) !!}
                    @endif       
        </div>
        <div class="form-group col-md-6 col-lg-6">
               
                    <strong>Caracter:</strong>
             
                <select id="caracter" name='caracter' class="form-control" style="text-align:rigth;  border-radius: 20px; " required  >
                        
                        @if($incidente->caracter=="Urgente")
                            <option   value="Urgente" selected>Urgente </option>
                            <option   value="Sin apuro" >Sin apuro </option>
                            <option   value="Requisito(Deseo)">Requisito(Deseo)</option>
                        @endif 
                        @if($incidente->caracter=="Sin apuro")
                            <option   value="Urgente" >Urgente </option>
                            <option   value="Sin apuro" selected>Sin apuro </option>
                            <option   value="Requisito(Deseo)">Requisito(Deseo)</option>
                        @endif  
                        @if($incidente->caracter=="Requisito(Deseo)")
                            <option   value="Urgente" >Urgente </option>
                            <option   value="Sin apuro" >Sin apuro </option>
                            <option   value="Requisito(Deseo)" selected>Requisito(Deseo)</option>
                        @endif            
                    
                </select>
              
                </div>      
               
    </div>        
                
    <div class="row">
            <div class="form-group col-md-6 col-lg-6">
                    <strong>Tipo </strong>
                   
                        <select id="tipo" name='tipo'  class="form-control" style="text-align:rigth; border-radius: 20px;">
                                <option selected="true" disabled="disabled">Seleccione un tipo de incidente</option>
                            @foreach($tipos as $tipo)
                                @if($incidente->tipo_id == $tipo->id)
                                    <option  data-toggle="tooltip" data-placement="left" title="{{$tipo->descripcion}} "value="{{$tipo->id}}" selected>{{$tipo->nombre}} </option>
                                @else
                                
                                    <option  data-toggle="tooltip" data-placement="left" title="{{$tipo->descripcion}} "value="{{$tipo->id}}">{{$tipo->nombre}} </option>
                                @endif
                            @endforeach
                        </select>
                    
                </div>
            
                <div class="form-group col-md-6 col-lg-6">
                    <strong>Reportado por:</strong>
                    {!! Form::text('repotador', $reporter->name, array('placeholder' => 'Reportador','class' => 'form-control','style'=>'border-radius: 20px','disabled'=>'disabled')) !!}
                </div>
    
    </div>          

                @if($incidente->estado=='Finalizado')

                <div class="form-group ">
                    <strong>Resuelto por:</strong>
                    {!! Form::text('solucionado', $resolver->name, array('placeholder' => 'Resuelto por','class' => 'form-control','style'=>'border-radius: 20px','disabled'=>'disabled')) !!}
                </div>
                @endif
            
                <div class="form-group ">
            
            <strong>Estado: </strong>
           
            @if(Auth::user()->rol == 3)
                <select id="estado" name='estado' class="form-control" style="text-align:rigth; border-radius: 20px;" disabled="disabled" >
            @else    
            <select id="estado" name='estado' class="form-control" style="text-align:rigth;border-radius: 20px ;" required >
            @endif
                        @if($incidente->estado == 'Pendiente')
                            <option value="Pendiente" selected >Pendiente</option>
                            <option value="En Proceso" >En Proceso</option>               
                        @endif
                        
                        @if($incidente->estado == 'En Proceso')
                            <option value="En Proceso" selected>En Proceso</option>
                            <option value="Pendiente" >Pendiente</option>                      
                            
                        @endif
                        @if($incidente->estado=='Finalizado')
                        <option value="Finalizado" selected>Finalizado</option>
                        <option value="Pendiente" >Pendiente</option>
                        <option value="En Proceso" >En Proceso</option>
                        @endif                        
                </select>
           
            </div>

            <div class="form-group ">
                    <strong>Descripcion:</strong>
                    @if(Auth::user()->rol <> 3)
                        {!! Form::textarea('detalle', null, array('placeholder' => 'Descripcion del incidente','class'=> 'form-control','style'=>'border-radius: 20px')) !!}
                    @else
                        {!! Form::textarea('detalle', null, array('placeholder' => 'Descripcion del incidente','class'=> 'form-control','style'=>'border-radius: 20px', 'disabled'=>'disabled')) !!}
                    @endif
                </div>
            @if($incidente->imagen <> null)
                 <div class="form-group">
                 <strong>Imagen:</strong>
                  <a href="../../{{$incidente->imagen}}">
                     <img style="border-radius: 20px" src="../../{{$incidente->imagen}}" height="100px" width="100px" alt="Sin imagen">
                  </a>
                 </div>               
            @endif

            
            <div class="form-group ">
                <strong>Observaciones:</strong>
                {!! Form::textarea('observaciones', null, array('placeholder' => 'Detalle las tareas realizadas y si es enviado a otro sector','class' => 'form-control','style'=>'border-radius: 20px','required' => 'required')) !!}
                </div>
             
        
        
                <div class="form-group ">
                
                <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="finalizar" value="1">
                        <label class="custom-control-label" for="customSwitch1"><h5> <strong>  Finalizar  </strong></h5> </label>
                </div>
                
                </div>
             

                <div class="form-group ">
                    <strong id="sector1">Sector </strong>
                    
                    
                        <select id="sector" name='sector'  class="form-control" style="text-align:rigth; border-radius: 20px" required>
                                <option style="border-radius: 20px" selected="true" disabled="disabled">Seleccione el sector a enviar </option>
                            @foreach($sectores as $sector)
                                <option  data-toggle="tooltip" data-placement="left" title="{{$sector->nombre}} "value="{{$sector->id}}"> {{$sector->nombre}} </option>
                           @endforeach
                        </select>
                    
                </div>
                    <button type="submit"   style="border-radius: 20px"  class="btn btn-success float-center">Guardar</button>
            </div>


    </div>
   



          <script src="{{ asset('js/jquery.js') }}"></script>
          <script>
              $(document).ready(function(){
                  $('#customSwitch1').click(function(){
                      ocultar();
                  });
              });
      
              function ocultar(){
                 var  opc=document.getElementById('customSwitch1').value;
                  
                  if(opc == 1){
                      
                      $('#sector').hide();
                      $('#sector1').hide();
                      $("#customSwitch1").val("0");
                      
                  }else{
                    
                      $('#sector').show();
                      $('#sector1').show();
                      $("#customSwitch1").val("1");
                  }
              }
              
          </script>