<?php

namespace App\Http\Controllers\Admin;

use App\DropDown;
use App\DropDownOption;
use App\Http\Controllers\Controller;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DropDownController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-dropdowns', ['only' => ['view_dropdown']]);
        $this->middleware('permission:add-dropdown', ['only' => ['save_dropdown']]);
        $this->middleware('permission:delete-dropdowns', ['only' => ['delete_option']]);
        // $this->middleware('permission:option-status', ['only' => ['change_status']]);
    }
    public function show_dropdown_form()
    {
        $dropdowns = DropDown::all();
        return view('dropdown.add_dropdown', compact('dropdowns'));
    }
    public function save_dropdown(Request $request)
    {
        $arrayCheck = [
            'name' => ['required', 'unique:drop_downs,name'],
            'type' => ['required', 'unique:drop_downs,type'],
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $data = [
                'name' => $request->name,
                'type' => $request->type,
            ];
            $addDropDown = DropDown::create($data);
            if ($addDropDown) {
                //save DROPDOWN addeed log to table starts
                Helper::save_log('DROPDOWN_CREATED');
                // save DROPDOWN added to log table ends
                return response()->json(['success' => true, 'message' => 'DropDown added successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error while adding DropDown']);
            }
        }
    }
    public function save_options(Request $request)
    {
        $arrayCheck = [
            'drop_down_id' => ['required', 'numeric'],
            "option_name" => "required|array|min:1",
            "option_name.*" => "required|string|min:1|unique:drop_down_options,option_name",
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $optionNames = $request->option_name;
            $dropDownId = $request->drop_down_id;
            $secDropdownId = null;
            if ($dropDownId == 4) { //Remarks for finance
                $secDropdownId = $request->sec_dropdown_id;
            }
            $addoptions = [];
            $i = 0;
            foreach ($optionNames as $optionName) {
                $addoptions[$i]['drop_down_id'] = $dropDownId;
                $addoptions[$i]['sec_dropdown_id'] = $secDropdownId;
                $addoptions[$i]['option_name'] = $optionName;
                $i++;
            }
            $addOption = DropDownOption::insert($addoptions);
            if ($addOption) {
                return response()->json(['success' => true, 'message' => 'Options added successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error while adding options']);
            }
        }
    }
    public function view_dropdown()
    {
        $dropdowns = DropDown::all();
        return view('dropdown.add_options', compact('dropdowns'));
    }
    public function ajax_view_dropdown(Request $request)
    {
        $dropdowns = DropDown::all();
        return Datatables::of($dropdowns)
            ->addColumn('name', function ($dropdowns) {
                return $dropdowns->name;
            })
            ->addColumn('type', function ($dropdowns) {
                return $dropdowns->type;
            })
            ->rawColumns(['name', 'type', 'action'])
            ->make(true);
    }
    public function view_options(Request $request)
    {
        $dropdowntype = DropDown::with('options')->where('type', $request->drop_down_type)->first();
        $view_options = $dropdowntype->options;
        return Datatables::of($view_options)
            ->addColumn('option_name', function ($view_options) {
                $secdropdown = "";
                if ($view_options->sec_dropdown_id != "") {
                    switch ($view_options->sec_dropdown_id) {
                        case 1:
                            $text = 'Intial Stage';
                            $color = 'btn-primary';
                            break;
                        case 2:
                            $text = 'Mid Stage';
                            $color = 'btn-warning';
                            break;
                        case 3:
                            $text = 'Final Stage';
                            $color = 'btn-success';
                            break;
                    }
                    $secdropdown = ' <span class="badge ' . $color . '" >' . $text . '</span>';
                }
                $name = $view_options->option_name . $secdropdown;
                return $name;
            })
            ->addColumn('action', function ($view_options) use ($request) {
                if ($view_options->status == 1) {
                    $statusColor = 'btn-success';
                    $statusText = 'Active';
                } else {
                    $statusColor = 'btn-warning';
                    $statusText = 'Inactive';
                }
                $b = '';
                if ($request->drop_down_type == 'remarks_for_finance') {
                    //$this->authorize('option-status');
                    $b = '<button onclick="change_status(this);" data-status="' . $view_options->status . '" data-id="' . $view_options->id . '" class="btn ' . $statusColor . ' border-0"  >' . $statusText . '</button>';
                }
                //$this->authorize('delete-option');
                $route = Route("delete-option");
                $function = 'delete_data(this,"' . $route . '")';
                $b .= '<button onclick=' . $function . '  data-id="' . $view_options->id . '" class="bg-transparent text-danger border-0">Delete</button>';

                return $b;
            })
            ->rawColumns(['option_name', 'action'])
            ->make(true);
    }
    public function change_status(Request $request)
    {
        if ($request->status == 0) {
            $status = 1;
        } else {
            $status = 0;
        }
        $updateOption = DropDownOption::where('id', $request->option_id)->update(['status' => $status]);
        if ($updateOption) {
            //save DROPDOWN_STATUS addeed log to table starts
            Helper::save_log('DRODOWN_STATUS_CHANGED');
            // save DROPDOWN_STATUS added to log table ends
            return response()->json(['success' => true, 'message' => 'status updated successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Error while updating status']);
        }
    }
    public function delete_option(Request $request)
    {
        $deleteOption = DropDownOption::where('id', $request->id)->delete();
        if ($deleteOption) {
            //save DROPDOWN addeed log to table starts
            Helper::save_log('DROPDOWN_DELETED');
            // save DROPDOWN added to log table ends
            return response()->json(['success' => true, 'message' => 'Options deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Error while deleting option']);
        }
    }
}
