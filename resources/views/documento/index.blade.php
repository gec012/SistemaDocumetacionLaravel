@extends('home')
@section('content')      
 

<style>
    .verde {
        background-color: #b2ff59;
        border-color: black;
        margin-bottom: 5px;
       
    }    

    .pagination {
        color:crimson;
    }
    
    </style>    

<div class="card text-center" style="color:#212121;font-size:12px" >
        <div class="card-header" style="background-color:#212121">
                <div >
                        <h1 class="card-title " style="color:#eeeeee" > Documentos </h1>
                    </div>
        </div>
        <div class="card-body" style="background-color:#ccff90">
                <div class="row" >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           
                                                             
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif
                            @if ($tam <> 0)
                            
                                <div class="alert alert-info">
                                    <strong>Se generaron {{ $tam }} nuevos documento</strong>
                                </div>
                                @endif
                            
                                    
                        </div> 
                    </div>
                    <div class="row ">
                       <div class="col">

                <a class=" float-right btn btn-lg m-2 btn-dark rounded-circle" style="background-color:#b2ff59" href ="{{ route('documento.create') }}" data-toggle="tooltip" title="Nuevo Documento"> <i class="fas fa-plus-circle fa-sm" style="color:black"></i></a>
                       </div>
                    </div>
                    
                       
                    
                
                            <div class="row ">
                                   
                                        <div class="table-responsive ">
                                            <table   class=" table table-sm  table-hover table-striped table-condensed  table-compact" id="tablaprueba">
                                                <thead  class="thead-dark" style="background:darkslategray" >
                                                        <tr >
                                                                <th>Número</th>    
                                                                <th>Titulo</th>    
                                                            
                                                                <th>Situacion del Documento</th>
                                                                <th>Creado</th>                                                                
                                                                <th>Usuario </th>
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
                                                    @foreach ($documentos as $doc )
                                                      
                                                      <tr>
                                                            <td >{{ $doc->numero}}</td>
                                                            <td >{{ $doc->titulo}}</td>
                                                            @if($doc->estado =='Finalizado')
                                                            <td style="background-color:lawngreen">{{ $doc->estado }}</td>
                                                            @endif
                                                            @if($doc->estado =='En Proceso')
                                                            <td style="background-color:#d4e157 ">{{ $doc->estado }}</td>
                                                            @endif
                                                            @if($doc->estado =='Iniciado')
                                                            <td style="background-color:#ef5350">{{ $doc->estado }}</td>
                                                            @endif
                                                            <td > {{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y H:m:s')}}</td>
                                                            
                                                           @foreach ($usuarios as $usuario )
                                                            
                                                            @if($doc->sent_id ==$usuario->id)  
                                                            <td>{{ $usuario->name}}</td>
                                                            @if(Auth::user()->rol<>3)  
                                                             
                                                            <td >{{ $usuario->sectores->implode('nombre',",\n") }}</td>
                                                                @endif
                                                          
                                                          @endif
                                                          
                                                          @endforeach
                                                          <td>
                                                                
                                                                    <a class="btn btn-dark btn-sm rounded-circle" style="background-color:#b2ff59;" href="{{ route('documento.show',$doc->id) }}"  title="Ver"><i class="fas fa-eye fa-sm" style="color:black"></i></a>
                                                                    
                                                                    @if($doc->estado == 'En Proceso')
                                                                    @foreach($details as $det)
                                                                        @if($det->documento_id == $doc->id and $det->estado == 'Recibido')
                                                                              
                                                                                <a class="btn  btn-dark btn-sm rounded-circle" style="background-color:#b2ff59;" href="{{ route('documento.edit',$doc->id) }}" title="Editar"><i class="fas fa-edit fa-sm" style="color:black"></i></a>
                                                                           
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
    
    
    <script>
      
            


        $(document).ready(function() {
            $('#tablaprueba').dataTable( {
               
               "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
                    
                    "paginate": {
                        "next": "Next page",
                      
                        }
                },
                
             
                dom: 'Bfrtip',
                
                buttons: [
                    { extend:'excelHtml5',
                      text: '<i class="fas fa-file-excel fa-sm"  style="color:black" ></i>',
                      className:'rounded-circle verde',
                      
                      titleAttr: 'Excel'

                    },
                    {
                        extend:'pdfHtml5',
                        text: '<i class="fas fa-file-pdf fa-sm"  style="color:black" ></i>',
                        className:'rounded-circle verde',
                      
                         titleAttr: 'Pdf'
                        
                    },
                    {
                        extend:'csvHtml5',
                        text: '<i class="fas fa-file-csv fa-sm"  style="color:black" ></i>',
                        className:'rounded-circle verde',
                      
                         titleAttr: 'CSV'

                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print fa-sm"  style="color:black" ></i>',
                        className:'rounded-circle verde',
                        
                         titleAttr: 'Print'
                    }
                   
                   
                   
                ]
            } );
        } );
    </script>
  
  
@endsection

  