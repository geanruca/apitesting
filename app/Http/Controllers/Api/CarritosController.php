<?php

namespace App\Http\Controllers\Api;

use App\Carrito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CarritosController extends Controller
{
    public function total($id_usuario){
        $todos = Carrito::where('id_usuario',$id_usuario)->select('subtotal_producto')->get();
        $total = 0;
        foreach ($todos as $key => $t) {
            $total = $total + $t->subtotal_producto;
        }
        return response()->json($total);

    }
    public function carrito_contador($id_usuario){
        $user = Auth::user();
        $c = Carrito::where('id_usuario',$id_usuario)->get();
        $cantidad = $c->count();

        return response()->json($cantidad);
    }

    public function store(Request $r){
        \Log::info('store_carrito',[$r->all()]);
        $c = new Carrito();
        $c->id_usuario        = $r->id_usuario;
        $c->id_producto       = $r->id_producto ?? $c->id_producto;
        $c->nombre_producto   = $r->nombre_producto ?? $c->nombre_producto;
        $c->cantidad_producto = $r->cantidad_producto ?? $c->cantidad_producto;
        $c->precio_producto   = $r->precio_producto ?? $c->precio_producto;
        $c->subtotal_producto = $r->subtotal_producto ?? $c->subtotal_producto;
        $c->save();
        return response()->json('Carrito guardado');
    }
    public function update(Request $r,$id_carrito){
        \Log::info('store_carrito',[$r->all()]);
        $c = Carrito::find($id_carrito);
        $c->id_usuario        = $r->id_usuario;
        $c->id_producto       = $r->id_producto ?? $c->id_producto;
        $c->nombre_producto   = $r->nombre_producto ?? $c->nombre_producto;
        $c->cantidad_producto = $r->cantidad_producto ?? $c->cantidad_producto;
        $c->precio_producto   = $r->precio_producto ?? $c->precio_producto;
        $c->subtotal_producto = $r->subtotal_producto ?? $c->subtotal_producto;
        $c->save();
        return response()->json('Carrito guardado');
    }

    public function show($id_usuario){
        $c = Carrito::where('id_usuario',$id_usuario)->get();
        return response()->json($c);
    }

    public function delete($id_usuario){
        $c = Carrito::where('id_usuario',$id_usuario)->get();
        foreach($c as $carrito){
            $carrito->delete();

        }
    
        return response()->json('Carrito eliminado');
    }
    public function delete_producto($id_carrito){
        $c = Carrito::find($id_carrito);
        $c->delete();
        return response()->json('Carrito eliminado');
    }
    public function comprados(Carrito $c){
        $c->onlyTrashed()->where('id','<>','0')->get();
        return response()->json($c);
    }
    public function deseados(){
        $deseados = Carrito::All();
        return response()->json($deseados);
    }
}
