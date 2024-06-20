<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Brands extends Controller
{
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

            return redirect()->route("manage-products")->with('message', trans('Marque correctement ajoutée'));
        } catch (\Exception $e) {
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }
}
