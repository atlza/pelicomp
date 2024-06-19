<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\noPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Authenticate extends Controller
{
    public function signin()
    {
        return view('components/front/signin');
    }

    public function authWithToken( $token )
    {
        $tokenCacheKey = "pwl.tkn.{$token}";
        $userId = Cache::get($tokenCacheKey);

        abort_if($userId == null, 401);

        $user = User::findOrFail($userId);
        Auth::login($user);
        Cache::forget($tokenCacheKey);

        return redirect('/');
    }


    public function authenticate( Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::query()
            ->where('email', $request->email)
            ->firstOrCreate([
                'email' => $request->email],
                [
                    'password' => Str::random(16),
                    'name' => $request->email
                ]
            );



        if ($user) {
            $token = Str::orderedUuid();

            Cache::put("pwl.tkn.{$token}", $user->id, 10 * 60);

            $passwordlessUrl = route('signin-token', [
                'token' => $token
            ]);

            $user->notify(new noPasswordNotification(url: $passwordlessUrl));
        }
        // else... we send always a success message to avoid any "info extraction"

        return back()->with('message', 'You have an email!');
    }

}
