<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable = ['shop_id', 'url', 'product_id'];
    protected $dates = ['created_on', 'updated_at'];

    public static function allByProductAndShop()
    {
        $offersSorted = [];

        $offers = Offer::all();
        foreach ($offers as $anOffer) {
            if( !isset($offersSorted[$anOffer->product_id]) )  $offersSorted[$anOffer->product_id] = [];

            $offersSorted[$anOffer->product_id][$anOffer->shop_id] = $anOffer;
        }
        return $offersSorted;
    }

}
