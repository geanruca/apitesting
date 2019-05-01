<?php

use Illuminate\Database\Seeder;
use App\Producto;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Producto::insert([
            'nombre'         =>'Bidon de agua Purificada 20 lts', 
            'precio_inicial' =>'2900', 
            'imagenes'       =>'', 
            'path'           =>'https://i.imgur.com/zpXK6XG.png', 
        ]);
        
        Producto::insert([
            'nombre'         =>'Bidon de agua Purificada 12 lts', 
            'precio_inicial' =>'1700', 
            'imagenes'       =>'', 
            'path'           =>'https://i.imgur.com/0rKY34P.png', 
        ]);
        Producto::insert([
            'nombre'         =>'Maquina Frio Calor tipo pedestal', 
            'precio_inicial' =>'120000', 
            'imagenes'       =>'', 
            'path'           =>'https://i.imgur.com/r9HaHjP.png', 
        ]);
            
    }
}
