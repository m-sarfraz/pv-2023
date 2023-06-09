<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {

        $this->middleware('permission:view-users', ['only' => ['index']]);
        $this->middleware('permission:add-user', ['only' => ['create', 'store']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('type', 3)->orderby("id", "DESC")->get();
        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrayCheck = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'phone' => 'required',
            'roles' => 'required',
            'agent' => "required",
        ];

        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $input = $request->all();
            $input['agent'] = $request->agent;
            $input['password'] = Hash::make($input['password']);
            $input['type'] = 3;

            $user = User::create($input);
            $user->assignRole($request->input('roles'));
            if ($user) {

                //save USER addeed log to table starts
                Helper::save_log('USER_CREATED');
                // save USER added to log table ends

                return response()->json(['success' => true, 'message' => 'User Created successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error while creating User']);
            }
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
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        // $password = Crypt::decrypt($user->password);
        // dd($password);
        return view('user.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $arrayCheck = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required',
            'roles' => 'required',
            'agent' => 'required',
        ];
        // if ($request->password && !empty($request->password)) {
        //     $arrayCheck['password'] = ['required', 'string', 'min:8', 'confirmed'];
        // }
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $input = $request->all();
            $input['agent'] = $request->agent;
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = $request->except(['password']);
            }
            $user = User::find($user->id);
            $user->update($input);

            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            $user->assignRole($request->input('roles'));
            if ($user) {
                //save USER addeed log to table starts
                Helper::save_log('USER_UPDATED');
                // save USER added to log table ends
                return response()->json(['success' => true, 'message' => 'User Updated successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error while updating User']);
            }
        }
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
    public function updatePassword(Request $request)
    {
        $password = User::find($request->id);
        // return $password;
        $arrayCheck = [
            // 'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        // return $arrayCheck;
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            // if (Hash::check($request->old_password, $password->password)) {

            $password->password = Hash::make($request->new_password);
            $password->save();
            return response()->json(['success' => true, 'message' => 'Password Updated successfully']);
            // } else {
            // return response()->json(['success' => false, 'message' => 'Old password is wrong!']);
            // }
        }
    }
    public function redirectThankyou(Request $request, $cid, $uid)
    {
        $activity = DB::table('users')->where('id', $uid)->first('activity_timeStamp');
        if ($activity->activity_timeStamp >= time()) {
            DB::table('users')->where('id', $uid)->limit(1)
                ->update([
                    'redirect' => 1,
                    'cid' => $cid,
                ]);
            $data = [
                'cid' => $cid,
                'uid' => $uid,
            ];
            return view('user.thankYou', $data);
        } else {
            return response()->json(['Acknowledge' => 'user is not logged in yet!']);
        }
    }
    public function checkIfQRScanned()
    {
        if (\Auth::user()->redirect == 1) {
            DB::table('users')->where('id', \Auth::user()->id)->limit(1)
                ->update([
                    'redirect' => 0,
                    'cid' => 0,
                ]);

            $id = \Auth::user()->cid;
            // $url = url('admin/record');
            $url = url('admin/record/' . '?id=' . $id);

            return response()->json(['success' => true, 'message' => 'sucessfully redirected', 'id' => $id, 'url' => $url]);
        } else {
            return response()->json(['success' => false, 'message' => 'Dont redirect']);

        }
    }

    // public function redirectQrCode(Request $request, $cid, $uid)
    // {
    //     $activity = DB::table('users')->where('id', $uid)->first('activity_timeStamp');
    //     if ($activity->activity_timeStamp >= time()) {
    //         dd('logged in');

    //     } else {
    //         return response()->json(['Acknowledge' => 'user is not logged in yet!']);
    //     }
    // }
    public function saveActivity()
    {
        DB::table('users')->where('id', \Auth::user()->id)->limit(1)
            ->update([
                'activity_timeStamp' => time() + 30,
            ]);
    }
    public function changeStatus(Request $request)
    {
        try {
            if (isset($request->dropdown)) {
                User::where('id', $request->id)->update(['showDropdown' => $request->dropdown]);
            }
            if (isset($request->status)) {
                User::where('id', $request->id)->update(['status' =>  $request->status]);
            }
            return response()->json(['success' => true, 'message' => 'Changes have been made successfully']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);

        }
    }
}
