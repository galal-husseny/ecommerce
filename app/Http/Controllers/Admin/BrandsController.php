<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Brands\StoreBrandRequest;
use App\Http\Requests\Admin\Brands\UpdateBrandRequest;

class BrandsController extends Controller
{
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
        $brand = Brand::create($request->validated());
        $brand->addMediaFromRequest('image')->toMediaCollection('brands'); // store new image
        if ($request->has('resize')) {
            Image::make($brand->getFirstMediaPath('brands'))->resize($request->input('width'), $request->input('height'))->save($brand->getFirstMediaPath('brands')); // resize & override
        }
        return redirectAccordingToRequest($request, 'success');
    }

    public function edit(Brand $brand)
    {
        return view('Admin.brands.edit', ['brand' => $brand, 'statuses' => self::AVAILABLE_STATUS]);
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());
        if ($request->hasFile('image')) {
            $brand->getMedia('brands')[0]->delete(); // remove old image
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
}
