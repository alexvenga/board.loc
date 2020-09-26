<?php

use App\Models\Region;
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

$factory->define(Region::class, function (Faker $faker) {
    $name = $faker->unique()->city;
    return [
        'name'      => $name,
        'slug'      => Str::slug($name),
        'parent_id' => null
    ];
});
