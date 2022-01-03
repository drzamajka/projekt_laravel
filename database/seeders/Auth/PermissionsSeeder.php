<?php

namespace Database\Seeders\Auth;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        // php artisan permission:cache-reset
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'log-viewer']);

        Permission::create(['name' => 'users-index']);
        Permission::create(['name' => 'users-store']);
        Permission::create(['name' => 'users-destroy']);
        Permission::create(['name' => 'users-change_role']);

        Permission::create(['name' => 'gatunki-index']);
        Permission::create(['name' => 'gatunki-store']);
        Permission::create(['name' => 'gwiazdy-index']);
        Permission::create(['name' => 'gwiazdy-store']);
        Permission::create(['name' => 'filmy-index']);
        Permission::create(['name' => 'filmy-store']);

        // ADMINSTRATOR SYSTEMU
        $userRole = Role::findByName(config('app.admin_role'));
        $userRole->givePermissionTo('log-viewer');

        $userRole->givePermissionTo('users-index');
        $userRole->givePermissionTo('users-store');
        $userRole->givePermissionTo('users-destroy');
        $userRole->givePermissionTo('users-change_role');

        $userRole->givePermissionTo('gatunki-index');
        $userRole->givePermissionTo('gatunki-store');
        $userRole->givePermissionTo('gwiazdy-index');
        $userRole->givePermissionTo('gwiazdy-store');
        $userRole->givePermissionTo('filmy-index');
        $userRole->givePermissionTo('filmy-store');

        // twurca 
        $userRole = Role::findByName(config('app.creator_role'));

        // urzytkownik 
        $userRole = Role::findByName(config('app.user_role'));
    }
}
