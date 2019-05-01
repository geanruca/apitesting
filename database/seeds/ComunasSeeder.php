<?php

use Illuminate\Database\Seeder;
use App\Comuna;
use Faker\Generator as Faker;

class ComunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $comunas = ['Colina',
            'Til Til',
            'Puente Alto',
            'Pirque',
            'San José de Maipo',
            'San Bernardo',
            'Buin',
            'Calera de Tango',
            'Paine',
            'Melipilla',
            'Alhué',
            'Curacaví',
            'María Pinto',
            'San Pedro',
            'Santiago',
            'Cerrillos',
            'Cerro Navia',
            'Conchalí',
            'El Bosque',
            'Estación Central',
            'Huechuraba',
            'Independencia',
            'La Cisterna',
            'La Florida',
            'La Granja',
            'La Pintana',
            'La Reina',
            'Las Condes',
            'Lo Barnechea',
            'Lo Espejo',
            'Lo Prado',
            'Macul',
            'Maipú',
            'Ñuñoa',
            'Pedro Aguirre Cerda',
            'Peñalolén',
            'Providencia',
            'Pudahuel',
            'Quilicura',
            'Quinta Normal',
            'Recoleta',
            'Renca',
            'San Joaquín',
            'San Miguel',
            'San Ramón',
            'Vitacura',
            'Talagante',
            'El Monte',
            'Isla de Maipo',
            'Padre Hurtado',
            'Peñaflor'];
        sort($comunas);
        $cargo=[0,50,100,200,300,500];
        $dias=['L','M','X','J','V','S','D'];
        $numeros = [1,2,3,4,5,6,7,8,9,10];
        foreach($comunas as $comuna){
            Comuna::insert([
                'nombre'=>$comuna,
                'se_cubre'=>'1',
                'cargo_por_producto'=>$faker->randomElement($cargo),
                'dias_de_despacho'=>$faker->randomElement($dias),
                'pedido_minimo'=>$faker->randomElement($numeros),

            ]);
        }
    }
}
