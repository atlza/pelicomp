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
        $superAdminRole = Role::findOrCreate(['name' => 'super admin']);
        $adminRole = Role::findOrCreate(['name' => 'admin']);
        $contribRole = Role::findOrCreate(['name' => 'contributor']);
        $inactiveRole = Role::findOrCreate(['name' => 'inactive']);
        $bannedRole = Role::findOrCreate(['name' => 'banned']);

        $permissionAdmins = Permission::findOrCreate(['name' => 'Manage admins']);
        $permissionUsers = Permission::findOrCreate(['name' => 'Manage users']);
        $permissionShops = Permission::findOrCreate(['name' => 'Manage shops']);
        $permissionBrands = Permission::findOrCreate(['name' => 'Manage brands']);
        $permissionProducts = Permission::findOrCreate(['name' => 'Manage products']);
        $permissionOffers = Permission::findOrCreate(['name' => 'Manage offers']);
        $permissionLogin = Permission::findOrCreate(['name' => 'User login']);
        $permissionLogs = Permission::findOrCreate(['name' => 'See logs']);

        $superAdminRole->syncPermissions([$permissionLogs, $permissionAdmins, $permissionUsers, $permissionShops, $permissionBrands, $permissionProducts, $permissionOffers, $permissionLogin]);
        $adminRole->syncPermissions([$permissionUsers, $permissionBrands, $permissionProducts, $permissionOffers, $permissionLogin]);
        $contribRole->syncPermissions([$permissionBrands, $permissionProducts, $permissionOffers, $permissionLogin]);
        $inactiveRole->syncPermissions([$permissionLogin]);
        //banned users have no permissions
    }
}
