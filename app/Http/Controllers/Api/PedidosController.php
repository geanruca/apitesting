<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Mail\NuevoPedido;
use App\Comuna;
use App\Pedido;
use App\Carrito;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PedidosController extends Controller
{

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
                'u.descuento as user_descuento',
                'u.celular as user_celular',
                'u.email as user_email',
                'u.name as user_name',
                'estado_pago',
                'estado_despacho',
                'medio_de_pago',
                'total_pago',
                'detalle_productos',
                'horario_recepcion_inicio',
                'horario_recepcion_final',
                'fecha_recepcion'
            )->orderBy('id_pedido','desc')
            ->get();

        return response()->json($pedidos);
    }
    public function vista_de_pedidos(){
        $pedidos = Pedido::join('users as u','id_usuario','=','u.id')
            ->join('comunas as c','c.id','pedidos.id_comuna')
            // ->where('estado_despacho','=','ENTREGADO')
            ->select(
                'pedidos.id as id_pedido',
                'u.id as id_usuario',
                'pedidos.id_conductor as id_conductor',
                'pedidos.id_comuna as id_comuna_from_pedido',
                'c.nombre as nombre_comuna',
                'u.direccion as user_direccion',
                'u.zona as user_zona',
                'u.descuento as user_descuento',
                'u.celular as user_celular',
                'u.email as user_email',
                'u.name as user_name',
                'estado_pago',
                'estado_despacho',
                'medio_de_pago',
                'total_pago',
                'detalle_productos',
                'horario_recepcion_inicio',
                'horario_recepcion_final',
                'fecha_recepcion',
                'pedidos.notas as notas'
            )
            ->orderBy('fecha_recepcion','desc')
            ->orderBy('horario_recepcion_final','desc')
            ->orderBy('user_zona','desc')
            ->get();
        // $estados_de_despacho = Pedido::select('estado_despacho')->distinct()->pluck('estado_despacho')->toArray();
        // $estados_de_pago     = Pedido::select('estado_pago')->distinct()->pluck('estado_pago')->toArray();
        // $zonas               = User  ::select('zona')->distinct()->pluck('zona')->toArray();
            // falta crear la ruta
         return response()->json([
             'status'              => true,
             'pedidos'             => $pedidos,
            //  'zonas'               => $zonas,
            //  'estados_de_despacho' => $estados_de_despacho,
         ]);
    }
    

    public function hoy(){

        // dd('llego');
        $fecha = Carbon::now()->format('Y-m-d');
        // dd($fecha);
        $pedidos = Pedido::join('comunas as c','pedidos.id_comuna','=','c.id')
            ->leftJoin('users as u','u.id','=','pedidos.id_usuario')
            ->where('fecha_recepcion',$fecha)
            ->orderBy('u.zona','desc')
            ->orderBy('c.id','desc')
            ->select(
                'c.nombre as nombre_comuna',
                'u.name as user_name',
                'u.zona as user_zona',
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
                'pedidos.horario_recepcion_inicio',
                'pedidos.horario_recepcion_final',
                'pedidos.fecha_recepcion'
                )
                ->get();

        return response()->json([
            'status'=>true,
            'data'=>$pedidos
            
            ]);
    }

    

    public function asignacion_manual($id_pedido,$id_conductor){
        $pedido = Pedido::find($id_pedido);
        $pedido->id_conductor = $id_conductor;
        $pedido->save();

        return response()->json($conductor);
    }
    
    

    public function store(Request $r)
    {
        $conductor = User::where('role_id','3')->first();

        $pedido                           = new Pedido();
        $pedido->estado_pago              = $r->estado_pago;
        $pedido->estado_despacho          = $r->estado_despacho;
        $pedido->medio_de_pago            = $r->medio_de_pago;
        $pedido->total_pago               = $r->total_pago;
        $pedido->detalle_productos        = $r->detalle_productos;
        $pedido->horario_recepcion_inicio = $r->horario_recepcion_inicio;
        $pedido->horario_recepcion_final  = $r->horario_recepcion_final;
        $pedido->fecha_recepcion          = $r->fecha_recepcion;
        $pedido->notas                    = $r->notas;
        //comuna
        $pedido->id_comuna                = $r->id_comuna;

        $pedido->id_conductor             = $r->id_conductor ?? $conductor->id;
        
        $user            = User::where('celular', $r->celular)->first();
        if(!$user){
            $user            = new User();
        }
        $user->name      = $r->nombre;
        $user->direccion = $r->direccion;
        $user->celular   = $r->celular;
        $user->email     = $r->email;

        $user->save();

        $pedido->id_usuario = $user->id;
        $pedido->save();

        // Mail::to('gerardo.ruiz.spa@gmail.com')->bcc('gerardo@mobilechile.app')->queue(new NuevoPedido($user, $pedido));
        Mail::to('aguacleanrene@gmail.com')
            ->bcc('gerardo@mobilechile.app')
            ->queue(new NuevoPedido($user, $pedido));



        if($pedido->save()){
            $limpia_carro = Carrito::where('id_usuario',$user->id)->first();
            if($limpia_carro){
                $limpia_carro->delete();
            }
        }

        return response()->json([
            "status" => true,
            "data"   => "Pedido realizado"
        ]);
    }


    public function show($id)
    {
        $a = Pedido::find($id);

        return response()->json([
            "status" => true,
            "data"   => $a
        ]); 
    }

    public function graficos(){
        $Enero      = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-01-01','2019-01-31'])->get()->count();
        $Febrero    = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-02-01','2019-02-31'])->get()->count();
        $Marzo      = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-03-01','2019-03-31'])->get()->count();
        $Abril      = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-04-01','2019-04-31'])->get()->count();
        $Mayo       = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-05-01','2019-05-31'])->get()->count();
        $Junio      = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-06-01','2019-06-31'])->get()->count();
        $Julio      = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-07-01','2019-07-31'])->get()->count();
        $Agosto     = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-08-01','2019-08-31'])->get()->count();
        $Septiembre = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-09-01','2019-09-31'])->get()->count();
        $Octubre    = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-10-01','2019-10-31'])->get()->count();
        $Noviembre  = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-11-01','2019-11-31'])->get()->count();
        $Diciembre  = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-12-01','2019-12-31'])->get()->count();

        $MontoEnero      = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-01-01','2019-01-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoFebrero    = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-02-01','2019-02-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoMarzo      = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-03-01','2019-03-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoAbril      = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-04-01','2019-04-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoMayo       = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-05-01','2019-05-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoJunio      = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-06-01','2019-06-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoJulio      = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-07-01','2019-07-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoAgosto     = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-08-01','2019-08-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoSeptiembre = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-09-01','2019-09-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoOctubre    = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-10-01','2019-10-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoNoviembre  = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-11-01','2019-11-31'])
        ->select('total_pago')->get()->sum('total_pago');
        $MontoDiciembre  = Pedido::where('estado_pago','PAGADO')->whereBetween('fecha_recepcion',['2019-12-01','2019-12-31'])
        ->select('total_pago')->get()->sum('total_pago');
        
        return response()->json([
            'Enero'           => $Enero,
            'Febrero'         => $Febrero,
            'Marzo'           => $Marzo,
            'Abril'           => $Abril,
            'Mayo'            => $Mayo,
            'Junio'           => $Junio,
            'Julio'           => $Julio,
            'Agosto'          => $Agosto,
            'Septiembre'      => $Septiembre,
            'Octubre'         => $Octubre,
            'Noviembre'       => $Noviembre,
            'Diciembre'       => $Diciembre,
            'MontoEnero'      => $MontoEnero,
            'MontoFebrero'    => $MontoFebrero,
            'MontoMarzo'      => $MontoMarzo,
            'MontoAbril'      => $MontoAbril,
            'MontoMayo'       => $MontoMayo,
            'MontoJunio'      => $MontoJunio,
            'MontoJulio'      => $MontoJulio,
            'MontoAgosto'     => $MontoAgosto,
            'MontoSeptiembre' => $MontoSeptiembre,
            'MontoOctubre'    => $MontoOctubre,
            'MontoNoviembre'  => $MontoNoviembre,
            'MontoDiciembre'  => $MontoDiciembre

        ]);
    }


    public function update(Request $r, $id_pedido)
    {
        $pedido = Pedido::findOrFail($id_pedido);
        // dd($pedido);
        $user   = User  ::where('celular',$r->user_celular)->first();
        // $user->id_comuna = $r->id_comuna ?? $user->id_comuna;
        $comuna = Comuna::findOrFail($r->id_comuna)->first();
        if(!$comuna){
            $comuna = new Comuna();
        }
        $comuna->nombre = $r->nombre_comuna ?? $comuna->nombre_comuna;
        $comuna->save();
        // dd($user);
        if(!$user){
            $user = new User();
        }
        $user->direccion = $r->user_direccion ?? null;
        $user->zona      = $r->user_zona      ?? null;
        $user->descuento = $r->user_descuento ?? null;
        $user->celular   = $r->user_celular   ?? null;
        $user->email     = $r->user_email     ?? null;
        $user->name      = $r->user_name      ?? null;
        // dd($user);
        $user->save();

        $pedido->estado_pago              = $r->estado_pago              ?? $pedido->estado_pago;
        $pedido->estado_despacho          = $r->estado_despacho          ?? $pedido->estado_despacho;
        $pedido->medio_de_pago            = $r->medio_de_pago            ?? $pedido->medio_de_pago;
        $pedido->total_pago               = $r->total_pago               ?? $pedido->total_pago;
        $pedido->detalle_productos        = $r->detalle_productos        ?? $pedido->detalle_productos;
        $pedido->horario_recepcion_inicio = $r->horario_recepcion_inicio ?? $pedido->horario_recepcion_inicio;
        $pedido->horario_recepcion_final  = $r->horario_recepcion_final  ?? $pedido->horario_recepcion_final;
        $pedido->fecha_recepcion          = $r->fecha_recepcion          ?? $pedido->fecha_recepcion;

        $pedido->save();

        // if($pedido->save()){
        //     $limpia_carro = Carrito::where('id_usuario',$pedido->id_usuario)->first();
        //     $limpia_carro->delete();
        // }

        return response()->json([
            "status" => true,
            "data"   => "Pedido guardado"
        ]);
    }

    
    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
        return response()->json([
            "status" => true,
            "data"   => "Pedido borrado"
        ]);
    }

    public function update_with_email(Request $r){
        $r->validate([
            'email'=>'required',
            'status_flowOrder'=>'required',
        ]);
    }



}
// public function pedidos_usuario($celular)
    // {
    //     $a = Pedido::where('celular',$celular)->get();

    //     return response()->json([
    //         "status" => true,
    //         "data"   => $a
    //     ]); 
    // }

    
        /*Firebase notification
        
            $keyapi =  config('app.APP_FIREBASE_KEY');
            $user_tokens = DB::table('users as u')
            ->join('oauth_access_tokens as t','u.id','=','t.user_id')
            ->where('u.user_id',$r->username)
            ->where('t.device_token','<>',null)
            ->where('t.revoked','0')
            ->orderBy('t.updated_at','desc')
            ->pluck('device_token')
            ->toArray();
            $url = 'https://fcm.googleapis.com/fcm/send';

            $fields = array (
                    'registration_ids' => $user_tokens,
                    'data' => array (
                        'message'       => 'Nuevo pedido',
                        'title'         => 'Nuevo pedido',
                        'body'          => "$user->name ha hecho un nuevo pedido",
                    )
            );
            $fields = json_encode ( $fields );

            $headers = array (
                    'Authorization: key=' . $keyapi,
                    'Content-Type: application/json'
       0 .    );

            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

            $result = curl_exec ( $ch );
            curl_close ( $ch );
        */

        // public function pedidos_sin_conductor_asignado()
    // {
    //     $pedidos = Pedido::where('id_conductor',null)->where('estado_despacho','SIN ASIGNAR')->get();

    //     return response()->json($pedidos);
    // }
    // public function pedidos_por_conductor_y_fecha($id_conductor,$fecha,$estado)
    // {
    //     if(!$estado){
    //         $pedidos = Pedido::where('id_conductor',$id_conductor)
    //         ->join('comunas as c','pedidos.id_comuna','=','c.id')
    //         ->leftJoin('users as u','u.id','=','pedidos.id_usuario')
    //         ->where('fecha_recepcion',$fecha)
    //         ->orderBy('pedidos.id_comuna','desc')
    //         ->orderBy('c.id','desc')
    //         ->select(
    //             'c.nombre as nombre_comuna',
    //             'u.name as user_name',
    //             'u.celular as user_celular',
    //             'u.email as user_email',
    //             'u.direccion',
    //             'pedidos.id as id_pedido',
    //             'pedidos.id_conductor',
    //             'pedidos.notas as notas_pedido',
    //             'pedidos.estado_pago',
    //             'pedidos.estado_despacho',
    //             'pedidos.medio_de_pago',
    //             'pedidos.total_pago',
    //             'pedidos.detalle_productos',
    //             'pedidos.horario_recepcion_inicio',
    //             'pedidos.horario_recepcion_final',
    //             'pedidos.fecha_recepcion'
    //             )
    //             ->get();
    //     }else{
    //         $pedidos = Pedido::where('id_conductor',$id_conductor)
    //         ->join('comunas as c','pedidos.id_comuna','=','c.id')
    //         ->leftJoin('users as u','u.id','=','pedidos.id_usuario')
    //         ->where('estado_despacho',$estado)
    //         ->where('fecha_recepcion',$fecha)
    //         ->orderBy('pedidos.id_comuna','desc')
    //         ->orderBy('c.id','desc')
    //         ->select(
    //             'c.nombre as nombre_comuna',
    //             'u.name as user_name',
    //             'u.celular as user_celular',
    //             'u.email as user_email',
    //             'u.direccion',
    //             'pedidos.id as id_pedido',
    //             'pedidos.id_conductor',
    //             'pedidos.notas as notas_pedido',
    //             'pedidos.estado_pago',
    //             'pedidos.estado_despacho',
    //             'pedidos.medio_de_pago',
    //             'pedidos.total_pago',
    //             'pedidos.detalle_productos',
    //             'pedidos.horario_recepcion_inicio',
    //             'pedidos.horario_recepcion_final',
    //             'pedidos.fecha_recepcion'
    //             )
    //             ->get();
    //     }


    //     return response()->json($pedidos);
    // }
    // public function auto_asignacion_de_pedidos_por_fecha($fecha){
    //     $pedidos_no_asignados = Pedido::where('id_conductor',null)->get();
    //     $limite               = 32;
    //     $total_para_viajar    = 9500;
    //     $envio_pedidos_minimo = 5;
    //     $msg                  = '';
    //     $conductores_copados  = [];
    //     $conductores          = User::where('role_id','3')->get();
    //     $conductores_ids      = $conductores->pluck('id')->toArray();

    //     foreach($conductores as $conductor){

    //         $pedidos_ya_asignados = Pedido::where('id_conductor','=',$conductor->id)
    //         ->whereIn('estado_despacho',['ENTREGADO','EN CAMINO','RECHAZADO','ASIGNADO'])
    //         ->where('fecha_recepcion',$fecha)
    //         ->get();
    //         if($pedidos_ya_asignados->count()>=$limite){
    //             \Log::info("Límite de pedidos $limite alcanzado para el conductor $conductor->name");
    //             $msg =$msg." Límite de pedidos $limite alcanzado para el conductor $conductor->name. ";
    //             array_push($conductores_copados,$conductor->id);
    //         }
    //     }

    //     // Conductores disponibles para ser asignados
    //     $conductores_disponibles = User::ConductoresDisponiblesPorFecha($fecha);
    //     $conductores_disponibles_ids = $conductores_disponibles->pluck('id_conductor')->toArray();
    //     $comunas = Comuna::where('se_cubre','1')->get();
    //     // dd($comunas);

    //     // Pedidos no asignados
    //     //contar los pedidos en cada comuna para asignarlos a un día en específico
    //     $pedidos_cercanos = Pedido::where('id_conductor',null)
    //     ->where('fecha_recepcion',$fecha)
    //     ->join('comunas as c','pedidos.id_comuna','=','c.id')
    //     ->whereIn('estado_despacho',['PENDIENTE','SIN ASIGNAR'])
    //     ->where('c.cargo_por_producto','<=',100)
    //     ->orderBy('c.id','desc')
    //     ->get();
    //     // dd($pedidos_cercanos);

    //     foreach($pedidos_cercanos as $pedido_c){
    //         foreach($conductores_disponibles as $conductor){
    //             $pedidos_por_conductor = Pedido::where('id_conductor',$conductor->id)->where('fecha_recepcion',$fecha)->whereIn('estado_despacho',['ENTREGADO','EN CAMINO','ASIGNADO'])->get()->count();
    //             // dd($pedidos_por_conductor);
    //             if($pedidos_por_conductor <= 32){
    //                 $pedido_c->id_conductor = $conductor->id;
    //                 $pedido_c->estado_despacho = 'ASIGNADO';
    //                 $pedido_c->save();
    //                 // dd('pedido cercanos asignados');
    //             }else{
    //                 \Log::info("Limite de asignaciones alcanzado para el $conductor->name");
    //             }
    //         }
    //     }
    //     // dd('pedidos cercanos asignados');

    //     $pedidos_lejanos = Pedido::where('id_conductor',null)
    //     ->where('fecha_recepcion',$fecha)
    //     ->join('comunas as c','pedidos.id_comuna','=','c.id')
    //     ->whereIn('estado_despacho',['PENDIENTE','SIN ASIGNAR'])
    //     ->where('c.cargo_por_producto','>',100)
    //     ->whereOr('total_pago','>',$total_para_viajar)
    //     ->get();

    //     foreach($pedidos_lejanos as $pedido_l){
    //         foreach($conductores_disponibles as $conductor){
    //             $pedidos_por_conductor = Pedido::where('id_conductor',$conductor->id)->whereIn('estado_despacho',['ENTREGADO','EN CAMINO','ASIGNADO'])->where('fecha_recepcion',$fecha)->get()->count();
    //             if($pedidos_por_conductor <= 32){
    //                 $pedido_l->id_conductor = $conductor->id;
    //                 $pedido_l->estado_despacho = 'ASIGNADO';
    //                 $pedido_l->save();
    //             }else{
    //                 \Log::info("Limite de asignaciones alcanzado para el $conductor->name");
    //             }
    //         }
    //     }

    //     $pendientes=Pedido::where('fecha_recepcion',$fecha)->whereIn('estado_despacho',['PENDIENTE','SIN ASIGNAR'])->where('id_conductor',null)->get();
    //     $cantidad = $pendientes->count();

    //     if($cantidad >= 1){
    //         return response()->json([
    //             'msg'=>"$cantidad envios pendientes para el $fecha, necesita contratar mas conductores"
    //         ]);
    //     }else{
    //         return response()->json([
    //             'msg'=>"$cantidad envios pendientes para el $fecha. Buen trabajo"
    //         ]);
    //     }

    // }
    
    // public function conductores_disponibles_hoy()
    // {
    //     $limite = 32;
    //     $today  = Carbon::today()->format('Y-m-d');
    //     $conductores_disponibles = User::ConductoresDisponiblesPorFecha($today,$limite);       
    //     return response()->json($conductores_disponibles);
    // }
    // public function conductores_disponibles_por_fecha($fecha)
    // {   
    //     $conductores_disponibles = User::ConductoresDisponiblesPorFecha($fecha);

    //     return response()->json($conductores_disponibles);
    // }

    // public function conductor_asignado($id_pedido){
    //     $conductor = Pedido::join('users as u','id_conductor','=','u.id')
    //     ->where('pedidos.id',$id_pedido)
    //     ->select('pedidos.id_conductor as id_conductor','u.name as nombre','u.celular')
    //     ->first();

    //     return response()->json($conductor);
    // }