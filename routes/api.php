<?php

use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Controllers\Admin\OffersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SpecsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Apis\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('category/specs/',[SpecsController::class,'specsByCategory']);
Route::post('product/media/destroy',[ProductsController::class,'mediaDestroy']);
Route::get('products/except/offer/',[OffersController::class,'productsNotInOffer']);
Route::get('category/products/',[CategoriesController::class,'products']);
Route::get('category/brands/',[CategoriesController::class,'brands']);
Route::get('brand/models/',[BrandsController::class,'models']);
Route::get('user/addresses/',[UsersController::class,'addresses']);
Route::post('apply/coupon/',[CouponsController::class,'apply']);

Route::get('products/search',[ProductController::class,'search']);
