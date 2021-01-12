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
            <h2 class="card-title" style="color:#ccd4c2" >Nuevo Tipo</h2>
            @if ($message = Session::get('success'))
            <div class="alert alert-warning">
                <p>{{ $message }}</p>
            </div>
           @endif
    </div>

    <div class="card-body"  style="background-color:#ccff90";>
            <div class="row"> 

                    <a class="btn btn-dark float-right" style=" border-radius: 20px;" href="{{ route('tipo.index') }}">Volver</a>
            </div>
    <hr>
            {!! Form::open( ['method' => 'POST','route' => ['tipo.store']]) !!}
                        @include('tipo.form')
            {!! Form::close() !!}
    </div>
</div>
@endsection