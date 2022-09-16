<?php
namespace App\Http\Controllers\User\Auth\Services;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\User\Auth\Services\SocialLogin;

class GoogleLoginController extends SocialLogin {

    public function redirectTo()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->loginOrRegister($user);
        return redirect('users');
    }
}
