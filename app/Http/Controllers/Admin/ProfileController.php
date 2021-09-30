<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateEducation;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Domain;
use App\Endorsement;
use App\Finance;
use App\Http\Controllers\Controller;
use App\Segment;
use App\User;
use Auth;
use Config;
use DB;
use File;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Response;

class ProfileController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:view-profile', ['only' => ['view_profile']]);
        $this->middleware('permission:save-profile', ['only' => ['save_profile']]);
    }
    public function view_profile()
    {
        return view('profile.edit_profile');
    }
    public function save_profile(Request $request)
    {
        $userId = $request->user_id;
        $arrayCheck = [
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|unique:users,email,' . $userId,
        ];
        if ($request->password != "") {
            $arrayCheck['password'] = ['required', 'string', 'min:8'];
        }

        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $userdata = [
                'name' => $request->name,
                'email' => $request->email,
            ];

            if ($request->hasFile('profile')) {
                $file_name = $userId . time() . '.' . $request->profile->getClientOriginalExtension();
                $user = User::where('id', $userId)->first();
                if ($user->image != "") {
                    $userLogo = $user->image;
                    $delFile = Storage::delete($userLogo);
                    if (!$delFile) {
                        return response()->json(['success' => false, 'message' => 'Existing file not deleted']);
                    }
                }
                $filepath = "public/" . $userId . "/" . $request->image_type;
                $path = $request->file('profile')->storeAs($filepath, $file_name);
                //Storage::put($filepath, $file_name);
                $userdata['image'] = $filepath . "." . $file_name;
            }
            if ($request->password != '') {
                $userdata['password'] = bcrypt($request->password);
            }
            $Where = ['id' => $userId];

            $UpdateUser = User::updateOrCreate($Where, $userdata);
            if ($UpdateUser) {

                //save domain addeed log to table starts
                Helper::save_log('PROFILE_UPDATED');
                // save domain added to log table ends

                return response()->json(['success' => true, 'message' => 'Profile Updated successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error while updating profile']);
            }
        }
    }
    // function for Google sheet Import starts
    public function readsheet(\App\Services\GoogleSheet $googleSheet, Request $request)
    {
        // change configuration for google sheet ID
        $config = Config::get("datastudio.google_sheet_id");
        Config::set('datastudio.google_sheet_id', $request->sheetID);
        $config2 = Config::get("datastudio.google_sheet_id");
        $data = $googleSheet->readGoogleSheet($request->sheetID);

        // if sheet exist on google sheet with given id
        if (is_array($data)) {
            foreach ($data as $render_skipped_rows) {
                if (count($render_skipped_rows) > 1002) {
                    return response()->json(['success' => false, 'message' => 'Number of rows exceeds than 1000']);
                }
                //unset first two rows
                unset($data[0][0]);
                unset($data[0][1]);
                foreach ($render_skipped_rows as $render) {

                    //Explode candidate index into first,middle,last
                    $candidate_name = explode(' ', isset($render[13]) ? $render[13] : "");
                    $candidate_phone = isset($render[19]) ? $render[19] : "";

                    $con = 0;
                    $con1 = 1;
                    $con2 = 2;

                    // query for checking the exisitng /duplicate record
                    $query = DB::table("candidate_informations")
                        ->where("first_name", $render[14])
                        ->orwhere("last_name", $render[16])
                        ->orwhere("phone", $candidate_phone)
                        ->first();

                    if (isset($query->id)) {
                        // update record

                        $store_by_google_sheet = CandidateInformation::find($query->id);
                    } else {
                        // insert record
                        $store_by_google_sheet = new CandidateInformation();
                    }

                    if (!empty($candidate_name[2])) {

                        $store_by_google_sheet->first_name = isset($candidate_name[$con]) ? $candidate_name[$con] : "";
                        $store_by_google_sheet->middle_name = isset($candidate_name[$con1]) ? $candidate_name[$con1] : "";
                        $store_by_google_sheet->last_name = isset($candidate_name[$con2]) ? $candidate_name[$con2] : "";
                    } else {

                        $store_by_google_sheet->first_name = isset($candidate_name[$con]) ? $candidate_name[$con] : "";
                        $store_by_google_sheet->middle_name = isset($candidate_name[$con1]) ? $candidate_name[$con1] : "";
                    }

                    $store_by_google_sheet->gender = isset($render[17]) ? $render[17] : "";
                    $store_by_google_sheet->dob = isset($render[18]) ? $render[18] : "";
                    if (strstr($candidate_phone, ';', false)) {

                        $store_by_google_sheet->phone = strstr($candidate_phone, ';', true);
                    } else {
                        $store_by_google_sheet->phone = $candidate_phone;
                    }

                    $store_by_google_sheet->email = isset($render[20]) ? $render[20] : "";
                    $store_by_google_sheet->address = isset($render[21]) ? $render[21] : "";
                    // $store_by_google_sheet->status = isset($render[20])?$render[20]:"";$render[21];
                    $store_by_google_sheet->saved_by = Auth::user()->id;
                    $store_by_google_sheet->save();

                    // start store data in candidate_educations
                    $query = DB::table("candidate_educations")
                        ->where("candidate_id", $store_by_google_sheet->id)
                        ->first();
                    if (isset($query->id)) {
                        // update record
                        $candidateEducation = CandidateEducation::find($query->id);
                    } else {
                        // insert record
                        $candidateEducation = new CandidateEducation();
                    }
                    $candidateEducation->course = isset($render[22]) ? $render[22] : "";
                    $candidateEducation->educational_attain = isset($render[23]) ? $render[23] : "";
                    $candidateEducation->certification = isset($render[24]) ? $render[24] : "";
                    $candidateEducation->candidate_id = $store_by_google_sheet->id;
                    $candidateEducation->save();

                    // end  store data in candidate_educations

                    // start  store data in candidate_domains
                    $query = DB::table("candidate_domains")
                        ->where("candidate_id", $store_by_google_sheet->id)
                        ->first();

                    if (isset($query->id)) {
                        // update record
                        $candidateDomain = CandidateDomain::find($query->id);
                    } else {
                        // insert record
                        $candidateDomain = new CandidateDomain();
                    }
                    $candidateDomain->candidate_id = $store_by_google_sheet->id;
                    $candidateDomain->date_shifted = isset($render[4]) ? $render[4] : "";
                    $candidateDomain->domain = isset($render[8]) ? $render[8] : "";
                    $candidateDomain->emp_history = isset($render[25]) ? $render[25] : "";
                    $candidateDomain->interview_note = isset($render[26]) ? $render[26] : "";
                    $candidateDomain->segment = isset($render[9]) ? $render[9] : "";
                    $candidateDomain->sub_segment = isset($render[10]) ? $render[10] : "";
                    $candidateDomain->save();
                    // end  store data in candidate_domains

                    // start store data in candidate_position
                    $query = DB::table("candidate_positions")
                        ->where("candidate_id", $store_by_google_sheet->id)
                        ->first();

                    if (isset($query->id)) {
                        // update record
                        $candidatePosition = CandidatePosition::find($query->id);
                    } else {
                        // insert record
                        $candidatePosition = new CandidatePosition();
                    }
                    $candidatePosition->candidate_id = $store_by_google_sheet->id;
                    $candidatePosition->candidate_profile = isset($render[7]) ? $render[7] : "";
                    $candidatePosition->position_applied = isset($render[6]) ? $render[6] : "";
                    $candidatePosition->date_invited = isset($render[12]) ? $render[12] : "";
                    $candidatePosition->manner_of_invite = isset($render[11]) ? $render[11] : "";
                    $candidatePosition->curr_salary = intval(isset($render[27]) ? $render[27] : "");
                    $candidatePosition->exp_salary = intval(isset($render[29]) ? $render[29] : "");
                    $candidatePosition->off_salary = intval(isset($render[30]) ? $render[30] : "");
                    $candidatePosition->curr_allowance = intval(isset($render[28]) ? $render[28] : "");
                    $candidatePosition->off_allowance = intval(isset($render[31]) ? $render[31] : "");
                    $candidatePosition->save();

                    // end store data in candidate_position

                    // endoresment startgit
                    $query = DB::table("endorsements")
                        ->where("candidate_id", $store_by_google_sheet->id)
                        ->first();
                    if (isset($query->id)) {
                        // update record
                        $endorsement = Endorsement::find($query->id);
                    } else {
                        // insert record
                        $endorsement = new Endorsement();
                    }
                    $endorsement->app_status = isset($render[32]) ? $render[32] : "";
                    $endorsement->client = isset($render[35]) ? $render[35] : "";
                    $endorsement->status = isset($render[42]) ? $render[42] : "";
                    $endorsement->type = isset($render[33]) ? $render[33] : "";
                    $endorsement->site = isset($render[36]) ? $render[36] : "";
                    $endorsement->position_title = isset($render[37]) ? $render[37] : "";
                    $endorsement->domain_endo = intval(isset($render[39]) ? $render[39] : "");
                    $endorsement->interview_date = isset($render[45]) ? $render[45] : "";
                    $endorsement->career_endo = isset($render[38]) ? $render[38] : "";
                    $endorsement->segment_endo = intval(isset($render[40]) ? $render[40] : "");
                    $endorsement->sub_segment_endo = intval(isset($render[41]) ? $render[41] : "");
                    $endorsement->endi_date = isset($render[34]) ? $render[34] : "";
                    $endorsement->remarks_for_finance = isset($render[43]) ? $render[43] : "";
                    $endorsement->candidate_id = $store_by_google_sheet->id;
                    $endorsement->save();
                    //close

                    //finance start
                    $query = DB::table("finance")
                        ->where("candidate_id", $store_by_google_sheet->id)
                        ->first();
                    if (isset($query->id)) {
                        // update record
                        $finance = Finance::find($query->id);
                    } else {
                        // insert record
                        $finance = new Finance();
                    }
                    $finance->candidate_id = $store_by_google_sheet->id;
                    $finance->onboardnig_date = isset($render[59]) ? $render[59] : "";
                    $finance->onboardnig_date = isset($render[59]) ? $render[59] : "";
                    $finance->invoice_number = intval(isset($render[61]) ? $render[61] : "");
                    $finance->client_finance = isset($render[48]) ? $render[48] : "";
                    $finance->career_finance = isset($render[63]) ? $render[63] : "";
                    $finance->rate = intval(isset($render[67]) ? $render[67] : "");
                    $finance->srp = intval(isset($render[47]) ? $render[47] : "");
                    $finance->offered_salary = intval(isset($render[49]) ? $render[49] : "");
                    $finance->placement_fee = intval(isset($render[54]) ? $render[54] : "");
                    $finance->allowance = intval(isset($render[51]) ? $render[51] : "");

                    $finance->save();

                    //finance close
                    $con++;
                    $con1++;
                    $con2++;
                }
            }
            //save Google sheet addeed log to table starts
            Helper::save_log('GOOGLE_SHEET_IMPORTED');
            // save Google sheet added to log table ends
            return response()->json(['success' => true, 'message' => 'Data Import successfully']);
        } else {
            // if Sheet doesnt exist
            return response()->json(['success' => false, 'message' => 'Given Sheet is not found!']);
        }

    }
    public function verifySheet(Request $request)
    {
        $config = Config::get("datastudio.google_sheet_id");

        $test = Config::set('datastudio.google_sheet_id', $request->sheetID);
        // dd($config, Config::get("datastudio.google_sheet_id"));
        return response()->json(['success' => true, 'message' => 'successfully']);

    }
}
