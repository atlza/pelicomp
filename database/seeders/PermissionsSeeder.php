<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $adminRole = Role::create(['name' => 'admin']);
        $contribRole = Role::create(['name' => 'contributor']);
        $inactiveRole = Role::create(['name' => 'inactive']);
        $bannedRole = Role::create(['name' => 'banned']);

        $permissionUsers = Permission::create(['name' => 'Manage users']);
        $permissionShops = Permission::create(['name' => 'Manage shops']);
        $permissionBrands = Permission::create(['name' => 'Manage brands']);
        $permissionProducts = Permission::create(['name' => 'Manage products']);
        $permissionOffers = Permission::create(['name' => 'Manage offers']);
        $permissionLogin = Permission::create(['name' => 'User login']);

        $adminRole->syncPermissions([$permissionUsers, $permissionShops, $permissionBrands, $permissionProducts, $permissionOffers, $permissionLogin]);
        $contribRole->syncPermissions([$permissionBrands, $permissionProducts, $permissionOffers, $permissionLogin]);
        $inactiveRole->syncPermissions([$permissionLogin]);
        //banned users have no permissions

        //default user admin is created, please change default password before running seeder
        $userAS = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@atlza.com',
            'password' => Hash::make('786SjwxC9juKZkaCWgRkzKgoCKjnkCib'),
        ]);
        $userAS->assignRole($adminRole);
    }
}
