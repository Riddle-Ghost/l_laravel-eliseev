<?php

use Faker\Generator as Faker;
use App\Models\Region;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Region::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->city,
        'slug' => $faker->unique()->slug(2),
        'parent_id' => null,
    ];
});