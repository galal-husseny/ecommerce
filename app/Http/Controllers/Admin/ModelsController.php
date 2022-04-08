<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Models;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Models\StoreModelRequest;
use Intervention\Image\Facades\Image;

class ModelsController extends Controller
{
    public const AVAILABLE_STATUS = ['مفعل' => 1, 'غير مفعل' => 0];
    public const AVAILABLE_EXTENSIONS = ['png', 'jpg', 'jpeg'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Models::all();
        return view('Admin.models.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        return view(
            'Admin.models.create',
            [
                'statuses' => self::AVAILABLE_STATUS, 'brands' => $brands
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModelRequest $request)
    {
        $model = Models::create( $request->validated());
        $model->addMediaFromRequest('image')->toMediaCollection('models'); // store new image
        if ($request->has('resize')) {
            Image::make($model->getFirstMediaPath('models'))->resize($request->input('width'), $request->input('height'))->save($model->getFirstMediaPath('models')); // resize & override
        }
        return redirectAccordingToRequest($request, 'success');
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
    public function edit(Models $model)
    {
        $brands = Brand::all();
        return view('Admin.models.edit',['model' => $model, 'brands' => $brands, 'statuses' => self::AVAILABLE_STATUS]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Models $model)
    {
        $model->update($request->all());
        if ($request->hasFile('image')) {
            $model->getMedia('models')[0]->delete(); // remove old image
            $model->addMediaFromRequest('image')->toMediaCollection('models');
        }

        if ($request->has('resize')) {
            $model = Models::find($model->id);
            Image::make($model->getFirstMediaPath('models'))->resize($request->input('width'), $request->input('height'))->save($model->getFirstMediaPath('models')); // resize & override
        }
        return redirect()->route('models.index')->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Models $model)
    {
        $model->delete();
        return redirect()->back()->with('success', 'تمت العملية بنجاح');
    }
}
