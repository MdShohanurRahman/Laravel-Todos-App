<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Str;

$factory->define(\App\Todo::class, function (Faker $faker) {
    $slug = Str::slug($faker->sentence(2), '-');
    return [
        'name' => $faker->sentence(2),
        'slug' => $slug,
        'description' => $faker->paragraph(4),
        'completed' => false
    ];
});
