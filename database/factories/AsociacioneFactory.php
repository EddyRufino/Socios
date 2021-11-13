<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Asociacione;
use Faker\Generator as Faker;

$factory->define(Asociacione::class, function (Faker $faker) {
    return [
        'nombre' => $faker->company()
    ];
});
