<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Admins\EditAdminRequest;
use App\Http\Requests\Admin\Admins\StoreAdminRequest;
use App\Http\Requests\Admin\Admins\UpdateAdminRequest;

class AdminsController extends Controller
{
    public function __construct() {
        $this->middleware('superadmin.prevent.update')->only('edit','update','destroy');
        $this->middleware('permission:Index Admins,admin')->only('index');
        $this->middleware('permission:Store Admins,admin')->only('create','store');
        $this->middleware('permission:Update Admins,admin')->only('edit','update');
        $this->middleware('permission:Destroy Admins,admin')->only('edit','destroy');
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
        $admins = Admin::whereNot('id',1)->get(); // except super admin
        return view('Admin.admins.index',compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['Super Admin'])->get();
        return view('Admin.admins.create',['statuses'=>self::AVAILABLE_STATUS,'roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'email_verified_at' => $request->status ? date('Y-m-d H:i:s') : NULL,
        ];
        DB::beginTransaction();
        try{
            $admin = Admin::create($data);
            $admin->syncRoles($request->role_id);
            if($request->hasFile('image')){
                $admin->addMediaFromRequest('image')->toMediaCollection('admins'); // store new image
            }
            DB::commit();
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
    public function edit(Admin $admin,EditAdminRequest $request)
    {
        // if($request->admin->getRoleNames()->toArray()[0] == "Super Admin"  && $request->user('admin')->getRoleNames()->toArray()[0] == "Super Admin"){
        //     $roles = Role::whereIn('name', ['Super Admin'])->get();
        // }else{
        //     $roles = Role::whereNotIn('name', ['Super Admin'])->get();
        // }
        $roles = Role::all();
        return view('Admin.admins.edit',['statuses'=>self::AVAILABLE_STATUS,'roles'=>$roles,'admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'email_verified_at' => $request->status ? date('Y-m-d H:i:s') : NULL,
        ];
        $request->has('password') ? $data['password'] = Hash::make($request->password) : "";
        DB::beginTransaction();
        try{
            $admin->update($data);
            $admin->syncRoles($request->role_id);
            if($request->hasFile('image')){
                if(isset($admin->getMedia('admins')[0])){
                    $admin->getMedia('admins')[0]->delete(); // remove old image
                }
                $admin->addMediaFromRequest('image')->toMediaCollection('admins'); // store new image
            }
            DB::commit();
            return redirect()->route('admins.index')->with('success', 'تمت العملية بنجاح');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('admins.index')->with('success', 'فشلت العملية');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'تمت العملية بنجاح');
    }
}
