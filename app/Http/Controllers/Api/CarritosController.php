<?php

namespace App\Http\Controllers\Api;

use App\Carrito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CarritosController extends Controller
{
    public function carrito_contador($id_usuario){
        $user = Auth::user();
        $cantidad = 0;
        $carrito = Carrito::where('id_usuario',$id_usuario)->first();
        (!$carrito->nombre_producto_1) ?  : $cantidad++ ;
        (!$carrito->nombre_producto_2) ?  : $cantidad++ ;
        (!$carrito->nombre_producto_3) ?  : $cantidad++ ;
        (!$carrito->nombre_producto_4) ?  : $cantidad++ ;
        (!$carrito->nombre_producto_5) ?  : $cantidad++ ;
        (!$carrito->nombre_producto_6) ?  : $cantidad++ ;
        (!$carrito->nombre_producto_7) ?  : $cantidad++ ;
        (!$carrito->nombre_producto_8) ?  : $cantidad++ ;
        (!$carrito->nombre_producto_9) ?  : $cantidad++ ;
        (!$carrito->nombre_producto_10) ?  : $cantidad++ ;

        return response()->json($cantidad);
    }

    public function store(Request $r){
        \Log::info('store_carrito',[$r->all()]);
        $carrito = Carrito::where('id_usuario',$r->id_usuario)->first();
        if(!$carrito){
            $carrito = new Carrito();
            $carrito->id_usuario         = $r->id_usuario;
        } 
        // $nombre_producto             = $r->nombre_producto0;        
        // $cantidad_producto           = $r->cantidad_producto0;
        // $precio_producto             = $r->precio_producto0;
        // $subtotal_producto           = $r->subtotal_producto0;
        // $descuento_subtotal_producto = $r->descuento_subtotal_producto0;

        $carrito->nombre_producto_1             = $e->nombre_producto_1 ?? null;
        $carrito->cantidad_producto_1           = $e->cantidad_producto_1 ?? null;
        $carrito->precio_producto_1             = $e->precio_producto_1 ?? null;
        $carrito->subtotal_producto_1           = $e->subtotal_producto_1 ?? null;
        $carrito->descuento_subtotal_producto_1 = $e->descuento_subtotal_producto_1 ?? null;

        $carrito->nombre_producto_2              = $e->nombre_producto_2 ?? null;
        $carrito->cantidad_producto_2            = $e->cantidad_producto_2 ?? null;
        $carrito->precio_producto_2              = $e->precio_producto_2 ?? null;
        $carrito->subtotal_producto_2            = $e->subtotal_producto_2 ?? null;
        $carrito->descuento_subtotal_producto_2  = $e->descuento_subtotal_producto_2 ?? null;

        $carrito->nombre_producto_3              = $e->nombre_producto_3 ?? null;
        $carrito->cantidad_producto_3            = $e->cantidad_producto_3 ?? null;
        $carrito->precio_producto_3              = $e->precio_producto_3 ?? null;
        $carrito->subtotal_producto_3            = $e->subtotal_producto_3 ?? null;
        $carrito->descuento_subtotal_producto_3  = $e->descuento_subtotal_producto_3 ?? null;

        $carrito->nombre_producto_4              = $e->nombre_producto_4 ?? null;
        $carrito->cantidad_producto_4            = $e->cantidad_producto_4 ?? null;
        $carrito->precio_producto_4              = $e->precio_producto_4 ?? null;
        $carrito->subtotal_producto_4            = $e->subtotal_producto_4 ?? null;
        $carrito->descuento_subtotal_producto_4  = $e->descuento_subtotal_producto_4 ?? null;

        $carrito->nombre_producto_5              = $e->nombre_producto_5 ?? null;
        $carrito->cantidad_producto_5            = $e->cantidad_producto_5 ?? null;
        $carrito->precio_producto_5              = $e->precio_producto_5 ?? null;
        $carrito->subtotal_producto_5            = $e->subtotal_producto_5 ?? null;
        $carrito->descuento_subtotal_producto_5  = $e->descuento_subtotal_producto_5 ?? null;

        $carrito->nombre_producto_6              = $e->nombre_producto_6 ?? null;
        $carrito->cantidad_producto_6            = $e->cantidad_producto_6 ?? null;
        $carrito->precio_producto_6              = $e->precio_producto_6 ?? null;
        $carrito->subtotal_producto_6            = $e->subtotal_producto_6 ?? null;
        $carrito->descuento_subtotal_producto_6  = $e->descuento_subtotal_producto_6 ?? null;

        $carrito->nombre_producto_7              = $e->nombre_producto_7 ?? null;
        $carrito->cantidad_producto_7            = $e->cantidad_producto_7 ?? null;
        $carrito->precio_producto_7              = $e->precio_producto_7 ?? null;
        $carrito->subtotal_producto_7            = $e->subtotal_producto_7 ?? null;
        $carrito->descuento_subtotal_producto_7  = $e->descuento_subtotal_producto_7 ?? null;

        $carrito->nombre_producto_8              = $e->nombre_producto_8 ?? null;
        $carrito->cantidad_producto_8            = $e->cantidad_producto_8 ?? null;
        $carrito->precio_producto_8              = $e->precio_producto_8 ?? null;
        $carrito->subtotal_producto_8            = $e->subtotal_producto_8 ?? null;
        $carrito->descuento_subtotal_producto_8  = $e->descuento_subtotal_producto_8 ?? null;
        
        $carrito->nombre_producto_9              = $e->nombre_producto_9 ?? null;
        $carrito->cantidad_producto_9            = $e->cantidad_producto_9 ?? null;
        $carrito->precio_producto_9              = $e->precio_producto_9 ?? null;
        $carrito->subtotal_producto_9            = $e->subtotal_producto_9 ?? null;
        $carrito->descuento_subtotal_producto_9  = $e->descuento_subtotal_producto_9 ?? null;
        
        $carrito->nombre_producto_10             = $e->nombre_producto_10 ?? null;
        $carrito->cantidad_producto_10           = $e->cantidad_producto_10 ?? null;
        $carrito->precio_producto_10             = $e->precio_producto_10 ?? null;
        $carrito->subtotal_producto_10           = $e->subtotal_producto_10 ?? null;
        $carrito->descuento_subtotalp_roducto_10 = $e->descuento_subtotalp_roducto_10 ?? null;
        
        $carrito->descuento_total                = $r->descuento_total ?? null;
        $carrito->total_a_pagar                  = $r->total_a_pagar ?? null;

        $carrito->save();
        return response()->json('Carrito guardado');
    }

    public function show($id_usuario){
        $carrito = Carrito::where('id_usuario',$id_usuario)->first();
        return response()->json($carrito);
    }

    public function delete($id_usuario){
        $carrito = Carrito::where('id_usuario',$id_usuario)->first();
        $carrito->delete();
        return response()->json('Carrito eliminado');
    }
    public function comprados(Carrito $carrito){
        $carrito->onlyTrashed()->where('id','<>','0')->get();
        return response()->json($carrito);
    }
    public function deseados(){
        $deseados = Carrito::All();
        return response()->json($deseados);
    }
}
