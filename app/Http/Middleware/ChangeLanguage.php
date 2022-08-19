<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ChangeLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(empty($request->header('accept-language'))){
            App::setLocale(config('app.locale'));
        }else{
            if(! in_array($request->header('accept-language'),config('app.accepted-languages'))){
                return response()->json(['errors'=>['language'=>'supported languages are ' .implode(',',config('app.accepted-languages')),'accept-language'=>$request->header('accept-language')]]);
            }
            App::setLocale($request->header('accept-language'));
        }
        return $next($request);
    }
}
