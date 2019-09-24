<?php

namespace App\Http\Controllers;

use App\Contacto;
use App\Mail\NuevoCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
        $contacto = new Contacto;
        $contacto->nombre   = $r->nombre;
        $contacto->telefono = $r->telefono;
        $contacto->email    = $r->email;
        $contacto->negocio  = $r->negocio;
        $contacto->save();
        $otros = Contacto::where('estado','contactar')->get();
        
        // \Log::notice('Nuevo cliente. Preparen las nalgas. Revisen su email');
        \Log::notice($contacto);

        // Mail::to('jose@mobilechile.app')
        //     ->bcc('gerardo@mobilechile.app')
        //     ->bcc('gero17.grc@gmail.com')
        //     ->bcc('catalinaaruiz.13@gmail.com')
        //     ->queue(new NuevoCliente($contacto,$otros));

        return back()->with('flash','Muchas gracias. Te contactamos enseguida');
    }

    public function contactos(){

        $c = Contacto::All();
        
        return response()->json($c);
    }

    public function contactado(Request $r, $id){
        $user               = Auth::user();
        $c                  = Contacto::find($id);
        $c->notas           = $r->notas;
        $c->estado          = $r->estado;
        $c->actualizado_por = $user->name;
        $c->save();

        return response()->json([
            'status' => true,
            'data'   => 'Muchas gracias por contactar a este cliente! Revisaremos sus notas y lo contactaremos'
            ]);
    }
}
