<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class SettingsController extends Controller
{
    const TIME = 31536000; // 1 year
    public function theme($mode)
    {
        return redirect()->back()->withCookie(cookie(Auth::guard('admin')->id(),$mode,time() + self::TIME,'/'));
    }
}
