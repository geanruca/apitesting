<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comuna;

class ComunasController extends Controller
{
    
    public function index()
    {
        $c = Comuna::select('id','nombre','pedido_minimo','dias_de_despacho','cargo_por_producto')->get();
        return response()->json($c);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
