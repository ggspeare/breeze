<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class github extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        try {
           $user = Socialite::driver('github')->user();

            $gitUser = User::updateOrCreate([
                'github_id' => $user->id,
            ],[
                'name' => $user->name,
                'nickname' => $user->nickname,
                'email' => $user->email,
                'github_token' => $user->token,
                'auth_type' => 'github',
                'password' => Hash::make(Str::random(10))
            ]);

            Auth::login($gitUser);



            $request->session()->regenerate();

            return redirect()->intended(route('dashboard', absolute: false));


        } catch(\Exception $e) {
            $e->getMessage();
        }
    }

}
