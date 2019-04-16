<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $users = User::All(); 
            return response()->json(['success' => $users], 200); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id); 
            return response()->json(['success' => $user], 200); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id); 

        $user->role_id           = $request->role_id;
        $user->name              = $request->name;
        $user->last_name         = $request->last_name;
        $user->email             = $request->email;
        $user->avatar            = $request->avatar;
        $user->email_verified_at = $request->email_verified_at;
        $user->rut               = $request->rut;
        $user->celular           = $request->celular;
        $user->direccion         = $request->direccion;
        $user->notas             = $request->notas;
        $user->api_token         = $request->api_token;
        $user->id_comuna         = $request->id_comuna;
        $user->zona              = $request->zona;
        $user->save();
        return response()->json(['success' => $user], 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return response()->json(['success' => "Usuario eliminado"], 200); 
    }
}
