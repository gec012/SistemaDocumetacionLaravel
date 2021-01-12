
         <div >
          
            <div class="row">
                <div class="form-group col-md-6 col-lg-6">
                <strong>Titulo:</strong>
                {!! Form::text('titulo', null, array('placeholder' => 'Nombre','class' => 'form-control ','style'=>'border-radius: 20px;', 'required' => 'required')) !!}
                </div>
               
                <div class="form-group col-md-6 col-lg-6 ">
                    <strong>Número:</strong>
                    {!! Form::text('numero', null, array('placeholder' => 'Numero','class' => 'form-control ','style'=>'border-radius: 20px;', 'required' => 'required')) !!}          
                </div>
            </div>    
            <div class="row">
                 
                    <div class="form-group col-md-6 col-lg-6">
                            <label >
                            <strong>Tipo</strong>  </label>
                            <div >
                            
                                <select id="tipo" name='tipo' class="form-control" style="text-align:rigth; border-radius: 20px; "  >
                                        <option selected="true" disabled="disabled">Seleccione un tipo de Documento:</option>
                                    @foreach($tipos as $tipo)
                                        <option   value="{{$tipo->id}}">{{$tipo->nombre}} </option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                
                            <div class="form-group col-md-6 col-lg-6 ">
                            <label >
                            <strong>Sector al que se envia</strong>  </label>
                            <div>
                            
                                <select id="sector" name='sector' class="form-control" style="text-align:rigth; border-radius: 20px;"  >
                                        <option selected="true" disabled="disabled">Selecione un Sector:</option>
                                    @foreach($sectores as $sector)
                                        <option   value="{{$sector->id}}">{{$sector->nombre}} </option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
            </div>
               

            
            <div class="form-group mt-1">
                    <strong>Observación:</strong>
                    <div class="mt-2">
                        {!! Form::textarea('observacion', null, array('placeholder' => 'Descripcion del expediente','style'=>'border-radius: 15px;','class'=> 'form-control','required' => 'required')) !!}
            
                    </div>
                       </div>
        
                    <button type="submit"  class="btn btn-success float-center" style="border-radius: 20px;">Guardar</button>
            </div>



