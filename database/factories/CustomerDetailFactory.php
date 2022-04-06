<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address1' => $this->faker->address,
            'address2' => $this->faker->address,
            'address3' => $this->faker->address,
            'address4' => $this->faker->address,
        ];
    }

}
