<?php

use Illuminate\Support\Str;

function redirectAccordingToRequest($request,string $responseStatus) {
    if($responseStatus == 'success'){
        $message='تمت العملية بنجاح';
    }else{
        $message='فشلت العملية';
    }
    if($request->has('create')){
        $routeName = Str::replace('store', 'index', $request->route()->getName());
        return redirect()->route( $routeName )->with($responseStatus,$message);
    }else{
        return redirect()->back()->with($responseStatus,$message);
    }
}
