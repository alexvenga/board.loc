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

$factory->define(User::class, function (Faker $faker) {
    $active = $faker->boolean;
    $phoneActive = $faker->boolean;
    return [
        'name'           => $faker->name,
        'last_name'      => $faker->lastName,
        'email'          => $faker->unique()->safeEmail,
        'phone'          => $faker->unique()->phoneNumber,
        'phone_verified' => $phoneActive,
        'password'       => Hash::make('secret'), // secret
        'remember_token' => Str::random(10),
        'verify_token'   => $active ? null : Str::uuid(),

        'phone_verify_token'         => $phoneActive ? null : Str::uuid(),
        'phone_verify_token_expire' => $phoneActive ? null : \Carbon\Carbon::now()->addSeconds(300),

        'role'   => $active ? $faker->randomElement(User::rolesList()) : User::ROLE_USER,
        'status' => $active ? User::STATUS_ACTIVE : User::STATUS_WAIT,
    ];
});
