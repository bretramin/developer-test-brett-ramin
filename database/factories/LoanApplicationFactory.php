<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\LoanApplication::class, function (Faker $faker) {
    return [
        'value' => $faker->numberBetween(1,800) * 100000, // $1,000.00 - $800,000.00
    ];
});
