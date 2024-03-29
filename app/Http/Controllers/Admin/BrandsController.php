<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Brands\StoreBrandRequest;
use App\Http\Requests\Admin\Brands\UpdateBrandRequest;
use App\Models\Models;

class BrandsController extends Controller
{
    public function __construct() {
        $this->middleware('permission:Index Brands,admin')->only('index');
        $this->middleware('permission:Store Brands,admin')->only('create','store');
        $this->middleware('permission:Update Brands,admin')->only('edit','update');
        $this->middleware('permission:Destroy Brands,admin')->only('destroy');
    }
    public const AVAILABLE_STATUS = ['مفعل' => 1, 'غير مفعل' => 0];
    public const AVAILABLE_EXTENSIONS = ['png', 'jpg', 'jpeg'];
    public function index()
    {
        $brands = Brand::all();
        return view('Admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('Admin.brands.create', ['statuses' => self::AVAILABLE_STATUS]);
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create( $request->validated() );
        $brand->addMediaFromRequest('image')->toMediaCollection('brands'); // store new image
        if ($request->has('resize')) {
            Image::make($brand->getFirstMediaPath('brands'))->resize($request->input('width'), $request->input('height'))->save($brand->getFirstMediaPath('brands')); // resize & override
        }
        return $this->redirectAccordingToRequest($request, 'success');
    }

    public function edit(Brand $brand)
    {
        return view('Admin.brands.edit', ['brand' => $brand, 'statuses' => self::AVAILABLE_STATUS]);
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());
        if ($request->hasFile('image')) {
            if(isset($brand->getMedia('brands')[0])){
                $brand->getMedia('brands')[0]->delete(); // remove old image
            }
            $brand->addMediaFromRequest('image')->toMediaCollection('brands');
        }

        if ($request->has('resize')) {
            $brand = Brand::find($brand->id);
            Image::make($brand->getFirstMediaPath('brands'))->resize($request->input('width'), $request->input('height'))->save($brand->getFirstMediaPath('brands')); // resize & override
        }
        return redirect()->route('brands.index')->with('success', 'تمت العملية بنجاح');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->back()->with('success', 'تمت العملية بنجاح');
    }

    public function models(Request $request)
    {
        $request->validate([
            'brand_id'=>['required','integer','exists:brands,id'],
            'category_id'=>['required','integer','exists:categories,id']
        ]);
        $models = Models::select('id','name')->where('brand_id',$request->brand_id)
        ->whereIn('id',function($subquery) use($request){
            $subquery->select('model_id')
            ->distinct()
            ->from('products')
            ->where('category_id',$request->category_id)
            ->where('status',ProductsController::AVAILABLE_STATUS['مفعل'])
            ->where('quantity','<>',0);

            // status = 1
        })->get();
        $options = "<option value=''></option>";
         foreach($models AS $model){
            $options.= "<option value='{$model->id}'>{$model->id}-{$model->getTranslation('name','ar')} - {$model->getTranslation('name','en')} - {$model->year} </option>";
         }
        return response()->json(compact('options','models'));
    }
}
