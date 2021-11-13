<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehiculo;
use Faker\Generator as Faker;

$factory->define(Vehiculo::class, function (Faker $faker) {

    $vehiculo = ['Moto Taxy', 'Moto Furgon', 'Triciclo'];

    return [
        'nombre' => $vehiculo[mt_rand(0,count($vehiculo)-1)]
    ];
});
