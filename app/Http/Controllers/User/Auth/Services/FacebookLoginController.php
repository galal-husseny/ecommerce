<?php
namespace App\Http\Controllers\User\Auth\Services;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\User\Auth\Services\SocialLogin;

class FacebookLoginController extends SocialLogin {

    public function redirectTo()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleCallback()
    {
        $user = Socialite::driver('facebook')->user();
        $this->loginOrRegister($user);
        return redirect('users');
    }
}
