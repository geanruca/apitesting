<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        

        return response()->json([
            'status'=>true,
            'msg'=>"hola"
        ]);
    }

    public function store(Request $r)
    {
        $producto = new Producto;
        $producto->nombre         = $r->nombre;
        $producto->descripcion    = $r->descripcion;
        $producto->precio_inicial = $r->precio_inicial;
        // $producto->imagen      = $r->imagen;
        $producto->imagen         = $r->file('imagen')->store('productos','public');

        $producto->save();
        return response()->json([
            'status'=>true,
            'msg'=>"Producto agregado"
        ]);
    }

    
    public function show($id)
    {
       $producto = Producto::findOrFail($id);

       return response()->json([
            'status'=>true,
            'msg'=>$producto
        ]);
    }

    
    public function update(Request $r, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->nombre         = $r->nombre;
        $producto->descripcion    = $r->descripcion;
        $producto->precio_inicial = $r->precio_inicial;

        $producto->imagen         = $r->imagen;

        return response()->json([
            'status'=>true,
            'msg'=>"Producto editado"
        ]);
    }

    
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return response()->json([
            'status'=>true,
            'msg'=>"Producto eliminado"
        ]);
    }
}
