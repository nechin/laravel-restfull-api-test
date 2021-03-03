<?php

namespace Database\Factories;

use App\Entities\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomNumber(),
            'fullName' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
            'country' => $this->faker->unique()->country,
            'username' => $this->faker->userName,
            'gender' => 'male',
            'city' => $this->faker->unique()->city,
            'phone' => $this->faker->unique()->phoneNumber,
        ];
    }
}
