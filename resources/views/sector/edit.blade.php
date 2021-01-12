@extends('home')

@section('content')
@if (count($errors) < 0)
    <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                @endforeach
            </ul>
    </div>
@endif

<div class="card text-center">
        <div class="card-header"  style="background-color:#212121">
                <h2 class="card-title" style="color:#ccd4c2" >Editar sector</h2>
    
        </div>
    
        <div class="card-body"  style="background-color:#ccff90";>
                <div class="row"> 
    
                        <a class="btn btn-dark float-right" style=" border-radius: 20px;" href="{{ route('sector.index') }}">Volver</a>
                </div>
        <hr>

            {!! Form::model($sector,[ 'method'=> 'PATCH','route'=>['sector.update', $sector->id]]) !!}

               @include('sector.form')
            {!! Form::close() !!}
        </div>
</div>
@endsection
