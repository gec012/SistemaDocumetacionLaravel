
  
      <div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div >
                <strong>Nombre:</strong>
                {!! Form::text('nombre', null, array('placeholder' => 'Nombre','class' => 'form-control','style'=> 'border-radius: 20px')) !!}
                </div>
        
                <div class="mt-4">
                    <strong>Descripcion:</strong>
                    {!! Form::textarea('descripcion', null, array('placeholder' => 'Descripcion','class'=> 'form-control','style'=> 'border-radius: 20px')) !!}
                </div>
        
            </div>
            <div class="mt-4">
                
                    <button type="submit"  class="btn btn-success float-center" style="border-radius: 20px;">Guardar</button>
            </div>
    </div>
   
