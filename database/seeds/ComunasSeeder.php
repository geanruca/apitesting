<?php

use Illuminate\Database\Seeder;
use App\Comuna;

class ComunasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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

        foreach($comunas as $comuna){
            Comuna::insert([
                'nombre'=>$comuna
            ]);
        }
    }
}
