@extends('home')
@section('content')
    <div class="card ">
        <div class="card-header"  style="background-color:#212121">
            <h1 class="card-title text-center" style="color:#ccd4c2" >Documento</h1>                      
                            
        </div>
        <div class="card-body " style="background-color:#ccff90 ;">
                <div class="row">
                        <a class="btn  btn-dark" style="border-radius:20px;" href="{{ route('incidente.index') }}"> Volver </a>
                </div>
                <hr>
                <div>
                 
                        <div class="row">
                            <div class="form-group col-md-3 col-lg-3 ">
                                    <strong>Creado:</strong>
                            </div>
                            <div  class="form-group col-md-9 col-lg-9 ">
                                {{ \Carbon\Carbon::parse($incidente->created_at)->format('d/m/Y H:m:s')}}
                            </div>
                           
                        </div>
                        
                        
                    
                    
                        @if($incidente->created_at <> $incidente->updated_at)
                            
                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                                    <strong>Modificado:</strong>
                                </div>
                                <div class="form-group col-md-3 col-lg-3 "> 
                                        {{ \Carbon\Carbon::parse($incidente->updated_at)->format('d/m/Y H:m:s')}}
                                </div>
                        </div>
                            
                        @endif
                        
                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                          
                                    <strong>Nombre:</strong>
                                </div >
                        <div class="form-group col-md-3 col-lg-3 ">
                                        
                                    {{ $incidente->nombre}}
                            </div>
                        </div>
                      

                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                                    <strong>Caracter:</strong>
                                </div>
                                <div class="form-group col-md-3 col-lg-3 "> 
                                        {{ $incidente->caracter}}
                                </div>
                        </div>
                               
                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                                    <strong>Estado:</strong>
                                </div>
                                <div class="form-group col-md-3 col-lg-3 "> 
                                       
                                {{ $incidente->estado}}
                                </div>
                        </div>

                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                                    <strong>Tipo de Incidente:</strong>
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
                        
                        
                        
                        @if($resolver <> null)
                            
                            <div class="row">
                                    <div class="form-group col-md-3 col-lg-3 ">
                                            <strong>Resuleto por:</strong>
                                    </div>
                                    <div class="form-group col-md-3 col-lg-3 "> 
                                            {{ $resolver->name}}
                                    </div>
                            </div> 
                                    
                            <div class="row">
                                    <div class="form-group col-md-3 col-lg-3 ">
                                            <strong>Fecha de Resolucion :</strong>
                                    </div>
                                    <div class="form-group col-md-3 col-lg-3 "> 
                                            {{ \Carbon\Carbon::parse($incidente->finalizado)->format('d/m/Y H:m:s')}} 
                                    </div>
                            </div> 
        
                            
                                   
                            
                        @endif

                        <div class="row">
                                <div class="form-group col-md-3 col-lg-3 ">
                                        <strong>Descripcion:</strong>
                                </div>
                                <div class="form-group col-md-3 col-lg-3 "> 
                                        {{ $incidente->detalle}}
                                </div>
                        </div> 
                       
                                                    
                        @if($incidente->imagen <> null)

                            <div class="row">
                                    <div class="form-group col-md-3 col-lg-3 ">
                                            <strong>Imagen :</strong>
                                    </div>
                                    <div class="form-group col-md-3 col-lg-3 "> 
                                            <a href="../{{$incidente->imagen}}"  target="_blank">
                                                <img src="../{{$incidente->imagen}}"  height="100px" width="100px"  >
                                            </a>
                                    </div>
                            </div> 
                       
                                
                        @endif
                      
                       
                        @include('incidente.modal')   
                       
                        <div >
                            
                            <a href="" data-target="#modal-show"  data-toggle="modal"><button class="btn  btn-success btn-lg" style="border-radius:20px;" title="mostrar" >Detalles</button></a>
         
                        </div>
                </div>     
               
        </div>        
    </div>
@endsection 