<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Correlativo;
use Faker\Generator as Faker;

$factory->define(Correlativo::class, function (Faker $faker) {

    $num = 1;

    return [
        'num_correlativo' => $num + 1
    ];
});
