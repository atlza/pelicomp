<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Shop;
use App\Traits\LogTrait;
use App\Traits\ParserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Shops extends Controller
{
    use Logtrait, ParserTrait;

    public function shops()
    {
        $shops = Shop::all();
        return view('components/connected/shops', [
            'shops' => $shops
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'url' => 'required|url:http,https',
            'code' => 'nullable|string',
        ]);

        try {

            if( !empty($request->id) ){
                $shop = Shop::findorfail($request->id);
                $shop->name = $request->name;
                $shop->code = $request->code;
                $shop->url = $request->url;

                if($request->hidden === 'true') $shop->hidden = true;
                else $shop->hidden = false;

                $this->log('edit', 'shop', $shop->id);
            }
            else{
                $shop = new Shop($request->only(['name', 'code', 'url', 'hidden']));
                $shop->user_id = Auth::user()->id;

                $this->log('create', 'shop', $shop->id);
            }
            $shop->save();

            return redirect()->route("manage-shops")->with('message', trans('Boutique correctement ajoutée'));
        } catch (\Exception $e) {
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }

    public function addProducts(Request $request)
    {
        $properties = config('pelicomp.properties');
        $brands = Brand::all();

        $request->validate([
            'shop_id' => 'required|integer|exists:shops,id',
            'url' => 'required|url:http,https',
        ]);

        try {
            $newProducts = $this->readProductsListUrl( $request->url, false );
            $products = Product::all();

            $shop = Shop::find($request->shop_id);

            return view('components/connected/shops/add-products', [
                'shop' => $shop,
                'products' => $products,
                'brands' => $brands,
                'newProducts' => $newProducts,
                'properties' => $properties
            ]);

            //return redirect()->route("manage-shops")->with('message', trans('Boutique correctement ajoutée'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }
}
