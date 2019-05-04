<?php

use Illuminate\Database\Seeder;
use App\Pedido;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 20)->create();
        factory(App\Pedido::class, 100)->create();
        
    }
}
