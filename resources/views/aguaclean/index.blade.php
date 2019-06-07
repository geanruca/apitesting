@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bienevenido</p>
    <p> Resumen de ventas por rango de fechas</p>

    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Ventas mensuales</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" style="">
          <div class="chart">
            <canvas id="myChart" width="400" height="400"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
 
<script>

</script>
@stop