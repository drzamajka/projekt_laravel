<?php

namespace Database\Seeders;

use App\Models\Gwiazda;
use Illuminate\Database\Seeder;

class GwiazdaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gwiazda::factory()->count(50)->create();
    }
}
