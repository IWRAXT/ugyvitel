<?php

use Faker\Generator as Faker;

$factory->define(\App\Cost::class, function (Faker $faker) {
    return [
        'date' => $faker->date(),
        'account_number' => $faker->bankAccountNumber,
        'comment' => $faker->text,
        'sum' => rand(0,10000),
        'site_id' => \App\Site::inRandomOrder()->first()->getKey(),
        'supplier_id' => \App\Supplier::inRandomOrder()->first()->getKey(),
        'cost_type_id' => \App\Cost_type::inRandomOrder()->first()->getKey(),
    ];
});
