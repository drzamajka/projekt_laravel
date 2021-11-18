<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Gwiazda;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();

        Film::factory()->count(500)->create()->each(function ($film){
            for( $i = 0; $i < rand(1, 5); $i++){
                DB::table('gwiazdy_w_filmie')->insert([
                    'id_filmu' => $film->id,
                    'id_gwiazdy' => Gwiazda::select('id')->orderByRaw("RAND()")->first()->id,
                    'rola' => $this->faker->name()
                ]);
            }
        });
    }
}
