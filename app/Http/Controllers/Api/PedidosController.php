<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pedido;
use App\User;
use Carbon\Carbon;

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
        'pedidos.id_comuna as id_comuna_from_pedido',
        'c.nombre as nombre_comuna',
        'u.direccion as user_direccion',
        'u.zona as user_zona',
        'u.cargo as user_cargo',
        'u.descuento as user_descuento',
        'u.celular as user_celular',
        'u.email as user_email',
        'u.name as user_name',
        'u.last_name as user_last_name',
        'estado_pago',
        'estado_despacho',
        'medio_de_pago',
        'total_pago',
        'detalle_productos',
        'horario_recepcion',
        'fecha_recepcion'
        )->get();

        return response()->json($pedidos);
    }
    public function pedidos_sin_conductor_asignado()
    {
        $pedidos = Pedido::where('id_conductor',null)->where('estado_despacho','SIN ASIGNAR')->get();

        return response()->json($pedidos);
    }
    public function conductores_disponibles_hoy()
    {
        $limite = 32;
        // id_conductor where total de pedidos < 33
        $today = Carbon::today()->format('Y-m-d');
        // dd($today);
        
        $msg = '';
        $conductores_copados = [];
        $conductores = User::where('role_id','4')->get();
        $conductores_ids = $conductores->pluck('id')->toArray();
        foreach($conductores as $conductor){
            $pedidos = Pedido::where('id_conductor','=',$conductor->id)
            ->where('fecha_recepcion',$today)
            ->get();
            if($pedidos->count()>=$limite){
                \Log::info("Límite de pedidos $limite alcanzado para el conductor $conductor->name");
                $msg =$msg." Límite de pedidos $limite alcanzado para el conductor $conductor->name. ";
                array_push($conductores_copados,$conductor->id);
            }
        }
        $conductores_disponibles = Pedido::join('users as u','id_conductor','=','u.id')
            ->where('fecha_recepcion',$today)
            ->whereIn('u.id',$conductores_ids)
            ->whereNotIn('u.id',$conductores_copados)
            ->select('u.id','name','last_name','celular','avatar')
            ->distinct()
            ->get();
        

        return response()->json(["conductores_disponibles"=>$conductores_disponibles,
            "msg"=>$msg
        ]);
    }
    public function conductores_disponibles($fecha)
    {   
        //fecha en formato Y-m-d

        $limite = 32;
        
        $msg = '';
        $conductores_copados = [];
        $conductores = User::where('role_id','4')->get();
        $conductores_ids = $conductores->pluck('id')->toArray();
        foreach($conductores as $conductor){
            $pedidos = Pedido::where('id_conductor','=',$conductor->id)
            ->where('fecha_recepcion',$fecha)
            ->get();
            if($pedidos->count()>=$limite){
                \Log::info("Límite de pedidos $limite alcanzado para el conductor $conductor->name");
                $msg =$msg." Límite de pedidos $limite alcanzado para el conductor $conductor->name. ";
                array_push($conductores_copados,$conductor->id);
            }
        }
        $conductores_disponibles = Pedido::join('users as u','id_conductor','=','u.id')
            ->where('fecha_recepcion',$fecha)
            ->whereIn('u.id',$conductores_ids)
            ->whereNotIn('u.id',$conductores_copados)
            ->select('u.id','name','last_name','celular','avatar')
            ->distinct()
            ->get();
        

        return response()->json(["conductores_disponibles"=>$conductores_disponibles,
            "msg"=>$msg
        ]);
    }
    public function conductor_asignado(){
        $conductor = Pedido::join('Users as u','id_conductor','=','u.id')->select(
        'u.direccion',
        'u.celular',
        'u.email',
        'u.name',
        'u.last_name',
        'estado_despacho',
        'medio_de_pago',
        'total_pago',
        'detalle_productos',
        'horario_recepcion',
        'fecha_recepcion',
        'notas')
        ->get();
        return response()->json($conductor);
    }
    public function auto_asignacion_de_pedidos_aleatoria($fecha){
        $pedidos_no_asignados = Pedido::where('id_conductor',null)->get();
        $limite               = 32;
        $msg                  = '';
        $conductores_copados  = [];
        $conductores          = User  ::where('role_id','4')->get();
        $conductores_ids      = $conductores->pluck('id')->toArray();
        foreach($conductores as $conductor){
            $pedidos = Pedido::where('id_conductor','=',$conductor->id)
            ->where('fecha_recepcion',$fecha)
            ->get();
            if($pedidos->count()>=$limite){
                \Log::info("Límite de pedidos $limite alcanzado para el conductor $conductor->name");
                $msg =$msg." Límite de pedidos $limite alcanzado para el conductor $conductor->name. ";
                array_push($conductores_copados,$conductor->id);
            }
        }
        $conductores_disponibles = Pedido::join('users as u','id_conductor','=','u.id')
            ->where('fecha_recepcion',$fecha)
            ->whereIn('u.id',$conductores_ids)
            ->whereNotIn('u.id',$conductores_copados)
            ->select('u.id','name','last_name','celular','avatar')
            ->distinct()
            ->get();
        $conductores_disponibles_ids = $conductores_disponibles->pluck('id')->toArray();
        foreach($pedidos as $pedido){
            $pedido->id_conductor = random($conductores_disponibles_ids);
        }

    }
    public function auto_asignacion_de_pedidos_por_zona_o_comuna($fecha){
        $pedidos_no_asignados = Pedido::where('id_conductor',null)->get();
        $limite               = 32;
        $total_para_viajar    = 9500;
        $envio_pedidos_minimo = 5;
        $msg                  = '';
        $conductores_copados  = [];
        $conductores          = User  ::where('role_id','4')->get();
        $conductores_ids      = $conductores->pluck('id')->toArray();
        foreach($conductores as $conductor){
            $pedidos = Pedido::where('id_conductor','=',$conductor->id)
            ->where('fecha_recepcion',$fecha)
            ->get();
            if($pedidos->count()>=$limite){
                \Log::info("Límite de pedidos $limite alcanzado para el conductor $conductor->name");
                $msg =$msg." Límite de pedidos $limite alcanzado para el conductor $conductor->name. ";
                array_push($conductores_copados,$conductor->id);
            }
        }
        $conductores_disponibles = Pedido::join('users as u','id_conductor','=','u.id')
            ->where('fecha_recepcion',$fecha)
            ->whereIn('u.id',$conductores_ids)
            ->whereNotIn('u.id',$conductores_copados)
            ->select('u.id as id','name','last_name','celular','avatar')
            ->distinct()
            ->get();
        // $conductores_disponibles_ids = $conductores_disponibles->pluck('id')->toArray();
        $comunas = Comuna::where('se_cubre','1')->get();

        foreach($comunas as $comuna){
            //contar los pedidos en cada comuna para asignarlos a un día en específico
            $pedidos_cercanos = Pedido::where('id_conductor',null)
            ->where('fecha_recepcion',$fecha)
            ->join('comunas as c','id_comuna','=',$comuna->id)
            ->where('c.cargo_por_producto','<=','100')
            ->get();
            foreach($pedidos_cercanos as $pedido_c){
                foreach($conductores_disponibles as $conductor){
                    $pedidos_por_conductor = Pedido::where('id_conductor',$conductor->id)->get()->count();
                    if($pedidos_por_conductor <= 32){
                        $pedido_c->id_conductor = $conductor->id;
                        $pedido_c->save();
                    }
                }
            }

            $pedidos_lejanos = Pedido::where('id_conductor',null)
            ->where('fecha_recepcion',$fecha)
            ->join('comunas as c','id_comuna','=',$comuna->id)
            ->where('c.cargo_por_producto','>','100')
            ->where('total_pago','>',$total_para_viajar)
            ->get();
            foreach($pedidos_lejanos as $pedido_l){
                foreach($conductores_disponibles as $conductor){
                    $pedidos_por_conductor = Pedido::where('id_conductor',$conductor->id)->get()->count();
                    if($pedidos_por_conductor <= 32){
                        $pedido_l->id_conductor = $conductor->id;
                        $pedido_l->save();
                    }
                }
            }

            $pedidos_lejanos_acumulados = Pedido::where('id_conductor',null)
            ->where('fecha_recepcion',$fecha)
            ->join('comunas as c','id_comuna','=',$comuna->id)
            ->where('c.cargo_por_producto','>','100')
            ->select('total_pago')
            ->whereRaw('SUM(total_pago)','>',$total_para_viajar)
            ->get();

            dd($pedidos_lejanos_acumulados);
            foreach($pedidos_lejanos as $pedido_l){
                foreach($conductores_disponibles as $conductor){
                    $pedidos_por_conductor = Pedido::where('id_conductor',$conductor->id)->get()->count();
                    if($pedidos_por_conductor <= 32){
                        $pedido_l->id_conductor = $conductor->id;
                        $pedido_l->save();
                    }
                }
            }

            // aqui asigno
            foreach($pedidos as $pedido){
                    if($pedido > $envio_pedidos_minimo){
    
                    // Antes de la asignacion, verificar que el conductor no tiene más de 32 pedidos
                    foreach($conductores_disponibles as $conductor){

                        $pedidos_por_conductor = Pedido::where('id_conductor',$conductor->id)->get()->count();

                        if($pedidos_por_conductor <= 32){

                            $pedido->id_conductor = $conductor->id;
                        }
                    }
    
                }
            }


        }

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
        $pedido->estado_pago       = $r->estado_pago;
        $pedido->estado_despacho   = $r->estado_despacho;
        $pedido->medio_de_pago     = $r->medio_de_pago;
        $pedido->total_pago        = $r->total_pago;
        $pedido->detalle_productos = $r->detalle_productos;
        $pedido->horario_recepcion = $r->horario_recepcion;
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
