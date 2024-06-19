<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Users extends Controller
{
    public function users()
    {
        $users = User::all();
        return view('components/connected/users/users', [
            'users' => $users
        ]);
    }
}
