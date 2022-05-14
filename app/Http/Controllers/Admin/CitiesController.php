<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Cities\StoreCityRequest;
use App\Http\Requests\Admin\Cities\UpdateCityRequest;

class CitiesController extends Controller
{
    public function __construct() {
        $this->middleware('permission:Index Cities,admin')->only('index');
        $this->middleware('permission:Store Cities,admin')->only('create','store');
        $this->middleware('permission:Update Cities,admin')->only('edit','update');
        $this->middleware('permission:Destroy Cities,admin')->only('destroy');
    }
    public const AVAILABLE_STATUS = ['مفعل' => 1, 'غير مفعل' => 0];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('Admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.cities.create', ['statuses' => self::AVAILABLE_STATUS]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        City::create( $request->validated() );
        return $this->redirectAccordingToRequest($request, 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        return view('Admin.cities.edit', ['city' => $city, 'statuses' => self::AVAILABLE_STATUS]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->validated());
        return redirect()->route('cities.index')->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( City $city)
    {
        $city->delete();
        return redirect()->route('cities.index')->with('success', 'تمت العملية بنجاح');
    }
}
