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
        $a = Producto::select('id','nombre','descripcion','precio_inicial','img1','path1')->get();

        return response()->json($a);
    }

    public function store(Request $r)
    {

        // $user = Auth::user();
        // \Log::info('stored_product',[
        // 'user_id'        => 'aguaclean',
        // 'username'       => $user->name,
        // 'nombre'         => $r->nombre,
        // 'descripcion'    => $r->descripcion,
        // 'precio_inicial' => $r->precio_inicial,
        // ]);
        // $user = Auth::user();
        $producto = new Producto;
        $producto->nombre         = $r->nombre;
        $producto->descripcion    = $r->descripcion;
        $producto->precio_inicial = $r->precio_inicial;
        if($r->img1 <> null){
            $producto->img1 = $r->file('img1')->store('productos/'.'aguaclean','public');
            $url1                = Storage::url($producto->img1);
            $producto->path1     = $url1;
        }
        if($r->img2 <> null){
            $producto->img2 = $r->file('img2')->store('productos/'.'aguaclean','public');
            $url2                = Storage::url($producto->img2);
            $producto->path2     = $url2;
        }
        if($r->img3 <> null){
            $producto->img3 = $r->file('img3')->store('productos/'.'aguaclean','public');
            $url3                = Storage::url($producto->img3);
            $producto->path3     = $url3;
        }
        if($r->img4 <> null){
            $producto->img4 = $r->file('img4')->store('productos/'.'aguaclean','public');
            $url4                = Storage::url($producto->img4);
            $producto->path4     = $url4;
        }
        if($r->img5 <> null){
            $producto->img5 = $r->file('img5')->store('productos/'.'aguaclean','public');
            $url5                = Storage::url($producto->img5);
            $producto->path5     = $url5;
        }
        if($r->img6 <> null){
            $producto->img6 = $r->file('img6')->store('productos/'.'aguaclean','public');
            $url6                = Storage::url($producto->img6);
            $producto->path6     = $url6;
        }
        if($r->img7 <> null){
            $producto->img7 = $r->file('img7')->store('productos/'.'aguaclean','public');
            $url7                = Storage::url($producto->img7);
            $producto->path7     = $url7;
        }
        if($r->img8 <> null){
            $producto->img8 = $r->file('img8')->store('productos/'.'aguaclean','public');
            $url8                = Storage::url($producto->img8);
            $producto->path8     = $url8;
        }
        if($r->img8 <> null){
            $producto->img8 = $r->file('img8')->store('productos/'.'aguaclean','public');
            $url8                = Storage::url($producto->img8);
            $producto->path8     = $url8;
        }
        if($r->img9 <> null){
            $producto->img9 = $r->file('img9')->store('productos/'.'aguaclean','public');
            $url9                = Storage::url($producto->img9);
            $producto->path9     = $url9;
        }
        $producto->save();
        return response()->json([
            'status'=>true,
            'msg'=>"Uploaded"
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
        $producto->nombre         = $r->nombre ?? $producto->nombre;
        $producto->tallas         = $r->tallas ?? $producto->tallas;
        $producto->colores        = $r->colores ?? $producto->colores;
        $producto->descripcion    = $r->descripcion ?? $producto->descripcion;
        $producto->precio_inicial = $r->precio_inicial ?? $producto->precio_inicial;
        $producto->precio_actual  = $r->precio_actual ?? $producto->precio_actual;
        $producto->estado         = $r->estado ?? $producto->estado;
        $producto->notas          = $r->notas ?? $producto->notas;
        $producto->SKU            = $r->SKU ?? $producto->SKU;
        if($r->img1 <> null){
            $producto->img1 = $r->file('img1')->store('productos/'.'aguaclean','public');
            $url1                = Storage::url($producto->img1);
            $producto->path1     = $url1;
        }
        if($r->img2 <> null){
            $producto->img2 = $r->file('img2')->store('productos/'.'aguaclean','public');
            $url2                = Storage::url($producto->img2);
            $producto->path2     = $url2;
        }
        if($r->img3 <> null){
            $producto->img3 = $r->file('img3')->store('productos/'.'aguaclean','public');
            $url3                = Storage::url($producto->img3);
            $producto->path3     = $url3;
        }
        if($r->img4 <> null){
            $producto->img4 = $r->file('img4')->store('productos/'.'aguaclean','public');
            $url4                = Storage::url($producto->img4);
            $producto->path4     = $url4;
        }
        if($r->img5 <> null){
            $producto->img5 = $r->file('img5')->store('productos/'.'aguaclean','public');
            $url5                = Storage::url($producto->img5);
            $producto->path5     = $url5;
        }
        if($r->img6 <> null){
            $producto->img6 = $r->file('img6')->store('productos/'.'aguaclean','public');
            $url6                = Storage::url($producto->img6);
            $producto->path6     = $url6;
        }
        if($r->img7 <> null){
            $producto->img7 = $r->file('img7')->store('productos/'.'aguaclean','public');
            $url7                = Storage::url($producto->img7);
            $producto->path7     = $url7;
        }
        if($r->img8 <> null){
            $producto->img8 = $r->file('img8')->store('productos/'.'aguaclean','public');
            $url8                = Storage::url($producto->img8);
            $producto->path8     = $url8;
        }
        if($r->img8 <> null){
            $producto->img8 = $r->file('img8')->store('productos/'.'aguaclean','public');
            $url8                = Storage::url($producto->img8);
            $producto->path8     = $url8;
        }
        if($r->img9 <> null){
            $producto->img9 = $r->file('img9')->store('productos/'.'aguaclean','public');
            $url9                = Storage::url($producto->img9);
            $producto->path9     = $url9;
        }

        $producto->save();

        return response()->json([
            'status'=>true,
            'msg'=>"Producto actualizado"
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
