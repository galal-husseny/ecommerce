<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\Order\OrderCode;
use Illuminate\Support\Facades\DB;
use App\Services\Discount\Discount;
use App\Http\Controllers\Controller;
use App\Services\Order\OrderProducts;
use App\Services\Discount\FixedDiscount;
use App\Services\Discount\PercentageDiscount;
use App\Services\Coupon\Coupon AS CouponService;
use App\Http\Controllers\Admin\CouponsController;
use App\Http\Requests\Admin\Orders\StoreOrderRequest;
use App\Services\Order\OrderMails;

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
            $subQuery->select('category_id')
            ->from('products')
            ->where('status',ProductsController::AVAILABLE_STATUS['مفعل'])
            ->where('quantity','<>',0);
            // status = 1
        })->where('status',CategoriesController::AVAILABLE_STATUS['مفعل'])->get();
        $users = User::join('addresses', function ($join) {
            $join->on('users.id', '=', 'addresses.user_id')
                 ->where('addresses.status', '=', 1);
        })->select('users.id','users.name','users.email','users.phone',DB::raw('COUNT(addresses.id) as addresses_count'))
        ->where('users.status','!=',UsersController::AVAILABLE_STATUS['محظور'])
        ->whereNotNull('users.email_verified_at')->groupBy('addresses.user_id')->get();
        $payments = Payment::where('status',PaymentsController::AVAILABLE_STATUS['مفعل'])->get();
        return view('Admin.orders.create',
        compact('categories','users','payments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        // validation
        $shipping = 0;
        $total_price = OrderProducts::set($request->products)->totalPrice();
        $final_price = $total_price;
        if($request->filled('coupon')){
            $coupon = Coupon::where('code',$request->coupon)->first();
            $errors = CouponService::validateApi($coupon,$request->user_id,$total_price);
            if(! empty($errors)){
                // test
                return response()->json(['errors'=>$errors],422);
            }

            $discount = Discount::make($coupon->discount_type == CouponsController::PERCENTAGE ?
            new PercentageDiscount($coupon,$total_price) :
            new FixedDiscount($coupon,$total_price)
            );
            $final_price = $discount->priceAfterDiscount;
        }
        $code = OrderCode::generate();
        DB::beginTransaction();
        $orderProducts = OrderProducts::set($request->products)->orderProductsData();
        try{
            $newOrder = Order::create([
                'total_price'=>$total_price,
                'final_price'=>$final_price,
                'shipping'=>$shipping,
                'code'=>$code,
                'coupon_id'=>$coupon->id ?? null,
                'address_id'=>$request->address_id,
                'payment_id'=>$request->payment_id,
            ]);
            $newOrder->products()->attach($orderProducts);
            foreach($orderProducts AS $productId=>$values){
                Product::where('id',$productId)->decrement('quantity', $values['quantity']);
            }
            DB::commit();
            $dbTransactions = true;

        }catch(\Exception $e){
            // dd($e->getMessage());
            $dbTransactions = false;
            DB::rollBack();
        }
        if($dbTransactions){
            $mailData = OrderProducts::set($request->products)->mailData($request->address_id,$newOrder);
            OrderMails::set($mailData)->sendMails();
            return response()->json(['success'=>true,'redirect'=>$request->has('create-return') ? url()->previous() : route('orders.index')]);
        }else{
            return response()->json(['errors'=>['something'=>'Something Went Wrong']],500);
        }

        // save data into db
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
