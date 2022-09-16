<?php
namespace App\Http\Controllers\User\Auth\Services;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

abstract class SocialLogin extends Controller {
    public abstract function redirectTo(); // head to google
    public abstract function handleCallback(); // google head to your app
    public function loginOrRegister($userData)
    {
        $user = User::where('email',$userData->email)->first();
        if(!$user){
            $user = new User;
            $user->name = $userData->name;
            $user->email = $userData->email;
            $user->avatar = $userData->avatar . '&access_token=' .$userData->token;
            $user->provider_id = $userData->id;
            $user->save();
        }
        Auth::login($user);
    }
}
