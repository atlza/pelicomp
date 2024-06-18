<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Shop;
use App\Traits\ParserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Offers extends Controller
{
    use ParserTrait;

    public function add(Request $request)
    {
        try {
            $request->validate([
                'shop_id' => 'required|integer|exists:shops,id',
                'product_id' => 'required|integer|exists:products,id',
                'url' => 'required|url:http,https',
            ]);

            $shop = Shop::find($request->shop_id);

            if(!str_contains($request->url, $shop->url)) throw new \Exception('L\'url de l\'offre ne matche pas celle du site');

            $offer = Offer::updateOrCreate($request->only(['url', 'product_id', 'shop_id']));
            $offer->user_id = Auth::user()->id;
            $offer->save();

            if( !$offerDatas = $this->readFromUrl( $offer->url, true ) ) throw new \Exception('Unable to read data from page');
            else{
                $offer->price = $offerDatas['price'];
                $offer->save();
            }

            return redirect()->route("home")->with('message', trans('Offre correctement ajoutée, prix ajouté'));
        } catch (\Exception $e) {

            dd($e);
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }
}
