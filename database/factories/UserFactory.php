<?php

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
    $active = $faker->boolean;
    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => Hash::make(Str::random()), // secret
        'remember_token' => Str::random(10),
        'verify_token'   => $active ? null : Str::uuid(),
        'status'         => $active ? User::STATUS_ACTIVE : User::STATUS_WAIT,
    ];
});
