<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Courrier;
use Faker\Generator as Faker;

$factory->define(Courrier::class, function (Faker $faker) {
    return [
        'objet_courrier'=>$faker->sentence(3),
        'url_courrier'=>$faker->sentence(3),
        'date_depart'=>$faker->dateTime(),
        'date_arrive'=>$faker->dateTime(),
        'num_depart'=>$faker->numberBetween(0,100),
        'num_arrive'=>$faker->numberBetween(0,100),
        'etat_courrier'=>$faker->numberBetween(0,2),
        'classement_id'=>$faker->numberBetween(1,2),
        'mention_id'=>$faker->numberBetween(1,2),
        'typecourrier_id'=>$faker->numberBetween(1,2),
        'user_id'=>$faker->numberBetween(1,2),
        'description_courrier' => $faker->paragraph(10)
    ];
});
