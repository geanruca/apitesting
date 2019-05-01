<?php

use Illuminate\Database\Seeder;
use App\Pedido;
use Carbon\Carbon;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pedido::insert([
            'id_usuario'=>3,
            'id_comuna'=>25,
            'id_conductor'=>5,
            'estado_pago'=>'PAGADO',
            'estado_despacho'=>'PENDIENTE',
            'medio_de_pago'=>'REDCOMPRA',
            'total_pago'=>'9800',
            'detalle_productos'=>'Bidon de 20 lts x 2, Bidon de 12 lts x 3',
            'horario_recepcion'=>'14:00 - 19:00',
            // 'fecha_recepcion'=>Carbon::now()->addDay(),
            'notas'=>'Usuario que nunca paga',
        ]);
        Pedido::insert([
            'id_usuario'=>3,
            'id_comuna'=>25,
            'id_conductor'=>5,
            'estado_pago'=>'PENDIENTE',
            'estado_despacho'=>'PENDIENTE',
            'medio_de_pago'=>'EFECTIVO',
            'total_pago'=>'9800',
            'detalle_productos'=>'Bidon de 20 lts x 2, Bidon de 12 lts x 3',
            'horario_recepcion'=>'14:00 - 19:00',
            'fecha_recepcion'=>Carbon::now()->addDays(5),
            'notas'=>'Usuario que nunca paga',
        ]);
        Pedido::insert([
            'id_usuario'=>3,
            'id_comuna'=>25,
            'id_conductor'=>5,
            'estado_pago'=>'PENDIENTE',
            'estado_despacho'=>'PENDIENTE',
            'medio_de_pago'=>'EFECTIVO',
            'total_pago'=>'9800',
            'detalle_productos'=>'Bidon de 20 lts x 2, Bidon de 12 lts x 3',
            'horario_recepcion'=>'14:00 - 19:00',
            'fecha_recepcion'=>Carbon::now()->addDays(4),
            'notas'=>'Usuario que nunca paga',
        ]);
        Pedido::insert([
            'id_usuario'=>3,
            'id_comuna'=>25,
            'id_conductor'=>5,
            'estado_pago'=>'PENDIENTE',
            'estado_despacho'=>'PENDIENTE',
            'medio_de_pago'=>'EFECTIVO',
            'total_pago'=>'9800',
            'detalle_productos'=>'Bidon de 20 lts x 2, Bidon de 12 lts x 3',
            'horario_recepcion'=>'14:00 - 19:00',
            'fecha_recepcion'=>Carbon::now()->addDays(3),
            'notas'=>'Usuario que nunca paga',
        ]);
    }
}
