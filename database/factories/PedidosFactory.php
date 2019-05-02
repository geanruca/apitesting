<?php

use App\User;
use App\Comuna;
use App\Pedido;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Pedido::class, function (Faker $faker) {
    
    $user_ids         = User  ::where('role_id','4')->pluck('id')->toArray();
    $conductor_ids    = User  ::where('role_id','3')->pluck('id')->toArray();
    // dd($conductor_ids);
    $numeros          = [1,2,3,0];
    $comunas_ids      = Comuna::pluck('id')->toArray();
    $estados_pago     = ['PAGADO','POR PAGAR'];
    $medio_de_pago    = ['EFECTIVO','REDCOMPRA'];
    $estados_despacho = ['ENTREGADO','EN CAMINO','CANCELADO','SIN ASIGNAR','ASIGNADO'];
    $total_pago       = [];
    $horario          = '';
    $horas_entrega    = [];
    $horarios_entrega = [];
    
    for ($i=9; $i < 23; $i++) { 
        $horario = $i.':00';
        array_push($horas_entrega,$horario);
    }
    
    for ($i=0; $i <10 ; $i++) { 
        $kfrom = array_rand($horas_entrega);
        $from  = $horas_entrega[$kfrom];
        $kto   = array_rand($horas_entrega);
        $to    = $horas_entrega[$kto];

        $intfrom = explode(':',$from);
        $intfrom = $intfrom[0];
        $intto   = explode(':',$to);
        $intto   = $intto[0];
        // dd($from);
        if($intto>$intfrom){
            $horario = $from.' - '. $to;
            array_push($horarios_entrega,$horario);
        }
        elseif($to==$from){

        }
        else{
            $horario = $to.' - '. $from;
            array_push($horarios_entrega,$horario);
        }
    }
    

    for ($i=2900; $i<=40000 ; $i=$i+100) { 
        if($i%100==0){
            array_push($total_pago,$i);
        }
    }
    
    return [

        'id_usuario'        => $faker->randomElement($user_ids),
        'id_comuna'         => $faker->randomElement($comunas_ids),
        'id_conductor'      => $faker->optional->randomElement($conductor_ids),
        'estado_pago'       => $faker->randomElement($estados_pago),
        'estado_despacho'   => $faker->randomElement($estados_despacho),
        'medio_de_pago'     => $faker->randomElement($medio_de_pago),
        'total_pago'        => $faker->randomElement($total_pago),
        'detalle_productos' => 'Bidon de 20 lts x 2, Bidon de 12 lts x 3',
        'horario_recepcion' => $faker->randomElement($horarios_entrega),
        'fecha_recepcion'   => Carbon::now()->addDay($faker->randomElement($numeros)),

    ];
});
