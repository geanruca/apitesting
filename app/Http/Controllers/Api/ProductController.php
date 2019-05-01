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
        $a = Producto::All();

        return response()->json($a);
    }

    public function store(Request $r)
    {
        $user = Auth::user();
        $producto = new Producto;
        $producto->nombre         = $r->nombre;
        $producto->descripcion    = $r->descripcion;
        $producto->precio_inicial = $r->precio_inicial;
        // $producto->imagen      = $r->imagen;
        $producto->imagenes         = $r->file('imagenes')->store('productos/'.$user->id,'public');
        $url = Storage::url($producto->imagenes);
        $producto->path = $url;
        $producto->save();
        return response()->json([
            'status'=>true,
            'msg'=>"Uloaded to the URL: $url"
        ]);
    }

    
    public function show($id)
    {
       $producto = Producto::findOrFail($id);

       return response()->json($producto);
    }

    
    public function update(Request $r, $id)
    {
        $producto                 = Producto::findOrFail($id);
        $producto->nombre         = $r->nombre;
        $producto->tallas         = $r->tallas;
        $producto->colores        = $r->colores;
        $producto->descripcion    = $r->descripcion;
        $producto->precio_inicial = $r->precio_inicial;
        $producto->precio_actual  = $r->precio_actual;
        $producto->estado         = $r->estado;
        $producto->notas          = $r->notas;
        $producto->SKU            = $r->SKU;
        $producto->imagenes       = $r->file('imagenes')->store('productos/'.$user->id,'public');
        $url                      = Storage ::url($producto->imagenes);
        $producto->path           = $url;
        $producto->save();

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
