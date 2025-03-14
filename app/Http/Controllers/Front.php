<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;

class Front extends Controller
{
    public function home()
    {
        //get products by brands name thens product name
        $products = Product::select(['products.*', 'brands.name as brand_name'])
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->orderBy('brands.name')
            ->orderBy('products.name')
            ->get();

        //$products = Product::all()->sortBy('name');
        $shops = Shop::where('hidden', false)->get();
        $offers = Offer::allByProductAndShop();
        $properties = config('pelicomp.properties');

        return view('components/front/home', [
            'products' => $products,
            'shops' => $shops,
            'offers' => $offers,
            'properties' => $properties
        ]);
    }

    public function product(Request $request)
    {
        $brands = Brand::all();
        $properties = config('pelicomp.properties');
        $product = Product::findBySlug($request->slug);
        return view('components/front/product', [
            'product' => $product,
            'brands' => $brands,
            'properties' => $properties,
        ]);
    }

    public function about()
    {
        return view('components/front/about');
    }

    public function waiting()
    {
        return view('components/front/waiting');
    }
}
