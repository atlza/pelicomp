<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class Front extends Controller
{
    public function home()
    {
        $products = Product::all();
        $shops = Shop::all();
        $offers = Offer::allByProductAndShop();
        $properties = config('pelicomp.properties');

        return view('components/front/home', [
            'products' => $products,
            'shops' => $shops,
            'offers' => $offers,
            'properties' => $properties,
        ]);
    }

    public function about()
    {
        return view('components/front/about');
    }
}
