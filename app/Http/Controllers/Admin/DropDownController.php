<?php

namespace App\Http\Controllers\Admin;
use App\DropDown;
use App\DropDownOption;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

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
            $secDropdownId  =   null;
            if($dropDownId == 4) { //Remarks for finance
                $secDropdownId  =   $request->sec_dropdown_id;
            }
            $addoptions =   [];
            $i = 0;
            foreach($optionNames as $optionName){
                $addoptions[$i]['dropdown_id']  =   $dropDownId;
                $addoptions[$i]['sec_dropdown_id']  =   $secDropdownId;
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
        $view_options = DropDownOption::where('dropdown_id',$request->dropdown_id)->get();
        return Datatables::of($view_options)
            ->addColumn('option_name', function ($view_options) {
                $secdropdown    =   "";
                if($view_options->sec_dropdown_id != ""){
                    switch ($view_options->sec_dropdown_id){
                        case 1 :
                            $text  =   'Intial Stage';
                            $color =   'btn-primary';
                            break;
                        case 2 :
                            $text  =   'Mid Stage';
                            $color =   'btn-warning';
                            break;
                        case 3 :
                            $text  =   'Final Stage';
                            $color =   'btn-success';
                            break;
                    }
                    $secdropdown    =   ' <span class="badge '.$color.'" >'.$text.'</span>';
                }
                $name = $view_options->option_name.$secdropdown;
                return $name;
            })
            ->addColumn('action', function ($view_options) {
                if($view_options->status == 1){
                    $statusColor    =   'btn-success';
                    $statusText     =   'Active';
                }else{
                    $statusColor    =   'btn-warning';
                    $statusText     =   'Inactive';
                }
                $b  =   '';
                if($view_options->dropdown_id == 4){
                    $b = '<button onclick="change_status(this);" data-status="'.$view_options->status.'" data-id="'.$view_options->id.'" class="btn '.$statusColor.' border-0"  >'.$statusText.'</button>';
                }
                $b .= '<button onclick="delete_option(this);" data-id="'.$view_options->id.'" class="bg-transparent text-danger border-0">Delete</button>';

                return $b;
            })
            ->rawColumns(['option_name','action'])
            ->make(true);
    }
    public function change_status(Request $request){
        if($request->status == 0){
            $status  =   1 ;
        }else{
            $status = 0;
        }
        $updateOption   =   DropDownOption::where('id',$request->option_id)->update(['status' => $status]);
        if($updateOption){
            return response()->json(['success' => true, 'message' =>'status updated successfully']);
        }else{
            return response()->json(['success' => false, 'message' =>'Error while updating status']);
        }
    }
    public function delete_option(Request $request){
        $deleteOption   =   DropDownOption::where('id',$request->option_id)->delete();
        if($deleteOption){
            return response()->json(['success' => true, 'message' =>'Options deleted successfully']);
        }else{
            return response()->json(['success' => false, 'message' =>'Error while deleting option']);
        }
    }
}
