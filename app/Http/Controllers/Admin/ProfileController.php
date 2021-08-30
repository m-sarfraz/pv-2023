<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:view-profile', ['only' => ['view_profile']]);
        $this->middleware('permission:save-profile', ['only' => ['save_profile']]);
    }
    public  function view_profile(){
        return view('profile.edit_profile');
    }
    public function save_profile(Request  $request){
        $userId = $request->user_id;
        $arrayCheck =  [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|unique:users,email,'.$userId,
        ];
        if($request->password != ""){
            $arrayCheck['password'] =   ['required', 'string', 'min:8'];
        }

        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $userdata   =   [
                'name'     => $request->name,
                'email'     => $request->email,
            ];

            if ($request->hasFile('profile')) {
                $file_name = $userId.time() . '.' . $request->profile->getClientOriginalExtension();
                $user = User::where('id', $userId)->first();
                if ($user->image != "") {
                    $userLogo = $user->image;
                    $delFile    =   Storage::delete($userLogo);
                    if (!$delFile) {
                        return response()->json(['success' => false, 'message' =>'Existing file not deleted']);
                    }
                }
                $filepath       = "public/".$userId."/".$request->image_type;
                $path = $request->file('profile')->storeAs($filepath, $file_name);
                //Storage::put($filepath, $file_name);
                $userdata['image']   =   $filepath.".".$file_name;
            }
            if ($request->password != '') {
                $userdata['password']   =   bcrypt($request->password);
            }
            $Where = ['id' => $userId];

            $UpdateUser = User::updateOrCreate($Where,$userdata);
            if($UpdateUser){
                return response()->json(['success' => true, 'message' =>'Profile Updated successfully']);
            }else{
                return response()->json(['success' => false, 'message' =>'Error while updating profile']);
            }

        }

    }
}
