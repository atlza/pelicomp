<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Products extends Controller
{
    public function all()
    {
        $products = Product::all();
        $brands = Brand::all();
        $properties = config('pelicomp.properties');

        return view('components/connected/products/list', [
            'products' => $products,
            'brands' => $brands,
            'properties' => $properties
        ]);
    }

    public function view( $productId )
    {
        $brands = Brand::all();
        $properties = config('pelicomp.properties');

        $product = new Product($productId);
        $product->firstorfail();

        return view('components/connected/products/view', [
            'product' => $product,
            'brands' => $brands,
            'properties' => $properties,
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|integer',
            'name' => 'required|string'
        ]);

        try {
            $product = new Product($request->only(['brand_id', 'name', 'prop1', 'prop2', 'prop3', 'prop4', 'prop5']));
            $product->user_id = Auth::user()->id;
            $product->save();

            return redirect()->route("connected-products")->with('message', trans('Produit correctement ajouté'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }
}
