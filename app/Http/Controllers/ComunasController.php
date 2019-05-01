<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comuna;

class ComunasController extends Controller
{
    
    public function index()
    {
        $c = Comuna::All();
        return response()->json([
            'status' => true,
            'data'   => $c
        ]);
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
