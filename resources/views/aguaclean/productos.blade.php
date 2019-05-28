@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Administración de productos</h1>
@stop

@section('content')
 <div id='app'>
     <product-list></product-list>
 </div>
@stop