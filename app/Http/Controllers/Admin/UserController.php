<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
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

        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('type', 3)->get();
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
    public function edit($id)
    {
        $user = User::find($id);
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
    public function update(Request $request, $id)
    {
        $arrayCheck = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
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
            $user = User::find($id);
            $user->update($input);

            DB::table('model_has_roles')->where('model_id', $id)->delete();
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
        // return $request->all();
        $password = User::find(Auth::id());
        // return $password;
        $arrayCheck = [
            'old_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed', 'different:old_password'],
        ];
        // return $arrayCheck;
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            if (Hash::check($request->old_password, $password->password)) {

                $password->password = Hash::make($request->new_password);
                $password->save();
                return response()->json(['success' => true, 'message' => 'Password Updated successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Old password is wrong!']);
            }
        }
    }
}
