<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function redirectAccordingToRequest($request,string $responseStatus) {
        if($responseStatus == 'success'){
            $message='تمت العملية بنجاح';
        }else{
            $message='فشلت العملية';
        }

        if($request->has('create')){
            return redirect()->action([static::class,'index'])->with($responseStatus,$message);
        }else{
            return redirect()->back()->with($responseStatus,$message);
        }
    }

}
