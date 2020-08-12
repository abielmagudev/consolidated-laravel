<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Remitente;
use Faker\Generator as Faker;

$factory->define(Remitente::class, function (Faker $faker) {
    return [
        'entrada_id' => $faker->numberBetween(1,100),
        'nombre' => $faker->name(),
        'direccion' => $faker->streetAddress,
        'codigo_postal' => $faker->postcode,
        'ciudad' => $faker->city,
        'estado' => $faker->state,
        'pais' => $faker->country,
        'telefono' => $faker->phoneNumber,
        'created_by_user' => $faker->numberBetween(1,10),
        'updated_by_user' => $faker->numberBetween(1,10),
    ];
});
