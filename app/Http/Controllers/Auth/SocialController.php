<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider_name)
    {
        return Socialite::driver($provider_name)->redirect();
    }

    public function callback($provider_name)
    {
        try {
            $user = Socialite::driver($provider_name)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $existingUser = User::where('provider_id', $user->getId())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $data = [
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'avatar' => $user->getAvatar(),
                'provider_name' => $provider_name,
                'provider_id' => $user->getId(),
                'password' => bcrypt(Str::random(16)),
            ];
            // return $data;
            $newUser = User::create($data);

            auth()->login($newUser, true);
        }

        return redirect('/');
    }
}
