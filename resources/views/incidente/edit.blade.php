@extends('home')

@section('content')

@if ($error = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $error }}</p>
                </div>
            @endif

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card text-center">
    <div class="card-header"  style="background-color:#212121">
        <h2 class="card-title" style="color:#ccd4c2">Editar Documento</h2>
    </div>
    
    <div class="card-body" style="background-color:#ccff90 ;" >
            <div class="row">            
                <a class="btn btn-dark mb-2  float-right"  style=" border-radius: 20px;" href="{{ route('incidente.index') }}">Volver</a>
            </div>
            <hr>
            <div>        
                {!! Form::model($incidente,[ 'method'=> 'PATCH', 'files' => true,'route'=>['incidente.update', $incidente->id]]) !!}
                    @include('incidente.formedit')
                {!! Form::close() !!}
            </div>
    </div>
</div>

@endsection
