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

        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.store']);
        Permission::create(['name' => 'users.destroy']);
        Permission::create(['name' => 'users.change_role']);

        Permission::create(['name' => 'category.index']);
        Permission::create(['name' => 'category.store']);
        Permission::create(['name' => 'manufacturer.index']);
        Permission::create(['name' => 'manufacturer.store']);
        Permission::create(['name' => 'product.index']);
        Permission::create(['name' => 'product.store']);

        // ADMINSTRATOR SYSTEMU
        $userRole = Role::findByName(config('app.admin_role'));
        $userRole->givePermissionTo('log-viewer');

        $userRole->givePermissionTo('users.index');
        $userRole->givePermissionTo('users.store');
        $userRole->givePermissionTo('users.destroy');
        $userRole->givePermissionTo('users.change_role');

        // $userRole->givePermissionTo('category.index');
        // $userRole->givePermissionTo('category.store');
        // $userRole->givePermissionTo('manufacturer.index');
        // $userRole->givePermissionTo('manufacturer.store');
        // $userRole->givePermissionTo('product.index');
        // $userRole->givePermissionTo('product.store');
        // urzytkownik 
        $userRole = Role::findByName(config('app.user_role'));
        // $userRole->givePermissionTo('category.index');
        // $userRole->givePermissionTo('manufacturer.index');
        // $userRole->givePermissionTo('product.store');
    }
}
