<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\Job::class, function (Faker $faker, $attributes) {
    return [
        'borrower_id' => $attributes['borrower_id'] ?? factory(\App\Borrower::class)->create()->id,
        'title'       => $faker->randomElement([
            'CEO',
            'CTO',
            'Owner',
            'Human Resources',
            'Software Engineer',
            'Loan Officer',
            'Banker',
            'Doctor',
        ]),
        'salary'      => $faker->numberBetween(30, 150) * 100000, // $30,000.00 - $150,000.00
    ];
});
