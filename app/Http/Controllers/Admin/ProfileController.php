<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public  function view_profile(){
        return view('profile.edit_profile');
    }
    public function save_profile(Request  $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'min:8'],

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => false, 'error' => $validator->errors()->all()]);
        } else {


        }


        /*if ($request->hasFile('profile')) {
            $file_name = time() . '.' . $request->profile->getClientOriginalExtension();
            $customerLogo = UsersMeta::where(['user_id' => $userId, 'meta_key' => 'customer_logo'])->exists();
            if ($customerLogo) {
                $customerLogo = UsersMeta::where(['user_id' => $userId, 'meta_key' => 'customer_logo'])->value('meta_value');
                $destinationPath = base_path() . '/assets/img/customer_logo/';
                $delFile = File::delete($destinationPath . $customerLogo);
                if (!$delFile) {
                    return response()->json(['success' => false, 'message' => __('Existing file not deleted')]);
                }
            }
            $request->profile->move(base_path() . '/assets/img/customer_logo/', $file_name);
            UsersMeta::updateOrCreate(['user_id' => $userId, 'meta_key' => 'customer_logo'], ['meta_value' => $file_name]);

        }*/

    }
}
