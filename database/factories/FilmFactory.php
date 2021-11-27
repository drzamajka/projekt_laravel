<?php

namespace Database\Factories;

use App\Models\Gatunek;
use App\Models\Gwiazda;
use Illuminate\Database\Eloquent\Factories\Factory;

class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gatunek_id' => Gatunek::select('id')->orderByRaw("RAND()")->first()->id,
            'gwiazda_id' => Gwiazda::select('id')->orderByRaw("RAND()")->first()->id,
            'tytul' => $this->faker->word(),
            'data_premiery' => $this->faker->dateTime(),
            'opis' => $this->faker->text(150),
            'czyokladka' => False,
        ];
    }
}
