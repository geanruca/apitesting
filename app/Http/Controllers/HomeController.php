<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/aguaclean'); 
    }
    public function contacto(Request $r)
    {
        $contacto = new Contacto();
        $contacto->nombre = $r->nombre;
        $contacto->telefono = $r->telefono;
        $contacto->email = $r->email;
        $contacto->negocio = $r->negocio;
        $contacto->save();

        return back()->with('Te econtactaremos lo antes posible!');; 
    }
}
