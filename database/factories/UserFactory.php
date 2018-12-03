<?php

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

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'email'             => $faker->unique()->safeEmail,
        'password'          => '$argon2i$v=19$m=1024,t=2,p=2$T0RBYWdTdmFrenVvaVBlUw$yHX0w0a6VKRZliP3dTAQx8Rc/CWSVgstuUMJ/sLpJAo', // password
        'api_token'         => bin2hex(openssl_random_pseudo_bytes(32)),
        'remember_token'    => str_random(10),
        'email_verified_at' => now(),
    ];
});
