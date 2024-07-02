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

    public function edit( $productId )
    {
        $brands = Brand::all();
        $properties = config('pelicomp.properties');

        $product = Product::find($productId);

        return view('components/connected/products/edit', [
            'product' => $product,
            'brands' => $brands,
            'properties' => $properties,
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer|exists:products,id',
            'brand_id' => 'required|integer',
            'name' => 'required|string'
        ]);

        try {
            if ($request->id) {
                $product = Product::findorfail($request->id);

                $product->name = $request->name;
                $product->prop1 = $request->prop1;
                $product->prop2 = $request->prop2;
                $product->prop3 = $request->prop3;
                $product->prop4 = $request->prop4;
                $product->prop5 = $request->prop5;
            }
            else {
                $product = new Product($request->only(['brand_id', 'name', 'prop1', 'prop2', 'prop3', 'prop4', 'prop5']));
                $product->user_id = Auth::user()->id;
            }
            $product->save();

            return redirect()->back()->with('message', trans('Produit correctement ajouté'));
        } catch (\Exception $e) {
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }
}
