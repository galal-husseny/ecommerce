<?php

namespace App\Http\Controllers\Admin;

use App\Models\Models;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductSpec;

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
        return view('Admin.products.index');
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
            ->selectRaw('CONCAT(`shops`.`name`, " - ", `sellers`.`name` ) AS `name` ')
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
            DB::beginTransaction();
            $product = Product::create($request->safe()->except(['images', 'specs']));
            if ($request->has('specs')) {
                foreach ($request->specs as $spec) {
                    $specData = [
                        'product_id'=>$product->id,
                        'spec_id' => $spec['spec_id'],
                        'value' => [
                            'en' => $spec['en'],
                            'ar' => $spec['ar']
                        ]
                    ];
                    ProductSpec::create($specData);
                }
            }
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $product->addMedia($image['image'])->toMediaCollection('products'); // store new image
                }
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
