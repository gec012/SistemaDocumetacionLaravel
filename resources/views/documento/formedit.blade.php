<div >
    <div class="row">
        <div class="form-group  col-md-6 col-lg-6">
                <strong>Número:</strong>
                    @if(Auth::user()->rol <> 3)
                        {!! Form::text('numero', $documento->numero, array('placeholder' => 'Número','class' => 'form-control','style'=>'border-radius: 20px;','required' => 'required')) !!}
                    @else
                        {!! Form::text('numero', $documento->numero, array('placeholder' => 'Número','class' => 'form-control','style'=>'border-radius: 20px;','required' => 'required','disabled'=>'disabled')) !!}
                    @endif       
        </div>        
        <div class="form-group  col-md-6 col-lg-6">
            <strong>Titulo:</strong>
                @if(Auth::user()->rol <> 3)
                    {!! Form::text('titulo', $documento->titulo, array('placeholder' => 'Titulo','class' => 'form-control','style'=>'border-radius: 20px;','required' => 'required')) !!}
                @else
                    {!! Form::text('titulo', $documento->titulo, array('placeholder' => 'Titulo','class' => 'form-control','style'=>'border-radius: 20px;','required' => 'required','disabled'=>'disabled')) !!}
                @endif       
    </div>            
    </div>        
                
    <div class="row">
            <div class="form-group col-md-6 col-lg-6">
                    <strong>Tipo </strong>
                   
                        <select id="tipo" name='tipo'  class="form-control" style="text-align:rigth; border-radius: 20px;">
                                <option selected="true" disabled="disabled">Seleccione un tipo de documento</option>
                            @foreach($tipos as $tipo)
                                @if($documento->tipo_id == $tipo->id)
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

                
            
    <div class="form-group ">
            
            <strong>Estado: </strong>
           
            @if(Auth::user()->rol == 3)
                <select id="estado" name='estado' class="form-control" style="text-align:rigth; border-radius: 20px;" disabled="disabled" >
            @else    
            <select id="estado" name='estado' class="form-control" style="text-align:rigth;border-radius: 20px ;" required >
            @endif
                        @if($documento->estado == 'Pendiente')
                            <option value="Pendiente" selected >Pendiente</option>
                            <option value="En Proceso" >En Proceso</option>               
                        @endif
                        
                        @if($documento->estado == 'En Proceso')
                            <option value="En Proceso" selected>En Proceso</option>
                            <option value="Pendiente" >Pendiente</option>                      
                            
                        @endif
                        @if($documento->estado=='Finalizado')
                        <option value="Finalizado" selected>Finalizado</option>
                        <option value="Pendiente" >Pendiente</option>
                        <option value="En Proceso" >En Proceso</option>
                        @endif                        
                </select>
           
    </div>

    <div class="form-group ">
        <strong>Descripcion:</strong>
        @if(Auth::user()->rol <> 3)
            {!! Form::textarea('observacion', null, array('placeholder' => 'Descripcion del documento','class'=> 'form-control','style'=>'border-radius: 20px')) !!}
        @else
            {!! Form::textarea('observacion', null, array('placeholder' => 'Descripcion del documento','class'=> 'form-control','style'=>'border-radius: 20px', 'disabled'=>'disabled')) !!}
        @endif
    </div>
           

            
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