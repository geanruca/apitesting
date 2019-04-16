<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Empresa::All();

        return response()->json([
            'status'=>true,
            'msg'=>$data
        ]);
    }

 
    public function store(Request $r)
    {
        $Empresa = new Empresa;
        $Empresa->nombre         = $r->nombre;

        $Empresa->logo         = $r->logo;

        return response()->json([
            'status'=>true,
            'msg'=>"Empresa agregada"
        ]);
    }

    public function show($id)
    {
        $a=Empresa::findOrFail($id);
        return response()->json([
            'status'=>true,
            'msg'=>$a
        ]); 
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $r, $id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->nombre         = $r->nombre;
        $empresa->imagen         = $r->logo;

        return response()->json([
            'status'=>true,
            'msg'=>"Empresa editada"
        ]);
    }


    public function destroy($id)
    {
        $a = Empresa::findOrFail($id);
        $a->delete();

        return response()->json([
            'status'=>true,
            'msg'=>"Empresa eliminada"
        ]);
    }
}
