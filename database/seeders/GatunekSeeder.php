<?php

namespace Database\Seeders;

use App\Models\Gatunek;
use Illuminate\Database\Seeder;

class GatunekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gatunek::factory()->count(50)->create();
    }
}
