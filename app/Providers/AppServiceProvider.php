<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try{
            $admin = Admin::first();
            if($admin){
                config(['app.admins'=>false]);
            }
        }catch(\Exception $e){
            
        }

    }
}
