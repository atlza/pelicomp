<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Logs extends Controller
{
    public function all()
    {
        $logs = Log::where(
            'created_at', '>=', Carbon::now()->subMonth()->toDateTimeString()
        )->get();

        return view('components/connected/logs', [
            'logs' => $logs
        ]);
    }

}
