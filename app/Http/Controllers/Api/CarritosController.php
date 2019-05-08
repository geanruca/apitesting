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

        $carrito->nombre_producto_1             = $r->nombre_producto_1 ?? null;
        $carrito->cantidad_producto_1           = $r->cantidad_producto_1 ?? null;
        $carrito->precio_producto_1             = $r->precio_producto_1 ?? null;
        $carrito->subtotal_producto_1           = $r->subtotal_producto_1 ?? null;
        $carrito->descuento_subtotal_producto_1 = $r->descuento_subtotal_producto_1 ?? null;

        $carrito->nombre_producto_2              = $r->nombre_producto_2 ?? null;
        $carrito->cantidad_producto_2            = $r->cantidad_producto_2 ?? null;
        $carrito->precio_producto_2              = $r->precio_producto_2 ?? null;
        $carrito->subtotal_producto_2            = $r->subtotal_producto_2 ?? null;
        $carrito->descuento_subtotal_producto_2  = $r->descuento_subtotal_producto_2 ?? null;

        $carrito->nombre_producto_3              = $r->nombre_producto_3 ?? null;
        $carrito->cantidad_producto_3            = $r->cantidad_producto_3 ?? null;
        $carrito->precio_producto_3              = $r->precio_producto_3 ?? null;
        $carrito->subtotal_producto_3            = $r->subtotal_producto_3 ?? null;
        $carrito->descuento_subtotal_producto_3  = $r->descuento_subtotal_producto_3 ?? null;

        $carrito->nombre_producto_4              = $r->nombre_producto_4 ?? null;
        $carrito->cantidad_producto_4            = $r->cantidad_producto_4 ?? null;
        $carrito->precio_producto_4              = $r->precio_producto_4 ?? null;
        $carrito->subtotal_producto_4            = $r->subtotal_producto_4 ?? null;
        $carrito->descuento_subtotal_producto_4  = $r->descuento_subtotal_producto_4 ?? null;

        $carrito->nombre_producto_5              = $r->nombre_producto_5 ?? null;
        $carrito->cantidad_producto_5            = $r->cantidad_producto_5 ?? null;
        $carrito->precio_producto_5              = $r->precio_producto_5 ?? null;
        $carrito->subtotal_producto_5            = $r->subtotal_producto_5 ?? null;
        $carrito->descuento_subtotal_producto_5  = $r->descuento_subtotal_producto_5 ?? null;

        $carrito->nombre_producto_6              = $r->nombre_producto_6 ?? null;
        $carrito->cantidad_producto_6            = $r->cantidad_producto_6 ?? null;
        $carrito->precio_producto_6              = $r->precio_producto_6 ?? null;
        $carrito->subtotal_producto_6            = $r->subtotal_producto_6 ?? null;
        $carrito->descuento_subtotal_producto_6  = $r->descuento_subtotal_producto_6 ?? null;

        $carrito->nombre_producto_7              = $r->nombre_producto_7 ?? null;
        $carrito->cantidad_producto_7            = $r->cantidad_producto_7 ?? null;
        $carrito->precio_producto_7              = $r->precio_producto_7 ?? null;
        $carrito->subtotal_producto_7            = $r->subtotal_producto_7 ?? null;
        $carrito->descuento_subtotal_producto_7  = $r->descuento_subtotal_producto_7 ?? null;

        $carrito->nombre_producto_8              = $r->nombre_producto_8 ?? null;
        $carrito->cantidad_producto_8            = $r->cantidad_producto_8 ?? null;
        $carrito->precio_producto_8              = $r->precio_producto_8 ?? null;
        $carrito->subtotal_producto_8            = $r->subtotal_producto_8 ?? null;
        $carrito->descuento_subtotal_producto_8  = $r->descuento_subtotal_producto_8 ?? null;
        
        $carrito->nombre_producto_9              = $r->nombre_producto_9 ?? null;
        $carrito->cantidad_producto_9            = $r->cantidad_producto_9 ?? null;
        $carrito->precio_producto_9              = $r->precio_producto_9 ?? null;
        $carrito->subtotal_producto_9            = $r->subtotal_producto_9 ?? null;
        $carrito->descuento_subtotal_producto_9  = $r->descuento_subtotal_producto_9 ?? null;
        
        $carrito->nombre_producto_10             = $r->nombre_producto_10 ?? null;
        $carrito->cantidad_producto_10           = $r->cantidad_producto_10 ?? null;
        $carrito->precio_producto_10             = $r->precio_producto_10 ?? null;
        $carrito->subtotal_producto_10           = $r->subtotal_producto_10 ?? null;
        $carrito->descuento_subtotalp_roducto_10 = $r->descuento_subtotalp_roducto_10 ?? null;
        
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
