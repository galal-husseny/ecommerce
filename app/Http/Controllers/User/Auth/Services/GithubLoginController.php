<?php
namespace App\Http\Controllers\User\Auth\Services;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\User\Auth\Services\SocialLogin;

class GithubLoginController extends SocialLogin {

    public function redirectTo()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleCallback()
    {
        $user = Socialite::driver('github')->user();
        $this->loginOrRegister($user);
        return redirect('users');
    }
}
