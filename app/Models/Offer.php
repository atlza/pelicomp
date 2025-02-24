<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['shop_id', 'url', 'product_id', 'deleted_at', 'user_id', 'price'];
    protected $dates = ['created_on', 'updated_at'];

    public static function allByProductAndShop()
    {
        $offersSorted = [];

        $visibleShops = Shop::where('hidden', false)->get();
        $offers = Offer::whereIn('shop_id', $visibleShops->pluck('id'))->get();
        foreach ($offers as $anOffer) {
            if( !isset($offersSorted[$anOffer->product_id]) )  $offersSorted[$anOffer->product_id] = [];

            $offersSorted[$anOffer->product_id][$anOffer->shop_id] = $anOffer;
        }
        return $offersSorted;
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function shop(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function logs()
    {
        return $this->morphMany('App\Models\Log', 'logable');
    }

}
