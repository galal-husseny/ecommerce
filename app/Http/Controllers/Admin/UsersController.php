<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\Address;

class UsersController extends Controller
{
    public const AVAILABLE_STATUS = ['مفعل' => 1, 'وهمي' => 0, 'محظور' => 2];
    public const AVAILABLE_EXTENSIONS = ['png', 'jpg', 'jpeg'];
    public function __construct()
    {
        $this->middleware('permission:Index Users,admin')->only('index');
        $this->middleware('permission:Store Users,admin')->only('create', 'store');
        $this->middleware('permission:Update Users,admin')->only('edit', 'update');
        $this->middleware('permission:Destroy Users,admin')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view('admin.users.create', ['statuses' => self::AVAILABLE_STATUS, 'regions' => $regions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = [
            'name' => $request->safe()->name,
            'email' => $request->safe()->email,
            'phone' => $request->safe()->phone,
            'gender' => $request->safe()->gender,
            'status' => $request->safe()->status,
            'password' => Hash::make($request->safe()->password),
            'email_verified_at' => $request->safe()->email_verified_at ? date('Y-m-d H:i:s') : NULL,
        ];
        DB::beginTransaction();
        try {
            $user = User::create($data);
            if ($request->address_exist == "true") {
                $user->addresses()->create($request->safe()->address);
            }
            if ($request->hasFile('image')) {
                $user->addMediaFromRequest('image')->toMediaCollection('users'); // store new image
            }
            DB::commit();
            return $this->redirectAccordingToRequest($request, 'success');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = $user->with('addresses.region.city')->where('id', $user->id)->first();
        $regions = Region::all();
        return view('admin.users.edit', ['statuses' => self::AVAILABLE_STATUS, 'user' => $user, 'regions' => $regions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = [
            'name' => $request->safe()->name,
            'email' => $request->safe()->email,
            'phone' => $request->safe()->phone,
            'gender' => $request->safe()->gender,
            'status' => $request->safe()->status,
            'email_verified_at' => $request->safe()->email_verified_at ? date('Y-m-d H:i:s') : NULL,
        ];
        $request->has('password') ? $data['password'] = Hash::make($request->safe()->password) : "";
        $user->update($data);
        if ($request->hasFile('image')) {
            if (isset($user->getMedia('users')[0])) {
                $user->getMedia('users')[0]->delete(); // remove old image
            }
            $user->addMediaFromRequest('image')->toMediaCollection('users'); // store new image
        }
        return redirect()->route('users.index')->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'تمت العملية بنجاح');
    }

    public function changeStatus(User $user)
    {
        $user->update(['status' => $user->status == 2 ? 1 : 2]);
        return redirect()->back()->with('success', 'تمت العملية بنجاح');
    }

    public function addresses(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id']
        ]);
        $addresses = Address::join('regions', function ($join) {
            $join->on('regions.id', '=', 'addresses.region_id');
            $join->where('regions.status', '=', 1);
        })->join('cities', function ($join) {
            $join->on('cities.id', '=', 'regions.city_id');
            $join->where('cities.status', '=', 1);
        })->select('addresses.*', 'regions.name AS region_name', 'cities.name AS city_name')
            ->where('user_id', $request->user_id)->where('addresses.status',1)->get();
            $addressCards = "";
            foreach($addresses AS $index=>$address){
                $index++;
                $addressCards .= "  <div class='col-6'>
                                        <div class='card'>
                                            <div class='card-header'>
                                                <label for='address_id'>عنوان ({$index})</label>
                                                <input type='radio' name='address_id' id='address_id' value='{$address->id}'>
                                            </div>
                                            <div class='card-body'>
                                                <h4 class='card-title'>{$address->getTranslation('city_name','ar')} - {$address->getTranslation('region_name','ar')}</h4>
                                                <p class='card-text'>
                                                <ul>
                                                    <li><b>الشارع :</b> {$address->street}</li>
                                                    <li><b>المبنى :</b> {$address->building}</li>
                                                    <li><b>الدور :</b> {$address->floor}</li>
                                                    <li><b>الشقة :</b> {$address->flat}</li>
                                                    <li><b>ملاحظات :</b> {$address->notes}</li>
                                                </ul>
                                                </p>
                                            </div>
                                           <div class='card-footer text-muted'>
                                                <a class='btn-link' target='_blank'
                                                    href='https://www.google.com/maps/search/?api=1&query={$address->latitude},%20{$address->longitude}'>View
                                                    On Map <i class='fa fa-map-marker' aria-hidden='true'></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>";
            }
        return response()->json(compact('addresses','addressCards'));
    }
}
