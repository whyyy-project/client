<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    // redirect to the provider's authentication page
    public function redirect($provider)
    {
        return Socialite::driver($provider)
                          ->redirect();
    }

    // incoming request from the provider (e.g., Google, GitHub)
    public function callback($provider)
    {
      $providerUser = Socialite::driver($provider)->user();

        $user = User::updateOrCreate([
            'email' => $providerUser->getEmail() ?: Str::random(10) . '@example.com',
        ], [
            'name' => $providerUser->getName(),
            'avatar' => $providerUser->getAvatar(),
            'password' => bcrypt(Str::random(24)),
            'provider' => $provider,
            'provider_id' => $providerUser->id,
        ]);


        Auth::login($user);

        return redirect('/dashboard');
    }
}
