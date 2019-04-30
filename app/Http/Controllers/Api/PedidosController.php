<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pedido;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::All();

        return response()->json([
            "status"=>true,
            "data"=>$pedidos
        ]);
    }


    public function store(Request $r)
    {
        $pedido = new Pedido();
        $pedido->estado_pago       = $r->estado_pago;
        $pedido->estado_despacho   = $r->estado_despacho;
        $pedido->medio_de_pago     = $r->medio_de_pago;
        $pedido->total_pago        = $r->total_pago;
        $pedido->detalle_productos = $r->detalle_productos;
        $pedido->horario_recepcion = $r->horario_recepcion;
        $pedido->notas             = $r->notas;
        $pedido->id_usuario        = $r->id_usuario;
        $pedido->id_comuna         = $r->id_comuna;
        $pedido->id_conductor      = $r->id_conductor;
        $pedido->save();

        return response()->json([
            "status"=>true,
            "data"=>"Pedido guardado"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $a = Pedido::find($id);

        return response()->json([
            "status"=>true,
            "data"=>$a
        ]); 
    }

    public function update(Request $r, $id)
    {
        $pedido = Pedido::find($id);
        $pedido->estado_pago       = $r->estado_pago;
        $pedido->estado_despacho   = $r->estado_despacho;
        $pedido->medio_de_pago     = $r->medio_de_pago;
        $pedido->total_pago        = $r->total_pago;
        $pedido->detalle_productos = $r->detalle_productos;
        $pedido->horario_recepcion = $r->horario_recepcion;
        $pedido->notas             = $r->notas;
        $pedido->id_usuario        = $r->id_usuario;
        $pedido->id_comuna         = $r->id_comuna;
        $pedido->id_conductor      = $r->id_conductor;
        $pedido->save();

        return response()->json([
            "status"=>true,
            "data"=>"Pedido guardado"
        ]);
    }

    
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
        return response()->json([
            "status"=>true,
            "data"=>"Pedido borrado"
        ]);
    }
}
