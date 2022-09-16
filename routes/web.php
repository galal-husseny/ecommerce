<?php

use App\Mail\test;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Services\PermissionGenerator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ModelsController;
use App\Http\Controllers\Admin\RegionsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\Auth\Services\GithubLoginController;
use App\Http\Controllers\User\Auth\Services\GoogleLoginController;
use App\Http\Controllers\User\Auth\Services\FacebookLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',function(){
    echo "user";
});

Route::name('users.')->prefix('users')->group(function(){
    // Route::middleware('verified')->group(function(){
        Route::view('/','User.home');
    // });
    Auth::routes(['verify' => true]);
    Route::get('redirect/google',[GoogleLoginController::class,'redirectTo'])->name('google.login');
    Route::get('handle/google/callback',[GoogleLoginController::class,'handleCallback']);

    Route::get('redirect/github',[GithubLoginController::class,'redirectTo'])->name('github.login');
    Route::get('handle/github/callback',[GithubLoginController::class,'handleCallback']);

    Route::get('redirect/facebook',[FacebookLoginController::class,'redirectTo'])->name('facebook.login');
    Route::get('handle/facebook/callback',[FacebookLoginController::class,'handleCallback']);
});
