<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminpanel extends Controller
{
    public function usuarios(){
        return view('aguaclean.usuarios');
    }
    public function index(){
        return view('aguaclean.index');
    }
}
