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
        $nombre_producto             = $r->nombre_producto;        $cantidad_producto           = $r->cantidad_producto;
        $precio_producto             = $r->precio_producto;
        $subtotal_producto           = $r->subtotal_producto;
        $descuento_subtotal_producto = $r->descuento_subtotal_producto;

        $carrito->nombre_producto_1             = $nombre_producto[0] ?? null;
        $carrito->cantidad_producto_1           = $cantidad_producto[0] ?? null;
        $carrito->precio_producto_1             = $precio_producto[0] ?? null;
        $carrito->subtotal_producto_1           = $subtotal_producto[0] ?? null;
        $carrito->descuento_subtotal_producto_1 = $descuento_subtotal_producto[0] ?? null;
        
        

        $carrito->nombre_producto_2              = $nombre_producto[1] ?? null;
        $carrito->cantidad_producto_2            = $cantidad_producto[1] ?? null;
        $carrito->precio_producto_2              = $precio_producto[1] ?? null;
        $carrito->subtotal_producto_2            = $subtotal_producto[1] ?? null;
        $carrito->descuento_subtotal_producto_2  = $descuento_subtotal_producto[1] ?? null;

        $carrito->nombre_producto_3              = $nombre_producto[2] ?? null;
        $carrito->cantidad_producto_3            = $cantidad_producto[2] ?? null;
        $carrito->precio_producto_3              = $precio_producto[2] ?? null;
        $carrito->subtotal_producto_3            = $subtotal_producto[2] ?? null;
        $carrito->descuento_subtotal_producto_3  = $descuento_subtotal_producto[2] ?? null;

        $carrito->nombre_producto_4              = $nombre_producto[3] ?? null;
        $carrito->cantidad_producto_4            = $cantidad_producto[3] ?? null;
        $carrito->precio_producto_4              = $precio_producto[3] ?? null;
        $carrito->subtotal_producto_4            = $subtotal_producto[3] ?? null;
        $carrito->descuento_subtotal_producto_4  = $descuento_subtotal_producto[3] ?? null;

        $carrito->nombre_producto_5              = $nombre_producto[4] ?? null;
        $carrito->cantidad_producto_5            = $cantidad_producto[4] ?? null;
        $carrito->precio_producto_5              = $precio_producto[4] ?? null;
        $carrito->subtotal_producto_5            = $subtotal_producto[4] ?? null;
        $carrito->descuento_subtotal_producto_5  = $descuento_subtotal_producto[4] ?? null;

        $carrito->nombre_producto_6              = $nombre_producto[5] ?? null;
        $carrito->cantidad_producto_6            = $cantidad_producto[5] ?? null;
        $carrito->precio_producto_6              = $precio_producto[5] ?? null;
        $carrito->subtotal_producto_6            = $subtotal_producto[5] ?? null;
        $carrito->descuento_subtotal_producto_6  = $descuento_subtotal_producto[5] ?? null;

        $carrito->nombre_producto_7              = $nombre_producto[6] ?? null;
        $carrito->cantidad_producto_7            = $cantidad_producto[6] ?? null;
        $carrito->precio_producto_7              = $precio_producto[6] ?? null;
        $carrito->subtotal_producto_7            = $subtotal_producto[6] ?? null;
        $carrito->descuento_subtotal_producto_7  = $descuento_subtotal_producto[6] ?? null;

        $carrito->nombre_producto_8              = $nombre_producto[7] ?? null;
        $carrito->cantidad_producto_8            = $cantidad_producto[7] ?? null;
        $carrito->precio_producto_8              = $precio_producto[7] ?? null;
        $carrito->subtotal_producto_8            = $subtotal_producto[7] ?? null;
        $carrito->descuento_subtotal_producto_8  = $descuento_subtotal_producto[7] ?? null;
        
        $carrito->nombre_producto_9              = $nombre_producto[8] ?? null;
        $carrito->cantidad_producto_9            = $cantidad_producto[8] ?? null;
        $carrito->precio_producto_9              = $precio_producto[8] ?? null;
        $carrito->subtotal_producto_9            = $subtotal_producto[8] ?? null;
        $carrito->descuento_subtotal_producto_9  = $descuento_subtotal_producto[8] ?? null;
        
        $carrito->nombre_producto_10             = $nombre_producto[9] ?? null;
        $carrito->cantidad_producto_10           = $cantidad_producto[9] ?? null;
        $carrito->precio_producto_10             = $precio_producto[9] ?? null;
        $carrito->subtotal_producto_10           = $subtotal_producto[9] ?? null;
        $carrito->descuento_subtotalp_roducto_10 = $r->descuento_subtotalp_roducto[9] ?? null;
        
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
