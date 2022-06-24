<?php

namespace App\Http\Controllers\Admin;

use App\Models\Spec;
use App\Models\Brand;
use App\Models\Models;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSpec;
use Illuminate\Http\Request;
use App\Services\ProductCode;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Admin\products\StoreProductRequest;
use App\Http\Requests\Admin\products\UpdateProductRequest;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Index Products,admin')->only('index');
        $this->middleware('permission:Store Products,admin')->only('create', 'store');
        $this->middleware('permission:Update Products,admin')->only('edit', 'update');
        $this->middleware('permission:Destroy Products,admin')->only('destroy');
    }
    public const AVAILABLE_STATUS = ['مفعل' => 1, 'غير مفعل' => 0];
    public const AVAILABLE_EXTENSIONS = ['png', 'jpg', 'jpeg'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::leftJoin('categories','categories.id','=','products.category_id')
        ->leftJoin('models','models.id','=','products.model_id')
        ->leftJoin('brands','brands.id','=','models.brand_id')
        ->leftJoin('shops','shops.id','=','products.shop_id')
        ->leftJoin('sellers','sellers.id','=','shops.seller_id')
        ->select('products.*','categories.name AS category_name',
        'brands.name AS brand_name','models.name AS model_name'
        ,'shops.name AS shop_name','sellers.name AS seller_name',
        'sellers.id AS seller_id')->latest()->get();
        return view('Admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereIsLeaf()->get();
        $models = Brand::rightJoin('models', 'brands.id', '=', 'models.brand_id')
            ->select('models.id', 'models.name AS model_name', 'brands.name AS brand_name')->get();
        $shops =  DB::table('shops')
            ->leftJoin('sellers', 'sellers.id', '=', 'shops.seller_id')
            ->select('shops.id')
            ->selectRaw('CONCAT(shops.name, " - ", sellers.name ) AS name ')
            ->get();
        return view('Admin.products.create', [
            'statuses' => self::AVAILABLE_STATUS,
            'categories' => $categories,
            'models' => $models,
            'shops' => $shops,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $code = (new ProductCode)->setCategoryName($request->category_name)
            ->setBrandName($request->brand_name)->generate();
            DB::beginTransaction();
            $product = Product::create(array_merge(
                $request->safe()->except(['images', 'specs','category_name','model_name'])
                ,['code'=>$code]
            ));
            $product->storeSpecs($request->specs);
            if (isset($request->images[0]['image'])) {
                $product->storeImages($request->images)->resize();
            }
            DB::commit();
            return $this->redirectAccordingToRequest($request, 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return $this->redirectAccordingToRequest($request, 'error');
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
    public function edit(Product $product)
    {
        $categories = Category::whereIsLeaf()->get();
        $models = Brand::rightJoin('models', 'brands.id', '=', 'models.brand_id')
            ->select('models.id', 'models.name AS model_name', 'brands.name AS brand_name')->get();
        $shops =  DB::table('shops')
            ->leftJoin('sellers', 'sellers.id', '=', 'shops.seller_id')
            ->select('shops.id')
            ->selectRaw('CONCAT(shops.name, " - ", sellers.name ) AS name ')
            ->get();
        $specs = Spec::get();
        $productSpecs = ProductSpec::where('product_id',$product->id)->get();
        return view('Admin.products.edit', [
            'statuses' => self::AVAILABLE_STATUS,
            'categories' => $categories,
            'models' => $models,
            'shops' => $shops,
            'specs' => $specs,
            'productSpecs'=> $productSpecs,
            'product'=> $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->update($request->safe()->except(['images', 'specs']));
            $product->updateSpecs($request->specs);
            if (isset($request->images[0]['image'])) {
                $product->storeImages($request->images)->resize();
            }
            DB::commit();
            return $this->redirectAccordingToRequest($request, 'success');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('products.index')->with('success', 'تمت العملية بنجاح');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'تمت العملية بنجاح');
    }
    public function mediaDestroy(Request $request)
    {
        $request->validate([
            'product_id'=>['required','integer','exists:products,id'],
            'media_id'=>['required','integer','exists:media,id']
        ]);
        $product = Product::find($request->product_id);
        $mediaItems = $product->getMedia('products');
            foreach($mediaItems AS $index => $item){
                if($item->id == $request->media_id){
                    $mediaItems[$index]->delete();
                    return response()->json(['success'=>true]);
                }
            }
            return response()->json(['success'=>false],404);
    }



}
