<?php

use Faker\Generator as Faker;

$factory->define(\App\Cost_type::class, function (Faker $faker) {
    $groups = [
        'Anyagköltség',
        'Szolgáltatás',
        'Utiköltség',
    ];

    return [
        'name' => $faker->unique()->word,
        'group' => $groups[rand(0,2)],
    ];
});
