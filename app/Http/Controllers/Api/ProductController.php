<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Producto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 

class ProductController extends Controller
{
    public function index()
    {
        
        // $id_empresa = Auth::user()->id_empresa;
        // $data = User::All();

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
        $producto->id_empresa     = Auth::user()->id_empresa;

        $producto->imagen         = $r->imagen;

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
        $producto->id_empresa     = Auth::user()->id_empresa;

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
