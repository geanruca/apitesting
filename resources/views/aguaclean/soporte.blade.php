@extends('adminlte::page')

@section('title', 'Aguaclean - Usuarios')

@section('content_header')
    <h1>Solicitar cambios a los programadores:</h1>
@stop

@section('content')

    <div class="container">
        @if((session()->has("flash")))
            <div class="alert alert-success"><span class="white-text">{{session("flash")}}</span></div>
        @endif
    <form action="{{route('soporte')}}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-sm-5"> <h3>Ingrese los cambios que desea solicitar </h3> </div>
            <div class="col-sm-5">
                <textarea class="form-control" name="soporte"></textarea>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="form-control">Enviar solicitud de cambios</button>
        </div>

    </form>

    </div>

@stop