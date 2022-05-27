<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\Region;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Shop\StoreShopRequest;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::with(['seller','region.city'])->get(); // select
        return view('Admin.shops.index',compact('shops'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $chooseSeller = false;
        if($request->has('seller_id')){
            $chooseSeller = $request->seller_id;
        }
        $sellers = Seller::orderBy('name')->get();
        $regions = Region::with('city')->get();
        return view('Admin.shops.create',compact('sellers','regions','chooseSeller'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopRequest $request)
    {
        Shop::create($request->validated());
        return $this->redirectAccordingToRequest($request,'success');
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
    public function edit(Request $request,Shop $shop)
    {
        $chooseSeller = false;
        if($request->has('seller_id')){
            $chooseSeller = $request->seller_id;
        }
        $sellers = Seller::orderBy('name')->get();
        $regions = Region::with('city')->get();
        return view('Admin.shops.edit',compact('sellers','regions','shop','chooseSeller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShopRequest $request, Shop $shop)
    {
        $shop->update($request->validated());
        return redirect()->back()->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect()->back()->with('success', 'تمت العملية بنجاح');

    }
}
