<?php

namespace App\Traits;

use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

trait LogTrait
{
    public function log( $action, $modelType, $modelId = null) {
        $log = new Log();

        $log->action = $action;

        $log->logable_type = match ($modelType) {
            'brand' => 'App\Models\Brand',
            'offer' => 'App\Models\Offer',
            'product' => 'App\Models\Product',
            'shop' => 'App\Models\Shop',
            'user' => 'App\Models\User',
        };

        $log->logable_id = $modelId;
        if(Auth::user()) $log->user_id = Auth::user()->id;

        $log->save();
    }
}
