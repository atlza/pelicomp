<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Shops extends Controller
{
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
            $shop = new Shop($request->only(['name', 'code', 'url']));
            $shop->user_id = Auth::user()->id;
            $shop->save();

            return redirect()->route("connected-shops")->with('message', trans('Boutique correctement ajoutée'));
        } catch (\Exception $e) {

            dd($e);
            return back()->with("error", trans('Erreur lors de l\'enregistrement des données'));
        }
    }
}
