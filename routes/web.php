<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ModelsController;
use App\Http\Controllers\Admin\RegionsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Controller;

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
Route::group(['prefix'=>'admin','middleware'=>'setAdminLang'],function(){
    Route::get('/',DashboardController::class)->name('dashboard');
    Route::prefix('brands')->name('brands.')->controller(BrandsController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('create','create')->name('create');
        Route::get('{brand}/edit','edit')->name('edit'); // 4 segments => admin->fixed , brands->fixed, {id}->variable , edit->fixed
        Route::post('store','store')->name('store');
        Route::put('{brand}/update','update')->name('update');
        Route::delete('{brand}/destroy','destroy')->name('destroy');
    });
    Route::resource('models', ModelsController::class)->except('show');
    Route::resource('cities', CitiesController::class)->except('show');
    Route::resource('regions', RegionsController::class)->except('show');
});


Route::group([],function(){

});

