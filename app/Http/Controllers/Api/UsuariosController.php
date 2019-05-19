<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
{
 
    public function index()
    {
            $users = User::join('comunas as c','users.id_comuna','=','c.id')
            ->select('users.zona','users.name','users.id','users.celular','users.descuento','users.email','users.direccion','users.notas','users.role_id','c.nombre as comuna')
            ->get(); 
            return response()->json($users, 200); 
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // $user->role_id           = $request->role_id;
        // $user->name              = $request->name;
        // $user->last_name         = $request->last_name;
        // $user->email             = $request->email;
        // $user->avatar            = $request->avatar;
        // $user->email_verified_at = $request->email_verified_at;
        // $user->rut               = $request->rut;
        // $user->celular           = $request->celular;
        // $user->direccion         = $request->direccion;
        // $user->notas             = $request->notas;
        // $user->api_token         = $request->api_token;
        // $user->id_comuna         = $request->id_comuna;
        // $user->zona              = $request->zona;
        // $user->save();
        // return response()->json(['success' => $user], 200); 
    }


    public function show($id)
    {
        $user = User::find($id); 
        return response()->json(['success' => $user], 200); 
    }


    public function update(Request $request, $id)
    {
        // dd($request->name);
        $user = User::findOrFail($id); 
        $user->name              = $request->name ?? $user->name;
        $user->role_id           = $request->role_id ?? $user->role_id;
        $user->last_name         = $request->last_name ?? $user->last_name;
        $user->email             = $request->email ?? $user->email;
        $user->avatar            = $request->avatar ?? $user->avatar;
        $user->celular           = $request->celular ?? $user->celular;
        $user->direccion         = $request->direccion ?? $user->direccion;
        $user->notas             = $request->notas ?? $user->notas;
        $user->id_comuna         = $request->id_comuna ?? $user->id_comuna;
        $user->zona              = $request->zona ?? $user->zona;
        $user->save();
        
        return response()->json(['success' => $user], 200); 
    }


    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return response()->json(['success' => "Usuario eliminado"], 200); 
    }
}
