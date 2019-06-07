<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Soporte;
use App\Mail\NuevoPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
    public function pedidos(){
        return view('aguaclean.pedidos');
    }
    public function index(){
        return view('aguaclean.index');
    }
    public function vsoporte(){
        return view('aguaclean.vsoporte');
    }
    public function soporte(Request $r, Soporte $s){
        $user = Auth::user();
        
        $soporte = new Soporte();
        $soporte->nombre_usuario = $user->name;
        $soporte->mensaje = $r->mensaje;
        $soporte->save();

        Mail::to('gerardo.ruiz.spa@gmail.com')->bcc('gerardo@mobilechile.app')
        ->bcc('jose@mobilechile.app')->queue(new Soportes($user, $pedido));

        return back()->with('flash','Notificación enviada a los programadores');
    }
    
}
