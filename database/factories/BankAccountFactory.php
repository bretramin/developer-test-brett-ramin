<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\BankAccount::class, function (Faker $faker, $attributes) {
    return [
        'borrower_id' => $attributes['borrower_id'] ?? factory(\App\Borrower::class)->create()->id,
        'balance'     => $faker->numberBetween(0, 25000000), // $0.00 - $250,000.00
    ];
});
