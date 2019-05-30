<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comuna;

class ComunasController extends Controller
{
    
    public function index()
    {
        $c = Comuna::select('id','nombre','se_cubre','pedido_minimo','dias_de_despacho','cargo_por_producto')->get();
        return response()->json($c);
    }

    public function store(Request $r)
    {
        $comuna = new Comuna();
        $comuna->nombre             = $r->nombre;
        $comuna->cargo_por_producto = $r->cargo_por_producto;
        $comuna->pedido_minimo      = $r->pedido_minimo;
        $comuna->se_cubre           = 1;
        $comuna->dias_de_despacho   = $r->dias_de_despacho;
        $comuna->save();

        return response()->json([
            'status' => true,
            'msg'    => 'saved'
        ]);
    }


    public function update(Request $r, $id)
    {
        $comuna = Comuna::findOrFail($id);
        $comuna->nombre             = $r->nombre;
        $comuna->cargo_por_producto = $r->cargo_por_producto;
        $comuna->pedido_minimo      = $r->pedido_minimo;
        $comuna->se_cubre           = 1;
        $comuna->dias_de_despacho   = $r->dias_de_despacho;
        $comuna->save();

        return response()->json([
            'status' => true,
            'msg'    => 'saved'
        ]);
    }

    
    public function destroy($id)
    {
        //
    }
}
