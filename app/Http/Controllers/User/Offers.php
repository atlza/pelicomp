<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Shop;
use App\Traits\LogTrait;
use App\Traits\ParserTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Offers extends Controller
{
    use Logtrait;
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

            if( !$offerDatas = $this->readProductUrl( $offer->url, false ) ) throw new \Exception('Unable to read data from page');
            else{
                $offer->price = $offerDatas['price'];
                $offer->save();
            }

            $this->log('create', 'offer', $offer->id);

            return redirect()->route("home")->with('message', trans('Offre correctement ajoutée, prix ajouté'));
        } catch (\Exception $e) {
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }

    public function addMultiple(Request $request)
    {
        try {
            $request->validate([
                'urls' => 'required|string',
                'product_id' => 'required|integer|exists:products,id',
            ]);

            $urls = explode("\n", $request->urls);

            $offers_saved = 0;
            if( !empty( $urls ) ) foreach ($urls as $anUrl){
                $host = parse_url($anUrl, PHP_URL_HOST);

                if( $shop = Shop::where('url', $host)->first() ){
                    $offer = Offer::withTrashed()->updateOrCreate([
                        'product_id' => $request->product_id,
                        'shop_id' => $shop->id,
                    ], [
                        'url' => $anUrl,
                        'user_id' => Auth::user()->id,
                        'updated_at' => new \DateTime(),
                        'deleted_at' => null
                    ]);

                    $response = $this->callOneUrl($offer->url, false);
                    if( $offerDatas = $this->readHtmlResponse( $response, false ) ) {
                        $offer->price = $offerDatas['price'];
                        $offer->save();

                        $this->log('create', 'offer', $offer->id);

                        $offers_saved++;
                    }
                }
            }
            return redirect()->back()->with('message', trans($offers_saved . ' offres correctement ajoutées'));

        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }

    public function update(int $offerId)
    {
        try {

            $offer = Offer::find($offerId);

            $response = $this->callOneUrl($offer->url, false);
            if( !$offerDatas = $this->readHtmlResponse( $response, false ) ) throw new \Exception('Unable to read data from page');
            else{
                $offer->price = $offerDatas['price'];
                $offer->save();

                $this->log('update', 'offer', $offer->id);
            }

            return redirect()->back()->with('message', trans('Offre correctement enregistrée, prix ajouté'));
        } catch (\Exception $e) {
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }

    public function delete( Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:offers,id'
            ]);

            Offer::destroy($request->id);
            $this->log('delete', 'offer', $request->id);

            return redirect()->back()->with('message', trans('Offre supprimée'));
        } catch (\Exception $e) {
            return back()->with("error", trans('Erreur lors de la suppression des données'));
        }
    }
}
