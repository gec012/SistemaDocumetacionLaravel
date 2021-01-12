
         <div >
          
            <div class="row">
                <div class="form-group col-md-6 col-lg-6">
                <strong>Nombre:</strong>
                {!! Form::text('nombre', null, array('placeholder' => 'Nombre','class' => 'form-control ','style'=>'border-radius: 20px;', 'required' => 'required')) !!}
                </div>
               
                <div class="form-group col-md-6 col-lg-6 ">
               
                    <strong>Caracter:</strong>
                
                <select id="caracter" name='caracter' class="form-control" style="text-align:rigth; border-radius: 20px; " required  >
                        <option   value="Urgente">Urgente </option>
                        <option   value="Sin apuro" selected>Sin apuro </option>
                        <option   value="Requisito(Deseo)">Requisito(Deseo)</option>           
                    
                </select>
              
                </div>
            </div>    
            <div class="row">
                 
                    <div class="form-group col-md-6 col-lg-6">
                            <label >
                            <strong>Tipo</strong>  </label>
                            <div >
                            
                                <select id="tipo" name='tipo' class="form-control" style="text-align:rigth; border-radius: 20px; "  >
                                        <option selected="true" disabled="disabled">Seleccione un tipo de incidente</option>
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
                                        <option selected="true" disabled="disabled">Seleccione un tipo de Documento</option>
                                    @foreach($sectores as $sector)
                                        <option   value="{{$sector->id}}">{{$sector->nombre}} </option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
            </div>
               

            
            <div class="form-group ">
                    <strong>Descripcion:</strong>
                    {!! Form::textarea('detalle', null, array('placeholder' => 'Descripcion del incidente','style'=>'border-radius: 15px;','class'=> 'form-control','required' => 'required')) !!}
                </div>

           
            <form method="POST"  accept-charset="UTF-8" enctype="multipart/form-data">
            
                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
            

            <div class="form-group">
             
                    <div class="custom-file">
                            <input type="file"  name="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" >
                            <label class="custom-file-label" for="inputGroupFile01">Seleccione una imagen</label>
                          </div>
               
              
            </div>
          </form>


        
             
        
                    <button type="submit"  class="btn btn-success float-center" style="border-radius: 20px;">Guardar</button>
            </div>



