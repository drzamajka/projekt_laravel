<?php

namespace Database\Seeders\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Rafał Pęczek',
            'email' => 'drzamajka999@wp.pl',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('12345678'),
        ]);
        $adminRole = Role::findByName(config('app.admin_role'));
        if (isset($adminRole)) {
            $user->assignRole($adminRole);
        }

        $user = User::create([
            'name' => 'User Testowy',
            'email' => 'user.testowy@localhost',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('12345678'),
        ]);
        $userRole = Role::findByName(config('app.user_role'));
        if (isset($userRole)) {
            $user->assignRole($userRole);
        }

    }
}