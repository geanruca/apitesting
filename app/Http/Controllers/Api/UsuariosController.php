<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Comuna;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
{
 
    public function index()
    {
            $users = User::join('comunas as c','users.id_comuna','=','c.id')
            ->select('users.zona','users.name','users.id','users.celular','users.descuento','users.direccion','users.notas','users.role_id','c.nombre as comuna')
            ->orderBy('users.name','asc')
            ->get(); 
            return response()->json($users, 200); 
    }

    public function sacar_descuento_personal($celular){
            $descuento = User::where('celular', $celular)->select('descuento')->first();

            return response()->json($descuento, 200); 
    }




    public function store(Request $request)
    {
    }


    public function show($id)
    {
        $user = User::find($id); 
        return response()->json(['success' => $user], 200); 
    }


    public function update(Request $r, $id)
    {
        $r->validate([
            'descuento'=>'numeric',
        ]);
        $user = User::findOrFail($id);
        if($r->comuna){
            $comuna = Comuna::where('nombre', $r->comuna)->first();
            if(!$comuna){
                $comuna = new Comuna();
                $comuna->nombre   = $r->comuna;
                $comuna->se_cubre = 1;
                $comuna->save();
            }
        }
        
        $user->name      = $r->name           ?? $user->name;
        $user->role_id   = $r->role_id        ?? $user->role_id;
        $user->last_name = $r->last_name      ?? $user->last_name;
        $user->email     = $r->email          ?? $user->email;
        $user->avatar    = $r->avatar         ?? $user->avatar;
        $user->celular   = $r->celular        ?? $user->celular;
        $user->direccion = $r->direccion      ?? $user->direccion;
        $user->notas     = $r->notas          ?? $user->notas;
        $user->id_comuna = $r->id_comuna      ?? $comuna->id;
        $user->zona      = $r->zona           ?? $user->zona;
        $user->descuento = $r->descuento      ?? $user->descuento;
        $user->save();
        
        return response()->json(['success' => $user], 200); 
    }


    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return response()->json(['success' => "Usuario eliminado"], 200); 
    }
}
