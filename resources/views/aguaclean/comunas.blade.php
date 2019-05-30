@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Administración de comunas</h1>
@stop

@section('content')
 <div id='app'>
     <lista-de-comunas></lista-de-comunas>
     {{-- <image-input></image-input> --}}
 </div>
@stop