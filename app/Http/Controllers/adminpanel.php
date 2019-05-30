<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminpanel extends Controller
{
    public function usuarios(){
        return view('aguaclean.usuarios');
    }
    public function productos(){
        return view('aguaclean.productos');
    }
    public function comunas(){
        return view('aguaclean.comunas');
    }
    public function index(){
        return view('aguaclean.index');
    }
}
