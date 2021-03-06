<?php

use Carbon\Carbon;
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

$factory->define(App\Models\Report::class, function (Faker $faker) {
    return [
        'date'   => Carbon::now(),
        'count'  => $faker->randomNumber(),
        'amount' => $faker->randomNumber(9),
        'fees'   => $faker->randomNumber(9),
    ];
});
