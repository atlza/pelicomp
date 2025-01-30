<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Type;
use App\Traits\LogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Products extends Controller
{
    use Logtrait;

    public function all()
    {
        $products = Product::orderByDesc('id')->get();
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
        try {
            $this->save($request);
            return redirect()->back()->with('message', trans('Produit correctement ajouté'));
        } catch (\Exception $e) {
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }

    public function addAjax(Request $request)
    {
        try {
            $product = $this->save($request);
            return response()->json([
                'status' => true,
                'productAdded' => $product,
                'brand' => $product->brand,
            ]);
        }
        catch (\Exception $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function saveOffers(Request $request)
    {
        try {
            if(!empty( $request->product_id )) foreach ( $request->product_id as $indice => $product_id ){
                if( !empty($product_id) ){

                    Offer::withTrashed()->updateOrCreate([
                        'product_id' => $product_id,
                        'shop_id' => $request->shop_id,
                    ], [
                        'url' => $request->product_offer_url[$indice],
                        'price' => $request->product_offer_price[$indice],
                        'user_id' => Auth::user()->id,
                        'updated_at' => new \DateTime(),
                        'deleted_at' => null
                    ]);
                }
            }

            return redirect()->route("manage-shops")->with('message', trans('Produits et offres ajoutées'));
        }
        catch (\Exception $e){

            return redirect()->back()->with('message', trans($e->getMessage()));
        }
    }

    private function save(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer|exists:products,id',
            'brand_id' => 'required|integer',
            'name' => 'required|string'
        ]);

        if ($request->id) {
            $product = Product::findorfail($request->id);

            $product->name = $request->name;
            $product->prop1 = $request->prop1;
            $product->prop2 = $request->prop2;
            $product->prop3 = $request->prop3;
            $product->prop4 = $request->prop4;
            $product->prop5 = $request->prop5;
            $product->gtin = $request->gtin;
        }
        elseif( !empty($request->gtin) ) {
            $product = Product::updateOrCreate(['gtin' => $request->gtin], $request->only(['brand_id', 'name', 'prop1', 'prop2', 'prop3', 'prop4', 'prop5']));
            $product->user_id = Auth::user()->id;
        }
        else{
            $product = Product::create($request->only(['brand_id', 'name', 'prop1', 'prop2', 'prop3', 'prop4', 'prop5', 'gtin']));
            $product->user_id = Auth::user()->id;
        }
        $product->save();
        $this->log('create', 'product', $product->id);

        return $product;
    }

}
