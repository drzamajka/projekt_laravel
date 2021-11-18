<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GwiazdaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'imie_gwiazdy' => $this->faker->firstName(100),
            'nazwisko_gwiazdy' => $this->faker->lastName (100),
        ];
    }
}
