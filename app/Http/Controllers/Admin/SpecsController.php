<?php

namespace App\Http\Controllers\Admin;

use App\Models\Spec;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Specs\StoreSpecRequest;
use App\Http\Requests\Admin\Specs\UpdateSpecRequest;

class SpecsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specs = Spec::all();
        return view('Admin.specs.index',compact('specs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = Category::whereIsLeaf()->get();
        return view('Admin.specs.create',compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpecRequest $request)
    {
        try{
            foreach($request->specs AS $spec)
            {
                DB::beginTransaction();
                $insertedSpec = Spec::create(['name' => [
                    'en' => $spec['en'],
                    'ar' => $spec['ar']
                ]]);
                $insertedSpec->categories()->attach($spec['category_id']);
                DB::commit();
            }
            return $this->redirectAccordingToRequest($request,'success');
        }catch(\Exception $e){
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
    public function edit(Spec $spec)
    {
        $subcategories = Category::whereIsLeaf()->get();
        $spec = $spec->with('categories:id,name')->select('id','name')->where('id',$spec->id)->first();
        return view('Admin.specs.edit',compact('spec','subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpecRequest $request, Spec $spec)
    {
        DB::beginTransaction();
        try{
            $spec->update($request->safe()->only('name'));
            $spec->categories()->sync($request->category_id);
            DB::commit();
            return redirect()->route('specs.index')->with('success','تمت العملية بنجاح');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('specs.index')->with('error',' فشلت العملية بنجاح');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spec $spec)
    {
        $spec->delete();
        return redirect()->route('specs.index')->with('success','تمت العملية بنجاح');
    }

    public function specsByCategory(Request $request)
    {
        $request->validate([
            'id'=>['required','integer','exists:category_spec,category_id']
        ]);
        $category = Category::find($request->id);
         $specs = $category->specs()->select('id','name')->get();
         $options = "<option value=''></option>";
         foreach($specs AS $spec){
            $options.= "<option value='{$spec->id}'>{$spec->getTranslation('name','ar')} - {$spec->getTranslation('name','en')}</option>";
         }
         return response()->json(['options'=>$options]);
    }
}
