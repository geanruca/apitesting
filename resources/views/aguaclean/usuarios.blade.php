@extends('adminlte::page')

@section('title', 'Aguaclean - Usuarios')

@section('content_header')
    <h1>Administración de usuarios</h1>
@stop

@section('content')
 <div id='app'>
     <user-list></user-list>
 </div>
@stop