<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
    }
}
