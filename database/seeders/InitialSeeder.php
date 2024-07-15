<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([ 'name' => 'Adox' ]);
        Brand::create([ 'name' => 'Agfa' ]);
        Brand::create([ 'name' => 'Bergger' ]);
        Brand::create([ 'name' => 'Catlabs' ]);
        Brand::create([ 'name' => 'Cinestill' ]);
        Brand::create([ 'name' => 'Foma' ]);
        Brand::create([ 'name' => 'Fuji' ]);
        Brand::create([ 'name' => 'Ilford' ]);
        Brand::create([ 'name' => 'JCH' ]);
        Brand::create([ 'name' => 'Kentmere' ]);
        Brand::create([ 'name' => 'Kodak' ]);
        Brand::create([ 'name' => 'Kosmo' ]);
        Brand::create([ 'name' => 'Lomography' ]);
        Brand::create([ 'name' => 'Rollei' ]);
        Brand::create([ 'name' => 'SFL' ]);
        Brand::create([ 'name' => 'Shanghai' ]);
        Brand::create([ 'name' => 'Silberra' ]);
        Brand::create([ 'name' => 'Washi' ]);


        //default user admin is created, please change default password before running seeder
        $userAS = User::create([
            'name' => 'Admin',
            'email' => 'admin@atlza.com',
            'password' => Hash::make('786SjwxC9juKZkaCWgRkzKgoCKjnkCib'),
        ]);

        $superAdminRole = Role::findByName('super admin');
        $userAS->assignRole($superAdminRole);
    }
}
