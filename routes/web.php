<?php

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\PermissionGenerator;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ModelsController;
use App\Http\Controllers\Admin\RegionsController;
use App\Http\Controllers\Admin\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

