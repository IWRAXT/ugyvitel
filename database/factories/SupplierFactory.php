<?php

use Faker\Generator as Faker;

$factory->define(\App\Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'fiscal_number' => $faker->uuid,
        'address' => $faker->address,
        'webpage_address' => $faker->url,
        'contact_name' => $faker->name,
        'contact_title' => $faker->title,
        'contact_email' => $faker->email,
        'contact_phone_number' => $faker->phoneNumber,
    ];
});
