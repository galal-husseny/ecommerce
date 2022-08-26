<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\Coupon\Coupon AS CouponService;
use App\Services\Discount\Discount;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\Discount\PercentageDiscount;
use App\Http\Requests\Admin\Coupons\StoreCouponRequest;
use App\Http\Requests\Admin\Coupons\UpdateCouponRequest;
use App\Services\Discount\FixedDiscount;

class CouponsController extends Controller
{
    public const AVAILABLE_STATUS = ['مفعل' => 1, 'غير مفعل' => 0,];
    public const FIXED = 'f';
    public const PERCENTAGE = 'p';
    public function __construct() {
        $this->middleware('permission:Index Offers,admin')->only('index');
        $this->middleware('permission:Store Offers,admin')->only('create','store');
        $this->middleware('permission:Update Offers,admin')->only('edit','update');
        $this->middleware('permission:Destroy Offers,admin')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::withCount('orders')->get();
        return view('Admin.coupons.index',compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('Admin.coupons.create',['statuses'=>self::AVAILABLE_STATUS]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCouponRequest $request)
    {
        try{
            Coupon::create($request->except('_token','create','create-return'));
            return $this->redirectAccordingToRequest($request,'success');
        }catch(\Exception $e){
            dd($e->getMessage());
            return $this->redirectAccordingToRequest($request,'error');
        }
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
    public function edit(Coupon $coupon)
    {
        return view('Admin.coupons.edit',['statuses'=>self::AVAILABLE_STATUS,'coupon'=>$coupon]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
        try{
            $coupon->update($request->except('_token','create','create-return'));
            return $this->redirect()->route('coupons.index')->with('success','تمت العملية بنجاح');
        }catch(\Exception $e){
            // dd($e->getMessage());
            return $this->redirect()->route('coupons.index')->with('error','فشلت العملية ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back()->with('success','تمت العملية بنجاح');
    }

    public function apply(Request $request)
    {
        $request->validate([
            'code' => ['required', 'exists:coupons'],
            'user_id'=>['required','integer','exists:users,id'],
            'total_price'=>['required','numeric']
        ]);
        $coupon = Coupon::where('code',$request->code)->first();
        $errors = CouponService::validateApi($coupon,$request->user_id,$request->total_price);
        if(! empty($errors)){
            return response()->json(compact('errors'),422);
        }

        $discount = Discount::makeApi($coupon->discount_type == self::PERCENTAGE ?
        new PercentageDiscount($coupon,$request->total_price) :
        new FixedDiscount($coupon,$request->total_price)
        );
        return response()->json(compact('discount'));

    }
}
