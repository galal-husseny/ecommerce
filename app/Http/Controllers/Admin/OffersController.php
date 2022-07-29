<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Offers\StoreOfferProductsRequest;
use App\Http\Requests\Admin\Offers\StoreOfferRequest;

class OffersController extends Controller
{
    public const AVAILABLE_STATUS = ['مفعل' => 1, 'غير مفعل' => 0,];
    public const AVAILABLE_EXTENSIONS = ['png', 'jpg', 'jpeg'];
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
        $products = Product::all();
        $offers = Offer::withCount('products')->get();
        return view('admin.offers.index',compact('offers','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('Admin.offers.create',['statuses'=>self::AVAILABLE_STATUS,'products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOfferRequest $request)
    {
        DB::beginTransaction();
        try{
            $offer = Offer::create($request->only('title','description','max_discount','start_at','end_at','status'));
            if(isset($request->products[0]['product_id'])){
                $offer->products()->attach($request->safe()->products);
            }
            if($request->hasFile('image')){
                $offer->addMediaFromRequest('image')->toMediaCollection('offers'); // store new image
            }
            DB::commit();
            return $this->redirectAccordingToRequest($request,'success');
        }catch(\Exception $e){
            dd($e->getMessage());
            DB::rollBack();
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
    public function edit(Offer $offer)
    {
        $offer = $offer->with('products:id')->where('id',$offer->id)->first();
        $products = Product::all();
        return view('Admin.offers.edit',['statuses'=>self::AVAILABLE_STATUS,'offer'=>$offer,'products'=>$products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOfferRequest $request, Offer $offer)
    {
        DB::beginTransaction();
        try{
            $offer->update($request->only('title','description','max_discount','start_at','end_at','status'));
            if(isset($request->products[0]['product_id'])){
                $offer->products()->detach();
                $offer->products()->attach($request->safe()->products);
            }
            if($request->hasFile('image')){
                if(isset($offer->getMedia('offers')[0])){
                    $offer->getMedia('offers')[0]->delete(); // remove old image
                }
                $offer->addMediaFromRequest('image')->toMediaCollection('offers'); // store new image
            }
            DB::commit();
            return redirect()->route('offers.index')->with('success','تمت العملية بنجاح');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error','هذا المنتج موجود في العرض');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return redirect()->route('offers.index')->with('success','تمت العملية بنجاح');
    }
    public function productsStore(StoreOfferProductsRequest $request)
    {
        $offer = Offer::find($request->safe()->offer_id);
        try{
            $offer->products()->attach($request->product_id,['discount' => $request->discount]);
            return redirect()->back()->with('success','تمت العملية بنجاح');
        }catch(\Exception $e){
            return redirect()->back()->with('error','هذا المنتج موجود في العرض');
        }
    }

    public function productsNotInOffer(Request $request)
    {
        $request->validate([
            'id'=>['required','integer','exists:offers']
        ]);
        $products = Product::select('id','name')->whereNotIn('id',function($subquery) use($request){
            $subquery->select('product_id AS id')
            ->from('offer_product')
            ->where('offer_product.offer_id', $request->id);
        })->get();
        $options = "<option value=''></option>";
         foreach($products AS $pro){
            $options.= "<option value='{$pro->id}'>{$pro->id}-{$pro->getTranslation('name','ar')} - {$pro->getTranslation('name','en')}</option>";
         }
        return response()->json(compact('options','products'));
    }
}
