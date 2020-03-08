<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entry;
use Faker\Generator as Faker;

$factory->define(Entry::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->text,
        'user_id' => 1
    ];
});
