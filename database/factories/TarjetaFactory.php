<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Asociacione;
use App\Correlativo;
use App\Tarjeta;
use App\Vehiculo;
use Faker\Generator as Faker;

$factory->define(Tarjeta::class, function (Faker $faker) {

    $letter = ['P', 'G', 'T', 'M', 'D'];

    return [
        'nombre_socio' => $faker->name,
        'nombre_propietario' => $faker->name,
        'dni_socio' => $faker->randomNumber(8),
        'dni_propietario' => $faker->randomNumber(8),
        'url' => $faker->slug(),
        'num_placa' => $faker->randomNumber(3). '-' .$faker->randomNumber(2). $letter[mt_rand(0,count($letter)-1)] . $faker->randomNumber(2),
        'expedicion' => $faker->date(),
        'revalidacion' => $faker->date(),
        'num_operacion' => $faker->randomNumber(6).'-2021-'.$faker->randomNumber(2),
        'vigencia_operacion' => $faker->randomNumber(8),
        'num_autorizacion' => $faker->randomNumber(4).'-2021-'.$faker->randomNumber(4),
        'vigencia_autorizacion' => $faker->randomNumber(8),
        'status' => 0,
        'vehiculo_id' => Vehiculo::all()->random()->id,
        'asociacione_id' => Asociacione::all()->random()->id,
        'correlativo_id' => Correlativo::all()->random()->id
    ];
});
