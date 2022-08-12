<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;

class OrdersController extends Controller
{
    public const AVAILABLE_STATUS = ['ملغي' => 0,'جاري التجهيز' => 1, 'تم الشحن'=>2,'تم الوصول'=>3];
    public function __construct() {
        $this->middleware('permission:Index Orders,admin')->only('index');
        $this->middleware('permission:Store Orders,admin')->only('create','store');
        $this->middleware('permission:Update Orders,admin')->only('edit','update');
        $this->middleware('permission:Destroy Orders,admin')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::withCount('products')->with('coupon:id,code')->latest()->get();
        return view('Admin.orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereIsLeaf()->whereIn('id',function($subQuery){
            $subQuery->select('category_id')->from('products');
        })->get();
        $brands = Brand::all();
        $users = User::all();
        return view('Admin.orders.create',['categories'=>$categories,'brands'=>$brands,'users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
