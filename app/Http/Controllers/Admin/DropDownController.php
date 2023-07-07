<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateInformation;
use App\CandidatePosition;
use App\DropDown;
use App\DropDownOption;
use App\Endorsement;
use App\Finance;
use App\Http\Controllers\Controller;
use DB;
use App\Rules\UniqueOptionNames;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
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
        $dropdowns = DropDown::whereNotIn('type', ['domains', 'segments', 'sub_segment', 'candidates_profile', 'career_level'])->get();

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
            "option_name" => [
                "required",
                "array",
                "min:1",
                new UniqueOptionNames($request->drop_down_id)
            ],            "option_name.*" => "required|string|min:1",
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
        $dropdowns = DropDown::whereNotIn('type', ['domains', 'segments', 'sub_segment', 'candidates_profile', 'career_level'])->get();

        return view('dropdown.add_options', compact('dropdowns'));
    }
    public function ajax_view_dropdown(Request $request)
    {
        $dropdowns = DropDown::whereNotIn('type', ['domains', 'segments', 'sub_segment', 'candidates_profile', 'career_level', 'position_title'])->get();
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
                // dd($request->drop_down_type);
                if ($request->drop_down_type == 'application_status') {
                    $check = DB::table('endorsements')->where('app_status', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'candidates_profile') {
                    $check = DB::table('candidate_positions')->where('candidate_profile', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'career_level') {
                    $check = DB::table('endorsements')->where('career_endo', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'course') {
                    $check = DB::table('candidate_educations')->where('course', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'educational_attainment') {
                    $check = DB::table('candidate_educations')->where('educational_attain', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'domains') {
                    $check = DB::table('candidate_domains')->where('domain', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'segments') {
                    $check = DB::table('candidate_domains')->where('segment', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'sub_segment') {
                    $check = DB::table('candidate_domains')->where('sub_segment', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'manner_of_invite') {
                    $check = DB::table('candidate_positions')->where('manner_of_invite', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'position_title') {
                    $check = DB::table('endorsements')->where('position_title', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'reason_for_not_progressing') {
                    $check = DB::table('endorsements')->where('rfp', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'status') {
                    $check = DB::table('endorsements')->where('app_status', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'clients') {
                    $check = DB::table('endorsements')->where('client', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'endorsement_type') {
                    $check = DB::table('endorsements')->where('type', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'remarks_from_finance') {
                    $check = DB::table('endorsements')->where('remarks', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'site') {
                    $check = DB::table('endorsements')->where('site', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'source') {
                    $check = DB::table('candidate_positions')->where('source', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'gender') {
                    $check = DB::table('candidate_informations')->where('gender', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'certifications') {
                    $check = DB::table('candidate_educations')->where('certification', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'remarks_for_finance') {
                    $check = DB::table('endorsements')->where('remarks_for_finance', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'residence') {
                    $check = DB::table('candidate_informations')->where('address', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'data_entry_status') {
                    $check = DB::table('endorsements')->where('status', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'process_status') {
                    $check = DB::table('finance_detail')->where('process_status', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'clientClassification') {
                    $check = DB::table('jdl')->where('client_classification', $view_options->option_name)->first();
                }
                if ($request->drop_down_type == 'reqClassification') {
                    $check = DB::table('jdl')->where('req_classification', $view_options->option_name)->first();
                }
                $b = '';
                if ($view_options->status == 1) {
                    $statusColor = 'btn-success';
                    $statusText = 'Active';
                } else {
                    $statusColor = 'btn-warning';
                    $statusText = 'Inactive';
                }

                if ($check != null) {
                    //$this->authorize('delete_option');
                    $route2 = Route("update-option");
                    $edit = 0;
                    $function2 = 'update_data(this,"' . $route2 . '","' . $edit . '")';
                    $b .= '<button id="option_edit" onclick=' . $function2 . '  data-id="' . $view_options->id . '-' . $request->drop_down_type . '" class="btn ml-2 btn-primary bi bi-pencil-square border-0">     </button>';
                    $b .= '<span  disalbed class= "btn border-2  ml-3 mr-3 bi bi-lock" style="color: #000; background-color: #c2c1c1; border-color: #5b5859;"> </span>';
                    $b .= '<button onclick="change_status(this);" data-status="' . $view_options->status . '" data-id="' . $view_options->id . '" class="btn ' . $statusColor . ' border-0"  >' . $statusText . '</button>';

                } else {
                    $route = Route("delete-option");

                    $function = 'delete_data(this,"' . $route . '")';

                    $route2 = Route("update-option");
                    $edit = 0;
                    $function2 = 'update_data(this,"' . $route2 . '","' . $edit . '")';
                    $b .= '<button id="option_edit" onclick=' . $function2 . '  data-id="' . $view_options->id . '-' . $request->drop_down_type . '" class="btn ml-2 btn-primary bi bi-pencil-square border-0">     </button>';
                    $b .= '<button onclick=' . $function . '  data-id="' . $view_options->id . '" class= "btn btn-danger ml-3 border-2 mr-3 bi bi-trash"> </button>';

                    $b .= '<button onclick="change_status(this);" data-status="' . $view_options->status . '" data-id="' . $view_options->id . '" class="btn ' . $statusColor . ' border-0  "  >' . $statusText . '</button>';
                    // $b .= '<button  disalbed class= "btn btn-danger border-2 mr-3">Delete</button>';
                }
                // if ($request->drop_down_type == 'remarks_for_finance') {
                //     //$this->authorize('option-status');
                //     $b = '<button onclick="change_status(this);" data-status="' . $view_options->status . '" data-id="' . $view_options->id . '" class="btn ' . $statusColor . ' border-0"  >' . $statusText . '</button>';
                // }
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
    public function update_option(Request $request)
    {
        $arrayCheck = [
            "option_name" => "required|unique:drop_down_options,option_name",
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $id = explode('-', $request->id);
            DropDownOption::where('id', $id[0])->update([
                'option_name' => $request->option_name,
            ]);
            // return $id[1];
            switch ($id[1]) {
                case 'application_status':
                    Endorsement::where('app_status', $request->prevValue)->update(['app_status' => $request->option_name]);
                    break;

                case 'candidates_profile':
                    CandidatePosition::where('candidate_profile', $request->prevValue)->update(['candidate_profile' => $request->option_name]);
                    break;
                case 'career_level':
                    Endorsement::where('career_endo', $request->prevValue)->update(['career_endo' => $request->option_name]);
                    Finance::where('career_finance', $request->prevValue)->update(['career_finance' => $request->option_name]);
                    break;

                case 'course':
                    CandidateEducations::where('course', $request->prevValue)->update(['course' => $request->option_name]);
                    break;
                case 'educational_attainment':
                    CandidateEducations::where('educational_attain', $request->prevValue)->update(['educational_attain' => $request->option_name]);
                    break;
                case 'domains':
                    Endorsement::where('domain_endo', $request->prevValue)->update(['domain_endo' => $request->option_name]);
                    CandidateDomain::where('domain', $request->prevValue)->update(['domain' => $request->option_name]);
                    break;
                case 'segments':
                    Endorsement::where('segment_endo', $request->prevValue)->update(['segment_endo' => $request->option_name]);
                    CandidateDomain::where('segment ', $request->prevValue)->update(['segment ' => $request->option_name]);
                    break;
                case 'sub_segment':
                    Endorsement::where('sub_segment_endo', $request->prevValue)->update(['sub_segment_endo' => $request->option_name]);
                    CandidateDomain::where('sub_segment ', $request->prevValue)->update(['sub_segment ' => $request->option_name]);
                    break;

                case 'manner_of_invite':
                    CandidatePosition::where('manner_of_invite', $request->prevValue)->update(['manner_of_invite' => $request->option_name]);
                    break;
                case 'position_title':
                    Endorsement::where('position_title', $request->prevValue)->update(['position_title' => $request->option_name]);
                    break;
                case 'reason_for_not_progressing':
                    Endorsement::where('rfp', $request->prevValue)->update(['rfp' => $request->option_name]);
                    break;
                case 'status':
                    JDL::where('status', $request->prevValue)->update(['status' => $request->option_name]);
                    break;
                case 'clients':
                    Finance::where('client_finance', $request->prevValue)->update(['client_finance' => $request->option_name]);
                    Endorsement::where('client ', $request->prevValue)->update(['client ' => $request->option_name]);
                    break;
                case 'endorsement_type':
                    Endorsement::where('type', $request->prevValue)->update(['type' => $request->option_name]);
                    break;
                case 'remarks_from_finance':
                    Endorsement::where('remarks', $request->prevValue)->update(['remarks' => $request->option_name]);
                    break;
                case 'site':
                    Endorsement::where('site', $request->prevValue)->update(['site' => $request->option_name]);
                    break;
                case 'source':
                    CandidatePosition::where('source', $request->prevValue)->update(['source' => $request->option_name]);
                    break;
                case 'gender':
                    CandidateInformation::where('gender', $request->prevValue)->update(['gender' => $request->option_name]);
                    break;
                case 'certifications':
                    CandidateEducations::where('certification', $request->prevValue)->update(['certification' => $request->option_name]);
                    break;
                case 'remarks_for_finance':
                    Endorsement::where('remarks_for_finance', $request->prevValue)->update(['remarks_for_finance' => $request->option_name]);
                    break;
                case 'residence':
                    CandidateInformation::where('address', $request->prevValue)->update(['address' => $request->option_name]);
                    break;
                case 'data_entry_status':
                    Endorsement::where('status', $request->prevValue)->update(['status' => $request->option_name]);
                    break;
                    //
            }
            return response()->json(['success' => true, 'message' => 'Option updated successfully']);

        }
    }
}
