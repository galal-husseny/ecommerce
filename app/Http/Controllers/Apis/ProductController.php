<?php

namespace App\Http\Controllers\Apis;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\ProductSearch;

class ProductController extends Controller
{
    public function search(ProductSearch $request)
    {
        // sorting_filed => name , price
        // dir => asc , desc
        // s => keyword

        $products = Product::where('status',1);
        if($request->has('s')){
            $products->where(function($query) use($request){
                $query->where('name->en','LIKE',"%{$request->s}%");
                $query->orWhere('name->ar','LIKE',"%{$request->s}%");
            });
        }
        if($request->has('min_price') && $request->has('max_price')){
            $products->whereBetween('price',[$request->min_price,$request->max_price]);
        }
        if($request->has('sorting_field') && $request->has('dir')){
            $products->orderBy($request->sorting_field,$request->dir);
        }
        return response()->json($products->paginate(10));
    }
}
