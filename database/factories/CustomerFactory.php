<?php

/**
 * @var $factory Factory
 */

use App\Entities\Customer;
use LaravelDoctrine\ORM\Testing\Factory;

$factory->define(Customer::class, function(Faker\Generator $faker) {
    return [
        'id' => $faker->randomNumber(),
        'fullName' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'country' => $faker->unique()->country,
        'username' => $faker->userName,
        'gender' => 'male',
        'city' => $faker->unique()->city,
        'phone' => $faker->unique()->phoneNumber,
    ];
});
