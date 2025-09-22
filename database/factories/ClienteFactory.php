<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() : array
    {
        return [
            'nombre' => $this->faker->name(),
            'numeroTelefono' => $this->faker->unique()->phoneNumber(),
        ];
    }
}
