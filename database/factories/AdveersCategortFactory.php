<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Models\Adverts\Category::class, function (Faker $faker) {
    $name = $faker->unique()->name;
    return [
        'name'      => $name,
        'slug'      => Str::slug($name),
        'parent_id' => null,
    ];
});
