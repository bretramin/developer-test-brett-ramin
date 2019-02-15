<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Borrower::class, function (Faker $faker, $attributes) {
    return [
        'loan_application_id' => $attributes['loan_application_id'] ?? factory(\App\LoanApplication::class)->create()->id,
        'name'                => $faker->name,
    ];
});
