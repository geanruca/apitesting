<?php

namespace App\Http\Controllers;

use App\Soporte;
use App\Contacto;
use App\Mail\EmailSoporte;
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
        
        \Log::notice('Nuevo cliente. Preparen las nalgas. Revisen su email');
        \Log::notice($contacto);

        Mail::to('jose.riquelme@mobilechile.app')
            ->bcc('gerardo.ruiz@mobilechile.app')
            ->queue(new NuevoCliente($contacto,$otros));

        return back()->with('flash','Muchas gracias. Te contactamos enseguida');
    }

    public function contacto_soporte(Request $r)
    {
        $soporte = new Contacto;
        $soporte->nombre   = $r->nombre;
        $soporte->telefono = $r->telefono;
        $soporte->email    = $r->email;
        $soporte->negocio  = $r->mensaje;
        $soporte->save();
        
        
        \Log::notice('Nuevo ticket de Soporte. Preparen las nalgas. Revisen su email');
        \Log::notice($soporte);

        Mail::to('jose.riquelme@mobilechile.app')
            ->bcc('gerardo.ruiz@mobilechile.app')
            ->bcc($soporte->email)
            ->queue(new EmailSoporte($soporte));

        return back()->with('flash','Muchas gracias. Te contactamos enseguida');
    }

    public function vista_soporte(){
        return view('mobilechile.soporte');
    }
    public function terminosycondiciones(){
        return view('mobilechile.terminosycondiciones');
    }

    public function contactos(){

        $c = Contacto::All();
        
        return response()->json($c);
    }
    public function vista_contactos(){

        $c = Contacto::All();
        
        return view('mobilechile.contactos',[
            'c'=>$c
        ]);
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
