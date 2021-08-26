<?php

namespace App\Http\Controllers\Admin;

use App\DropDown;
use App\DropDownOption;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DropDownController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:add-option', ['only' => ['add_options']]);
    }
    public function save_options(Request $request){

        $arrayCheck =  [
            'dropdown_id' => ['required', 'numeric'],
            "option_name"    => "required|array|min:1",
            "option_name.*"  => "required|string|min:1|unique:drop_down_options,option_name",
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $optionNames    =   $request->option_name;
            $dropDownId     =   $request->dropdown_id;
            $addoptions =   [];
            $i = 0;
            foreach($optionNames as $optionName){
                $addoptions[$i]['dropdown_id']  =   $dropDownId;
                $addoptions[$i]['option_name']  =   $optionName;
                $i++;

            }
            $addOption = DropDownOption::insert($addoptions);
            if($addOption){
                return response()->json(['success' => true, 'message' =>'Options added successfully']);
            }else{
                return response()->json(['success' => false, 'message' =>'Error while adding options']);
            }

        }
    }
    public function view_dropdown(){
        $dropdowns   =   DropDown::all();
        return view('dropdown.add_dropdown',compact('dropdowns'));
    }

    public function view_options(Request $request)
    {
        $view_options = DropDownOption::where('dropdown_id', 1);
        return Datatables::of($view_options)
            ->addColumn('option_name', function ($view_options) {
                $name = $view_options->option_name;
                return $name;
            })
            /*->editColumn('status', function ($users) {
                $chk = ($users->status == '1') ? "checked" : "";
                $b = '<a data-toggle="tooltip" title="'.__('Change status').'"><div class="custom-switch">
                      <input type="checkbox" class="custom-control-input myswitch" data-obj="users" id="customSwitches' . $users->id . '" ' . $chk . ' value="' . $users->id . '">
                      <label class="custom-control-label" for="customSwitches' . $users->id . '"></label>
                    </div></a>';
                return $b;
            })*/
            ->addColumn('action', function ($users) {
                $b = '<button class="bg-transparent text-danger border-0">Delete</button>';
                return $b;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
