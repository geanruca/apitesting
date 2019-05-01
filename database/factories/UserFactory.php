<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\User;
use App\Comuna;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $cargo = [100,200,300];
    $descuento = [100,200,300];
    $comunas = Comuna::pluck('id')->toArray();
    $zonas = ['Satelite','El abrazo','Calera'];
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'cargo'=>$faker->randomElement($cargo),
        'descuento'=>$faker->randomElement($descuento),
        'id_comuna'=>$faker->randomElement($comunas),
        'zona'=>$faker->randomElement($zonas),
        'celular'=>$faker->phoneNumber(),
    ];
});
