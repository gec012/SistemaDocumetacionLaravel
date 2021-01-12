@extends('home')
@section('content')
        <div class="row">
        <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        <h2 align="center"> Ver sector</h2>
        </div>
        <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('sector.index') }}">
        Volver </a>
        </div>
        </div>
        </div>
        <br>
            <div class="column-left">
            
                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $sector->nombre}}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Descripcion:</strong>
                        {{ $sector->descripcion}}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Estado:</strong>
                        {{ $sector->estado}}
                    </div>
                </div>
           
        </div>

@endsection 