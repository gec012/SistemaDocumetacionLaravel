

{!! Form::open(array('url'=>'incidente','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
 <div class="form-group">
     <div class="input-group">
         <input id="searchText"type="text" name="searchText" class="form-control" placeholder="Busqueda por estado,usuario o caracter" value="{{$searchText}}">
         <span class="input-group-btn">
             <button type="submit" class="btn btn-dark" style="background-color:#424242;"><i class="fas fa-search">  Buscar</i></button>
         </span>
     </div>
 </div>
 
{!! Form::close() !!}