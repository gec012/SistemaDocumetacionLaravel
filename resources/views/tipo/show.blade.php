@extends('home')

@section('content')
        <div class="row">
        <div class="col-lg-12 margin-tb">
        <div class="pull-left">
        <h2 align="center"> Ver Tipo</h2>
        </div>
        <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('tipo.index') }}">
        Volver </a>
        </div>
        </div>
        </div>
        <br>
            <div class="column-left">
            
                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Nombre:</strong>
                        {{ $tipo->nombre}}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Descripcion:</strong>
                        {{ $tipo->descripcion}}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Estado:</strong>
                        {{ $tipo->estado}}
                    </div>
                </div>
           
        </div>

@endsection 