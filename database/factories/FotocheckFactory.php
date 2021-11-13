<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Asociacione;
use App\Fotocheck;
use App\Vehiculo;
use Faker\Generator as Faker;

$factory->define(Fotocheck::class, function (Faker $faker) {
    return [
        'nombre_socio' => $faker->name,
        'dni_socio' => $faker->randomNumber(8),
        'expedicion' => $faker->date(),
        'revalidacion' => $faker->date(),
        'image' => 'https://previews.123rf.com/images/dolgachov/dolgachov1604/dolgachov160401829/54866409-personas-el-cuidado-de-la-salud-de-la-vista-de-negocios-y-concepto-de-la-educaci%C3%B3n-la-cara-de-mujer-.jpg',
        'vehiculo_id' => Vehiculo::all()->random()->id,
        'asociacione_id' => Asociacione::all()->random()->id
    ];
});
