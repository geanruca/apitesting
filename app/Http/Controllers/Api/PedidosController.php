<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Comuna;
use App\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::join('users as u','id_usuario','=','u.id')
        ->join('comunas as c','c.id','pedidos.id_comuna')
        ->select(
            'pedidos.id as id_pedido',
            'u.id as id_usuario',
            'pedidos.id_conductor as id_conductor',
            'pedidos.id_comuna as id_comuna_from_pedido',
            'c.nombre as nombre_comuna',
            'u.direccion as user_direccion',
            'u.zona as user_zona',
            'u.cargo as user_cargo',
            'u.descuento as user_descuento',
            'u.celular as user_celular',
            'u.email as user_email',
            'u.name as user_name',
            'estado_pago',
            'estado_despacho',
            'medio_de_pago',
            'total_pago',
            'detalle_productos',
            'horario_recepcion',
            'fecha_recepcion'
        )->orderBy('id_pedido','desc')
        ->get();

        return response()->json($pedidos);
    }
    public function pedidos_sin_conductor_asignado()
    {
        $pedidos = Pedido::where('id_conductor',null)->where('estado_despacho','SIN ASIGNAR')->get();

        return response()->json($pedidos);
    }
    public function pedidos_por_conductor_y_fecha($id_conductor,$fecha,$estado)
    {
        $pedidos = Pedido::where('id_conductor',$id_conductor)
        ->join('comunas as c','pedidos.id_comuna','=','c.id')
        ->leftJoin('users as u','u.id','=','pedidos.id_usuario')
        ->where('estado_despacho',$estado)
        ->where('fecha_recepcion',$fecha)
        ->orderBy('pedidos.id_comuna','desc')
        ->orderBy('c.id','desc')
        ->select(
            'c.nombre as nombre_comuna',
            'u.name as user_name',
            'u.celular as user_celular',
            'u.email as user_email',
            'u.direccion',
            'pedidos.id as id_pedido',
            'pedidos.id_conductor',
            'pedidos.notas as notas_pedido',
            'pedidos.estado_pago',
            'pedidos.estado_despacho',
            'pedidos.medio_de_pago',
            'pedidos.total_pago',
            'pedidos.detalle_productos',
            'pedidos.horario_recepcion',
            'pedidos.fecha_recepcion'
            )
            ->get();

        return response()->json($pedidos);
    }
    public function conductores_disponibles_hoy()
    {
        $limite = 32;
        $today  = Carbon::today()->format('Y-m-d');
        $conductores_disponibles = User::ConductoresDisponiblesPorFecha($today,$limite);       
        return response()->json($conductores_disponibles);
    }
    public function conductores_disponibles_por_fecha($fecha)
    {   
        $conductores_disponibles = User::ConductoresDisponiblesPorFecha($fecha);

        return response()->json($conductores_disponibles);
    }
    public function conductor_asignado($id_pedido){
        $conductor = Pedido::join('users as u','id_conductor','=','u.id')
        ->where('pedidos.id',$id_pedido)
        ->select('pedidos.id_conductor as id_conductor','u.name as nombre','u.celular')
        ->first();

        return response()->json($conductor);
    }
    public function asignacion_manual($id_pedido,$id_conductor){
        $pedido = Pedido::find($id_pedido);
        $pedido->id_conductor = $id_conductor;
        $pedido->save();

        return response()->json($conductor);
    }
    
    public function auto_asignacion_de_pedidos_por_fecha($fecha){
        $pedidos_no_asignados = Pedido::where('id_conductor',null)->get();
        $limite               = 32;
        $total_para_viajar    = 9500;
        $envio_pedidos_minimo = 5;
        $msg                  = '';
        $conductores_copados  = [];
        $conductores          = User::where('role_id','3')->get();
        $conductores_ids      = $conductores->pluck('id')->toArray();

        foreach($conductores as $conductor){

            $pedidos_ya_asignados = Pedido::where('id_conductor','=',$conductor->id)
            ->whereIn('estado_despacho',['ENTREGADO','EN CAMINO','RECHAZADO','ASIGNADO'])
            ->where('fecha_recepcion',$fecha)
            ->get();
            if($pedidos_ya_asignados->count()>=$limite){
                \Log::info("Límite de pedidos $limite alcanzado para el conductor $conductor->name");
                $msg =$msg." Límite de pedidos $limite alcanzado para el conductor $conductor->name. ";
                array_push($conductores_copados,$conductor->id);
            }
        }

        // Conductores disponibles para ser asignados
        $conductores_disponibles = User::ConductoresDisponiblesPorFecha($fecha);
        $conductores_disponibles_ids = $conductores_disponibles->pluck('id_conductor')->toArray();
        $comunas = Comuna::where('se_cubre','1')->get();
        // dd($comunas);

        // Pedidos no asignados
        //contar los pedidos en cada comuna para asignarlos a un día en específico
        $pedidos_cercanos = Pedido::where('id_conductor',null)
        ->where('fecha_recepcion',$fecha)
        ->join('comunas as c','pedidos.id_comuna','=','c.id')
        ->whereIn('estado_despacho',['PENDIENTE','SIN ASIGNAR'])
        ->where('c.cargo_por_producto','<=',100)
        ->orderBy('c.id','desc')
        ->get();
        // dd($pedidos_cercanos);

        foreach($pedidos_cercanos as $pedido_c){
            foreach($conductores_disponibles as $conductor){
                $pedidos_por_conductor = Pedido::where('id_conductor',$conductor->id)->where('fecha_recepcion',$fecha)->whereIn('estado_despacho',['ENTREGADO','EN CAMINO','ASIGNADO'])->get()->count();
                // dd($pedidos_por_conductor);
                if($pedidos_por_conductor <= 32){
                    $pedido_c->id_conductor = $conductor->id;
                    $pedido_c->estado_despacho = 'ASIGNADO';
                    $pedido_c->save();
                    // dd('pedido cercanos asignados');
                }else{
                    \Log::info("Limite de asignaciones alcanzado para el $conductor->name");
                }
            }
        }
        // dd('pedidos cercanos asignados');

        $pedidos_lejanos = Pedido::where('id_conductor',null)
        ->where('fecha_recepcion',$fecha)
        ->join('comunas as c','pedidos.id_comuna','=','c.id')
        ->whereIn('estado_despacho',['PENDIENTE','SIN ASIGNAR'])
        ->where('c.cargo_por_producto','>',100)
        ->whereOr('total_pago','>',$total_para_viajar)
        ->get();

        foreach($pedidos_lejanos as $pedido_l){
            foreach($conductores_disponibles as $conductor){
                $pedidos_por_conductor = Pedido::where('id_conductor',$conductor->id)->whereIn('estado_despacho',['ENTREGADO','EN CAMINO','ASIGNADO'])->where('fecha_recepcion',$fecha)->get()->count();
                if($pedidos_por_conductor <= 32){
                    $pedido_l->id_conductor = $conductor->id;
                    $pedido_l->estado_despacho = 'ASIGNADO';
                    $pedido_l->save();
                }else{
                    \Log::info("Limite de asignaciones alcanzado para el $conductor->name");
                }
            }
        }

        $pendientes=Pedido::where('fecha_recepcion',$fecha)->whereIn('estado_despacho',['PENDIENTE','SIN ASIGNAR'])->where('id_conductor',null)->get();
        $cantidad = $pendientes->count();

        if($cantidad >= 1){
            return response()->json([
                'msg'=>"$cantidad envios pendientes para el $fecha, necesita contratar mas conductores"
            ]);
        }else{
            return response()->json([
                'msg'=>"$cantidad envios pendientes para el $fecha. Buen trabajo"
            ]);
        }

    }
    public function auto_asignacion_por_fecha_y_comuna($comuna, $fecha){

    }
    public function dias_de_despacho_por_comuna(){
        // vitacura = solo los sabados -> autoasignacion por zona o comuna -> vitacura los sabado
    }
    



    public function store(Request $r)
    {
        $pedido = new Pedido();
        $pedido->estado_pago       = $r->estado_pago;
        $pedido->estado_despacho   = $r->estado_despacho;
        $pedido->medio_de_pago     = $r->medio_de_pago;
        $pedido->total_pago        = $r->total_pago;
        $pedido->detalle_productos = $r->detalle_productos;
        $pedido->horario_recepcion = $r->horario_recepcion;
        $pedido->fecha_recepcion   = $r->fecha_recepcion;
        $pedido->notas             = $r->notas;
        
        $pedido->id_usuario        = $r->id_usuario;
        $pedido->id_comuna         = $r->id_comuna;
        $pedido->id_conductor      = $r->id_conductor;
        $pedido->save();


        return response()->json([
            "status"=>true,
            "data"=>"Pedido guardado"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $a = Pedido::find($id);

        return response()->json([
            "status"=>true,
            "data"=>$a
        ]); 
    }

    public function update(Request $r, $id)
    {
        $pedido = Pedido::find($id);
        $pedido->estado_pago       = $r->estado_pago       ?? $pedido->estado_pago;
        $pedido->estado_despacho   = $r->estado_despacho   ?? $pedido->estado_despacho;
        $pedido->medio_de_pago     = $r->medio_de_pago     ?? $pedido->medio_de_pago;
        $pedido->total_pago        = $r->total_pago        ?? $pedido->total_pago;
        $pedido->detalle_productos = $r->detalle_productos ?? $pedido->detalle_productos;
        $pedido->horario_recepcion = $r->horario_recepcion ?? $pedido->horario_recepcion;
        $pedido->notas             = $r->notas             ?? $pedido->notas;
        $pedido->id_usuario        = $r->id_usuario        ?? $pedido->id_usuario;
        $pedido->id_comuna         = $r->id_comuna         ?? $pedido->id_comuna;
        $pedido->id_conductor      = $r->id_conductor      ?? $pedido->id_conductor;
        $pedido->save();

        return response()->json([
            "status"=>true,
            "data"=>"Pedido guardado"
        ]);
    }

    
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
        return response()->json([
            "status"=>true,
            "data"=>"Pedido borrado"
        ]);
    }

}
