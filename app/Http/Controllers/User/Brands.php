<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Log;
use App\Traits\LogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Brands extends Controller
{
    use Logtrait;

    public function brands()
    {
        $brands = Brand::all();
        return view('components/connected/brands', [
            'brands' => $brands
        ]);
    }

    public function add(Request $request)
    {


        $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $brand = new Brand($request->only(['name']));
            $brand->user_id = Auth::user()->id;
            $brand->save();

            $this->log('create', 'brand', $brand->id);

            return redirect()->back()->with('message', trans('Marque correctement ajoutée'));
        } catch (\Exception $e) {

            if( App::isLocal() ) {
                dump($request->all());
                dd( $e->getMessage());
            }
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }
}
