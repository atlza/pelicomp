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

        Type::create([ 'name' => 'Black & white' ]);
        Type::create([ 'name' => 'Panchromatique' ]);
        Type::create([ 'name' => 'Couleur' ]);
        Type::create([ 'name' => 'Couleur ciné' ]);
        Type::create([ 'name' => 'Panchromatique ciné' ]);
        Type::create([ 'name' => 'Couleur reversible' ]);
        Type::create([ 'name' => 'Orthopanchromatique' ]);
        Type::create([ 'name' => 'Monochrome' ]);
        Type::create([ 'name' => 'Couleur Lomo' ]);
        Type::create([ 'name' => 'Superpanchromatique' ]);
        Type::create([ 'name' => 'Hyperpanchromatique' ]);
        Type::create([ 'name' => 'Radio fluographique' ]);
    }
}
