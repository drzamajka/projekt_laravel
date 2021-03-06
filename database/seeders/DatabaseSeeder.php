<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\FilmSeeder;
use Database\Seeders\GatunekSeeder;
use Database\Seeders\GwiazdaSeeder;
use Database\Seeders\Auth\RolesSeeder;
use Database\Seeders\Auth\UsersSeeder;
use Database\Seeders\Auth\PermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(UsersSeeder::class);

        $this->call(GatunekSeeder::class);
        $this->call(GwiazdaSeeder::class);
        $this->call(FilmSeeder::class);
    }
}
