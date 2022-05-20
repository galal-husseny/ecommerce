<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Sellers\StoreSellerRequest;
use App\Http\Requests\Admin\Sellers\UpdateSellerRequest;

class SellersController extends Controller
{
    public const AVAILABLE_STATUS = ['مفعل' => 1, 'غير مفعل' => 0];
    public const AVAILABLE_EXTENSIONS = ['png', 'jpg', 'jpeg'];

    public function __construct() {
        $this->middleware('permission:Index Sellers,admin')->only('index');
        $this->middleware('permission:Store Sellers,admin')->only('create','store');
        $this->middleware('permission:Update Sellers,admin')->only('edit','update');
        $this->middleware('permission:Destroy Sellers,admin')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::all();
        return view('admin.sellers.index',compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sellers.create',['statuses'=>self::AVAILABLE_STATUS]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSellerRequest $request)
    {
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'email_verified_at' => $request->email_verified_at ? date('Y-m-d H:i:s') : NULL,
            'status'=>$request->status,
            'gender'=>$request->gender,
            'national_id'=>$request->national_id,
            'social_links'=>json_encode($request->social_links)
        ];
        $seller = Seller::create($data);
        if($request->hasFile('image')){
            $seller->addMediaFromRequest('image')->toMediaCollection('sellers'); // store new image
        }
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
    public function edit(Seller $seller)
    {
        return view('Admin.sellers.edit',['seller'=>$seller,'statuses'=>self::AVAILABLE_STATUS]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSellerRequest $request, Seller $seller)
    {

        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'email_verified_at' => $request->email_verified_at ? date('Y-m-d H:i:s') : NULL,
            'status'=>$request->status,
            'gender'=>$request->gender,
            'national_id'=>$request->national_id,
            'social_links'=>json_encode($request->social_links)
        ];
        $request->has('password') ? $data['password'] = Hash::make($request->password) : "";
        $seller->update($data);
        if($request->hasFile('image')){
            if(isset($seller->getMedia('sellers')[0])){
                $seller->getMedia('sellers')[0]->delete(); // remove old image
            }
            $seller->addMediaFromRequest('image')->toMediaCollection('sellers'); // store new image
        }
        return redirect()->route('sellers.index')->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();
        return redirect()->route('sellers.index')->with('success', 'تمت العملية بنجاح');
    }
}
