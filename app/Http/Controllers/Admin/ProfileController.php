<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateEducation;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Cipprogress;
use App\Domain;
use App\Endorsement;
use App\Finance;
use App\Finance_detail;
use App\Http\Controllers\Controller;
use App\jdlSheet;
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
    // public function __construct()
    // {

    //     $this->middleware('permission:view-profile', ['only' => ['view_profile']]);
    //     $this->middleware('permission:save-profile', ['only' => ['save_profile']]);
    // }
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
                $userdata['image'] = $filepath . "/" . $file_name;
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
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $recruiter = Auth::user()->roles->first();
        // change configuration for google sheet ID
        $config = Config::get("datastudio.google_sheet_id");
        Config::set('datastudio.google_sheet_id', $request->sheetID);
        $config2 = Config::get("datastudio.google_sheet_id");
        $data = $googleSheet->readGoogleSheet($request->sheetID);

        // if sheet exist on google sheet with given id
        if (is_array($data)) {
            foreach ($data as $render_skipped_rows) {
                if (count($render_skipped_rows) > 6002) {
                    return response()->json(['success' => false, 'message' => 'Number of rows exceeds than 6000']);
                }
                //unset first two rows
                unset($data[0][0]);
                unset($data[0][1]);
                foreach ($render_skipped_rows as $render) {

                    //Explode candidate index into first,middle,last
                    // $candidate_name = explode(' ', isset($render[13]) ? $render[13] : "");
                    $candidate_name = isset($render[13]) ? $render[13] : "";
                    $candidate_phone = isset($render[19]) ? $render[19] : "";

                    $con = 0;
                    $con1 = 1;
                    $con2 = 2;

                    // query for checking the exisitng /duplicate record
                    $query = DB::table("candidate_informations")
                        // ->where("first_name", $render[14])
                        ->where("last_name", $candidate_name)
                        ->orwhere("phone", $candidate_phone)
                        ->first();

                    if (isset($query->id)) {
                        // update record

                        $store_by_google_sheet = CandidateInformation::find($query->id);
                        if ($render[33] == "Re-endorsed") {
                            $store_by_google_sheet->reprocess = $query->reprocess + 1;
                        } else {
                            $store_by_google_sheet->reprocess = $query->reprocess;
                        }
                        // $store_by_google_sheet->reprocess=
                    } else {
                        // insert record
                        $store_by_google_sheet = new CandidateInformation();
                    }

                    // if (!empty($candidate_name[2])) {

                    //     $store_by_google_sheet->first_name = isset($candidate_name[$con]) ? $candidate_name[$con] : "";
                    //     $store_by_google_sheet->middle_name = isset($candidate_name[$con1]) ? $candidate_name[$con1] : "";
                    //     $store_by_google_sheet->last_name = isset($candidate_name[$con2]) ? $candidate_name[$con2] : "";
                    // } else {

                    //     $store_by_google_sheet->first_name = isset($candidate_name[$con]) ? $candidate_name[$con] : "";
                    //     $store_by_google_sheet->middle_name = isset($candidate_name[$con1]) ? $candidate_name[$con1] : "";
                    // }

                    $store_by_google_sheet->last_name = isset($candidate_name) ? $candidate_name : "";
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
                    $candidateDomain->date_shifted = isset($render[4]) ? date('d-m-y', strtotime($render[4])) : "";
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
                    $endorsement->endi_date = isset($render[34]) ? date('d-m-y', strtotime($render[34])) : "";
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
                    // $finance->onboardnig_date = isset($render[59]) ? $render[59] : "";
                    $finance->onboardnig_date = isset($render[59]) ? date('d-m-y', strtotime($render[59])) : "";

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
                    //finance start
                    $query = DB::table("finance_detail")
                        ->where("candidate_id", $store_by_google_sheet->id)
                        ->first();
                    if (isset($query->id)) {
                        // update record
                        $finance_detail = Finance_detail::find($query->id);
                    } else {
                        // insert record
                        $finance_detail = new Finance_detail();
                    }
                    $finance_detail->candidate_id = $store_by_google_sheet->id;
                    $finance_detail->offered_salary = isset($render[50]) ? intval($render[50]) : intval(0);
                    $finance_detail->allowance = isset($render[51]) ? intval($render[51]) : intval(0);
                    $finance_detail->compensation = isset($render[52]) ? intval($render[52]) : intval(0);
                    $finance_detail->rate_per = isset($render[53]) ? intval($render[53]) : intval(0);
                    $finance_detail->vat_per = isset($render[54]) ? intval($render[54]) : intval(0);
                    $finance_detail->placementFee = isset($render[55]) ? intval($render[55]) : intval(0);
                    $finance_detail->finalFee = isset($render[56]) ? intval($render[56]) : intval(0);
                    $finance_detail->adjustment = isset($render[57]) ? intval($render[57]) : intval(0);
                    $finance_detail->credit_memo = isset($render[58]) ? intval($render[58]) : intval(0);
                    $finance_detail->ob_date = isset($render[59]) ? intval($render[59]) : intval(0);
                    $finance_detail->invoice_date = isset($render[60]) ? $render[60] : " ";
                    $finance_detail->invoice_number = isset($render[61]) ? intval($render[61]) : intval(0);
                    $finance_detail->date_delvrd = isset($render[62]) ? $render[62] : " ";
                    $finance_detail->dpd = isset($render[63]) ? $render[63] : " ";
                    $finance_detail->payment_term = isset($render[64]) ? intval($render[64]) : intval(0);
                    $finance_detail->date_collected = isset($render[65]) ? $render[65] : " ";
                    $finance_detail->or_number = isset($render[66]) ? intval($render[66]) : intval(0);
                    $finance_detail->code = isset($render[67]) ? intval($render[67]) : intval(0);
                    $finance_detail->term_date = isset($render[68]) ? $render[68] : "";
                    $finance_detail->replacement_for = isset($render[69]) ? $render[69] : "";
                    $finance_detail->remarks = isset($render[70]) ? $render[70] : "";
                    $finance_detail->process_status = isset($render[71]) ? $render[71] : "";
                    $finance_detail->vcc_share_per = isset($render[72]) ? intval($render[72]) : intval(0);
                    $finance_detail->vcc_amount = isset($render[73]) ? intval($render[73]) : intval(0);
                    $finance_detail->c_take_per = isset($render[74]) ? intval($render[74]) : intval(0);
                    $finance_detail->c_take = isset($render[75]) ? intval($render[75]) : intval(0);
                    $finance_detail->owner_share_per = isset($render[76]) ? intval($render[76]) : intval(0);
                    $finance_detail->owner_share = isset($render[77]) ? intval($render[77]) : intval(0);
                    $finance_detail->reprocess_share_per = isset($render[78]) ? intval($render[78]) : intval(0);
                    $finance_detail->reprocess_share = isset($render[79]) ? intval($render[79]) : intval(0);
                    $finance_detail->ind_revenue = isset($render[80]) ? intval($render[80]) : intval(0);
                    $finance_detail->t_id = $recruiter->id;
                    $finance_detail->save();
                    //start logic for cip

                    $array = [
                        'Final Stage' => [
                            0 => 'Scheduled for Country Head Interview',
                            1 => 'Scheduled for Final Interview',
                            2 => "Scheduled for Hiring Manager's Interview",
                            3 => 'Done Behavioral Interview / Awaiting Feedback',
                            4 => 'Done Final Interview / Awaiting Feedback',
                            5 => "Done Hiring Manager's Interview / Awaiting Feedback",
                            6 => 'Failed Country Head Interview',
                            7 => 'Failed Final Interview',
                            8 => "Failed Hiring Manager's Interview",
                            9 => "Scheduled for Job Offer",
                            10 => "Shortlisted/For Comparison",
                            11 => "Onboarded",
                            12 => "Offer accepted",
                            13 => "Offer Rejected",
                            14 => "Position Closed (Final Stage)",
                            15 => "Done Country Head Interview / Awaiting Feedback",
                            16 => "Pending Offer Approval",
                            17 => "Pending Offer Schedule",
                            18 => "Position On Hold (Final Stage)",
                            19 => "Shortlisted",
                            20 => "Fallout/Reneged",
                        ],
                        "Mid Stage" => [
                            0 => 'Scheduled for Skills Interview',
                            1 => 'Scheduled for Technical Interview',
                            2 => "Scheduled for Technical exam",
                            3 => 'Sheduled for Behavioral Interview',
                            4 => 'Scheduled for account validation',
                            5 => "Done Skills interview/ Awaiting Feedback",
                            6 => 'Done Techincal Interview /Awaiting Feedback',
                            7 => 'Done Technical exam /Awaiting Feedback',
                            8 => "Done Behavioral /Awaiting Feedback",
                            9 => "Failed Skills interview",
                            10 => "Failed Techincal Interview",
                            11 => "Failed Technical exam",
                            12 => "Failed Behavioral Interview",
                            13 => "Pending Country Head Interview",
                            14 => "Pending Final Interview",
                            15 => "Pending Hiring Manager's Interview",
                            16 => "Position Closed (Mid Stage)",
                            17 => "Done Skills/Technical Interview / Awaiting Feedback",
                            18 => "Failed Skills/Technical Interview",
                            19 => "Position On Hold (Mid Stage)",
                            20 => "Scheduled for Behavioral Interview",
                            21 => "Scheduled for Skills/Technical Interview",
                        ],
                    ];

                    $user = User::find($recruiter);

                    $query = DB::table("cip_progress")
                        ->where("candidate_id", $store_by_google_sheet->id)
                        ->first();
                    if (isset($query->id)) {
                        // update record
                        $Cipprogress = Cipprogress::find($query->id);
                    } else {
                        // insert record
                        $Cipprogress = new Cipprogress();
                    }
                    // find in array
                    if (in_array(isset($render[43]) ? $render[43] : "", $array['Final Stage'])) {

                        $Cipprogress->final_stage = 1;
                        $Cipprogress->cip = 1;
                    }
                    if (in_array(isset($render[43]) ? $render[43] : "", $array['Mid Stage'])) {
                        $Cipprogress->mid_stage = 1;
                        $Cipprogress->cip = 1;
                    }
                    //check
                    $word_1 = "Offer";
                    $word_2 = "Onboarded";
                    $mystring = isset($render[43]) ? $render[43] : "";
                    if (strpos($mystring, $word_1) !== false) {
                        $Cipprogress->offered = 1;
                    }
                    if (strpos($mystring, $word_2) !== false) {
                        $Cipprogress->onboarded = 1;
                    }
                    $Cipprogress->candidate_id = $store_by_google_sheet->id;
                    $Cipprogress->team = $recruiter->name;
                    $Cipprogress->t_id = $recruiter->id;
                    $Cipprogress->save();
                    //close cip

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
    public function readLocalAcceess()
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $recruiter = Auth::user()->roles->first();
        $filename = $_FILES["file"]["tmp_name"];
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($filename, "r");

            if (!$file) {
                die('Cannot open file for reading');
            }
            $row = 1;
            while (($render = fgetcsv($file, 1000, ",")) !== false) {
                $num = count($render);
                if ($row > 6002) {
                    return response()->json(['success' => false, 'message' => 'Number of rows exceeds than 6000']);
                }

                // $candidate_name = explode(' ', isset($render[13]) ? $render[13] : "");
                $candidate_phone = isset($render[19]) ? $render[19] : "";
                // query for checking the exisitng /duplicate record
                $query = DB::table("candidate_informations")
                    // ->where("first_name", isset($candidate_name[0]) ? $candidate_name[0] : "")
                    ->orwhere("last_name", isset($render[13]) ? $render[13] : "")
                    ->orwhere("phone", $candidate_phone)
                    ->first();

                if (isset($query->id)) {
                    // update record
                    $store_by_Ecxel = CandidateInformation::find($query->id);
                    if (isset($render[33]) == "Re-Endorsed") {
                        $store_by_Ecxel->reprocess = $query->reprocess + 1;
                    }
                } else {
                    // insert record
                    $store_by_Ecxel = new CandidateInformation();
                }
                $store_by_Ecxel->first_name = isset($candidate_name[0]) ? $candidate_name[0] : "";
                $store_by_Ecxel->middle_name = isset($candidate_name[1]) ? $candidate_name[1] : "";
                $store_by_Ecxel->last_name = isset($candidate_name[2]) ? $candidate_name[2] : "";

                $store_by_Ecxel->gender = isset($render[17]) ? $render[17] : "";
                $store_by_Ecxel->dob = isset($render[18]) ? $render[18] : "";
                if (strstr($candidate_phone, ';', false)) {

                    $store_by_Ecxel->phone = strstr($candidate_phone, ';', true);
                } else {
                    $store_by_Ecxel->phone = $candidate_phone;
                }

                $store_by_Ecxel->email = isset($render[20]) ? $render[20] : "";
                $store_by_Ecxel->address = isset($render[21]) ? $render[21] : "";
                // $store_by_Ecxel->status = isset($render[20])?$render[20]:"";$render[21];
                $store_by_Ecxel->saved_by = Auth::user()->id;
                $store_by_Ecxel->save();

                // start store data in candidate_educations
                $query = DB::table("candidate_educations")
                    ->where("candidate_id", $store_by_Ecxel->id)
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
                $candidateEducation->candidate_id = $store_by_Ecxel->id;
                $candidateEducation->save();

                // end  store data in candidate_educations

                // start  store data in candidate_domains
                $query = DB::table("candidate_domains")
                    ->where("candidate_id", $store_by_Ecxel->id)
                    ->first();

                if (isset($query->id)) {
                    // update record
                    $candidateDomain = CandidateDomain::find($query->id);
                } else {
                    // insert record
                    $candidateDomain = new CandidateDomain();
                }
                $candidateDomain->candidate_id = $store_by_Ecxel->id;
                $candidateDomain->date_shifted = isset($render[4]) ? date('d-m-y', strtotime($render[4])) : "";
                $candidateDomain->domain = isset($render[8]) ? $render[8] : "";
                $candidateDomain->emp_history = isset($render[25]) ? $render[25] : "";
                $candidateDomain->interview_note = isset($render[26]) ? $render[26] : "";
                $candidateDomain->segment = isset($render[9]) ? $render[9] : "";
                $candidateDomain->sub_segment = isset($render[10]) ? $render[10] : "";
                $candidateDomain->save();
                // end  store data in candidate_domains

                // start store data in candidate_position
                $query = DB::table("candidate_positions")
                    ->where("candidate_id", $store_by_Ecxel->id)
                    ->first();

                if (isset($query->id)) {
                    // update record
                    $candidatePosition = CandidatePosition::find($query->id);
                } else {
                    // insert record
                    $candidatePosition = new CandidatePosition();
                }
                $candidatePosition->candidate_id = $store_by_Ecxel->id;
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
                    ->where("candidate_id", $store_by_Ecxel->id)
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
                $endorsement->endi_date = isset($render[34]) ? date('d-m-y', strtotime($render[34])) : "";
                $endorsement->remarks_for_finance = isset($render[43]) ? $render[43] : "";
                $endorsement->candidate_id = $store_by_Ecxel->id;
                $endorsement->save();
                //close

                //finance start
                $query = DB::table("finance")
                    ->where("candidate_id", $store_by_Ecxel->id)
                    ->first();
                if (isset($query->id)) {
                    // update record
                    $finance = Finance::find($query->id);
                } else {
                    // insert record
                    $finance = new Finance();
                }
                $finance->candidate_id = $store_by_Ecxel->id;
                // $finance->onboardnig_date = isset($render[59]) ? $render[59] : "";
                $finance->onboardnig_date = isset($render[59]) ? date('d-m-y', strtotime($render[59])) : "";
                $finance->invoice_number = intval(isset($render[61]) ? $render[61] : "");
                $finance->client_finance = isset($render[48]) ? $render[48] : "";
                $finance->career_finance = isset($render[63]) ? $render[63] : "";
                $finance->rate = intval(isset($render[67]) ? $render[67] : "");
                $finance->srp = intval(isset($render[47]) ? $render[47] : "");
                $finance->offered_salary = intval(isset($render[49]) ? $render[49] : "");
                $finance->placement_fee = intval(isset($render[54]) ? $render[54] : "");
                $finance->allowance = intval(isset($render[51]) ? $render[51] : "");

                $finance->save();
                //finance detail start

                $query = DB::table("finance_detail")
                    ->where("candidate_id", $store_by_Ecxel->id)
                    ->first();
                if (isset($query->id)) {
                    // update record
                    $finance_detail = Finance_detail::find($query->id);
                } else {
                    // insert record
                    $finance_detail = new Finance_detail();
                }
                $finance_detail->candidate_id = $store_by_Ecxel->id;
                $finance_detail->offered_salary = isset($render[50]) ? intval($render[50]) : intval(0);
                $finance_detail->allowance = isset($render[51]) ? intval($render[51]) : intval(0);
                $finance_detail->compensation = isset($render[52]) ? intval($render[52]) : intval(0);
                $finance_detail->rate_per = isset($render[53]) ? intval($render[53]) : intval(0);
                $finance_detail->vat_per = isset($render[54]) ? intval($render[54]) : intval(0);
                $finance_detail->placementFee = isset($render[55]) ? intval($render[55]) : intval(0);
                $finance_detail->finalFee = isset($render[56]) ? intval($render[56]) : intval(0);
                $finance_detail->adjustment = isset($render[57]) ? intval($render[57]) : intval(0);
                $finance_detail->credit_memo = isset($render[58]) ? intval($render[58]) : intval(0);
                $finance_detail->ob_date = isset($render[59]) ? intval($render[59]) : intval(0);
                $finance_detail->invoice_date = isset($render[60]) ? $render[60] : " ";
                $finance_detail->invoice_number = isset($render[61]) ? intval($render[61]) : intval(0);
                $finance_detail->date_delvrd = isset($render[62]) ? $render[62] : " ";
                $finance_detail->dpd = isset($render[63]) ? $render[63] : " ";
                $finance_detail->payment_term = isset($render[64]) ? intval($render[64]) : intval(0);
                $finance_detail->date_collected = isset($render[65]) ? $render[65] : " ";
                $finance_detail->or_number = isset($render[66]) ? intval($render[66]) : intval(0);
                $finance_detail->code = isset($render[67]) ? intval($render[67]) : intval(0);
                $finance_detail->term_date = isset($render[68]) ? $render[68] : "";
                $finance_detail->replacement_for = isset($render[69]) ? $render[69] : "";
                $finance_detail->remarks = isset($render[70]) ? $render[70] : "";
                $finance_detail->process_status = isset($render[71]) ? $render[71] : "";
                $finance_detail->vcc_share_per = isset($render[72]) ? intval($render[72]) : intval(0);
                $finance_detail->vcc_amount = isset($render[73]) ? intval($render[73]) : intval(0);
                $finance_detail->c_take_per = isset($render[74]) ? intval($render[74]) : intval(0);
                $finance_detail->c_take = isset($render[75]) ? intval($render[75]) : intval(0);
                $finance_detail->owner_share_per = isset($render[76]) ? intval($render[76]) : intval(0);
                $finance_detail->owner_share = isset($render[77]) ? intval($render[77]) : intval(0);
                $finance_detail->reprocess_share_per = isset($render[78]) ? intval($render[78]) : intval(0);
                $finance_detail->reprocess_share = isset($render[79]) ? intval($render[79]) : intval(0);
                $finance_detail->ind_revenue = isset($render[80]) ? intval($render[80]) : intval(0);
                $finance_detail->save();
                //start logic for cip

                $array = [
                    'Final Stage' => [
                        0 => 'Scheduled for Country Head Interview',
                        1 => 'Scheduled for Final Interview',
                        2 => "Scheduled for Hiring Manager's Interview",
                        3 => 'Done Behavioral Interview / Awaiting Feedback',
                        4 => 'Done Final Interview / Awaiting Feedback',
                        5 => "Done Hiring Manager's Interview / Awaiting Feedback",
                        6 => 'Failed Country Head Interview',
                        7 => 'Failed Final Interview',
                        8 => "Failed Hiring Manager's Interview",
                        9 => "Scheduled for Job Offer",
                        10 => "Shortlisted/For Comparison",
                        11 => "Onboarded",
                        12 => "Offer accepted",
                        13 => "Offer Rejected",
                        14 => "Position Closed (Final Stage)",
                        15 => "Done Country Head Interview / Awaiting Feedback",
                        16 => "Pending Offer Approval",
                        17 => "Pending Offer Schedule",
                        18 => "Position On Hold (Final Stage)",
                        19 => "Shortlisted",
                        20 => "Fallout/Reneged",
                    ],
                    "Mid Stage" => [
                        0 => 'Scheduled for Skills Interview',
                        1 => 'Scheduled for Technical Interview',
                        2 => "Scheduled for Technical exam",
                        3 => 'Sheduled for Behavioral Interview',
                        4 => 'Scheduled for account validation',
                        5 => "Done Skills interview/ Awaiting Feedback",
                        6 => 'Done Techincal Interview /Awaiting Feedback',
                        7 => 'Done Technical exam /Awaiting Feedback',
                        8 => "Done Behavioral /Awaiting Feedback",
                        9 => "Failed Skills interview",
                        10 => "Failed Techincal Interview",
                        11 => "Failed Technical exam",
                        12 => "Failed Behavioral Interview",
                        13 => "Pending Country Head Interview",
                        14 => "Pending Final Interview",
                        15 => "Pending Hiring Manager's Interview",
                        16 => "Position Closed (Mid Stage)",
                        17 => "Done Skills/Technical Interview / Awaiting Feedback",
                        18 => "Failed Skills/Technical Interview",
                        19 => "Position On Hold (Mid Stage)",
                        20 => "Scheduled for Behavioral Interview",
                        21 => "Scheduled for Skills/Technical Interview",
                    ],
                ];

                $user = User::find($recruiter);

                $query = DB::table("cip_progress")
                    ->where("candidate_id", $store_by_Ecxel->id)
                    ->first();
                if (isset($query->id)) {
                    // update record
                    $Cipprogress = Cipprogress::find($query->id);
                } else {
                    // insert record
                    $Cipprogress = new Cipprogress();
                }
                // find in array
                if (in_array(isset($render[43]) ? $render[43] : "", $array['Final Stage'])) {

                    $Cipprogress->final_stage = 1;
                    $Cipprogress->cip = 1;
                }
                if (in_array(isset($render[43]) ? $render[43] : "", $array['Mid Stage'])) {
                    $Cipprogress->mid_stage = 1;
                    $Cipprogress->cip = 1;
                }
                //check
                $word_1 = "Offer";
                $word_2 = "Onboarded";
                $mystring = isset($render[43]) ? $render[43] : "";
                if (strpos($mystring, $word_1) !== false) {
                    $Cipprogress->offered = 1;
                }
                if (strpos($mystring, $word_2) !== false) {
                    $Cipprogress->onboarded = 1;
                }
                $Cipprogress->candidate_id = $store_by_Ecxel->id;
                $Cipprogress->team = $recruiter->name;
                $Cipprogress->t_id = $recruiter->id;
                $Cipprogress->save();
                //close cip

                $row++;
            }

            // fclose($file);
        }

        return redirect()->back()->with('message', 'data Import successfully');
    }

    public function verifySheet(Request $request)
    {
        $config = Config::get("datastudio.google_sheet_id");

        $test = Config::set('datastudio.google_sheet_id', $request->sheetID);
        // dd($config, Config::get("datastudio.google_sheet_id"));
        return response()->json(['success' => true, 'message' => 'successfully']);
    }
    public function connect_to_jdl_sheet(\App\Services\GoogleSheet $googleSheet, Request $request)
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        // change configuration for google sheet ID
        $config = Config::get("datastudio.google_sheet_id");
        Config::set('datastudio.google_sheet_id', $request->jdl_sheet_id);
        $config2 = Config::get("datastudio.google_sheet_id");
        $data = $googleSheet->readGoogleSheet($request->jdl_sheet_id);

        // if sheet exist on google sheet with given id
        if (is_array($data)) {
            foreach ($data as $render_skipped_rows) {
                if (count($render_skipped_rows) > 6002) {
                    return response()->json(['success' => false, 'message' => 'Number of rows exceeds than 6000']);
                }
                //unset first  row
                unset($data[0][0]);

                foreach ($render_skipped_rows as $render) {




                    $store_by_google_sheet = new jdlSheet();
                    $store_by_google_sheet->priority = isset($render[0]) ? $render[0] : "";
                    $store_by_google_sheet->ref_code = isset($render[1]) ? $render[1] : "";
                    $store_by_google_sheet->status = isset($render[2]) ? $render[2] : "";
                    $store_by_google_sheet->req_date = isset($render[3]) ? $render[3] : "";
                    $store_by_google_sheet->maturity = isset($render[4]) ? $render[4] : "";
                    $store_by_google_sheet->updated_date = isset($render[5]) ? $render[5] : "";
                    $store_by_google_sheet->closed_date = isset($render[6]) ? $render[6] : "";
                    $store_by_google_sheet->os_date = isset($render[7]) ? $render[7] : "";
                    $store_by_google_sheet->client = isset($render[8]) ? $render[8] : "";
                    $store_by_google_sheet->domain = isset($render[9]) ? $render[9] : "";
                    $store_by_google_sheet->segment = isset($render[10]) ? $render[10] : "";
                    $store_by_google_sheet->subsegment = isset($render[11]) ? $render[11] : "";
                    $store_by_google_sheet->p_title = isset($render[12]) ? $render[12] : "";
                    $store_by_google_sheet->c_level = isset($render[13]) ? $render[13] : "";
                    $store_by_google_sheet->sll_no = isset($render[14]) ? $render[14] : "";
                    $store_by_google_sheet->t_fte = isset($render[15]) ? $render[15] : "";
                    $store_by_google_sheet->updated_fte = isset($render[16]) ? $render[16] : "";
                    $store_by_google_sheet->edu_attainment = isset($render[17]) ? $render[17] : "";
                    $store_by_google_sheet->jd = isset($render[18]) ? $render[18] : "";
                    $store_by_google_sheet->location = isset($render[19]) ? $render[19] : "";
                    $store_by_google_sheet->w_schedule = isset($render[20]) ? $render[20] : "";
                    $store_by_google_sheet->budget = isset($render[21]) ? $render[21] : "";
                    $store_by_google_sheet->poc = isset($render[22]) ? $render[22] : "";
                    $store_by_google_sheet->note = isset($render[23]) ? $render[23] : "";
                    $store_by_google_sheet->start_date = isset($render[24]) ? $render[24] : "";
                    $store_by_google_sheet->keyword = isset($render[25]) ? $render[21] : "";
                    $store_by_google_sheet->recruiter = isset($render[26]) ? $render[26] : "";

                    $store_by_google_sheet->save();
                }
            }
            //save Google sheet addeed log to table starts
            Helper::save_log('JDL_SHEET_IMPORTED');
            // save Google sheet added to log table ends
            return redirect()->back()->with('JDL_SHEET_IMPORTED', 'data Import successfully');
        } else {
            // if Sheet doesnt exist
            return redirect()->back()->with('JDL_SHEET_IMPORTED', 'There are some errorr here');
        }
    }
    public function uploadJdlSheet(Request $request)
    {
        // dd($request->all());
        $recruiter = Auth::user()->roles->first();
        $filename = $_FILES["sheetFileJDL"]["tmp_name"];
        if ($_FILES["sheetFileJDL"]["size"] > 0) {

            $file = fopen($filename, "r");

            if (!$file) {
                die('Cannot open file for reading');
            }


            $row = 1;
            while (($render = fgetcsv($file, 1000, ",")) !== false) {
                $num = count($render);
                if ($row > 6002) {
                    redirect()->back()->with('CSV_FILE_UPLOADED_JDL', 'data is greaterthan  6002');
                }
                if ($render[0] != 'PRIORITY') {


                    $JDL_local_sheet = new jdlSheet();
                    $JDL_local_sheet->priority = isset($render[0]) ? $render[0] : "";
                    $JDL_local_sheet->ref_code = isset($render[1]) ? $render[1] : "";
                    $JDL_local_sheet->status = isset($render[2]) ? $render[2] : "";
                    $JDL_local_sheet->req_date = isset($render[3]) ? $render[3] : "";
                    $JDL_local_sheet->maturity = isset($render[4]) ? $render[4] : "";
                    $JDL_local_sheet->updated_date = isset($render[5]) ? $render[5] : "";
                    $JDL_local_sheet->closed_date = isset($render[6]) ? $render[6] : "";
                    $JDL_local_sheet->os_date = isset($render[7]) ? $render[7] : "";
                    $JDL_local_sheet->client = isset($render[8]) ? $render[8] : "";
                    $JDL_local_sheet->domain = isset($render[9]) ? $render[9] : "";
                    $JDL_local_sheet->segment = isset($render[10]) ? $render[10] : "";
                    $JDL_local_sheet->subsegment = isset($render[11]) ? $render[11] : "";
                    $JDL_local_sheet->p_title = isset($render[12]) ? $render[12] : "";
                    $JDL_local_sheet->c_level = isset($render[13]) ? $render[13] : "";
                    $JDL_local_sheet->sll_no = isset($render[14]) ? $render[14] : "";
                    $JDL_local_sheet->t_fte = isset($render[15]) ? $render[15] : "";
                    $JDL_local_sheet->updated_fte = isset($render[16]) ? $render[16] : "";
                    $JDL_local_sheet->edu_attainment = isset($render[17]) ? $render[17] : "";
                    $JDL_local_sheet->jd = isset($render[18]) ? $render[18] : "";
                    $JDL_local_sheet->location = isset($render[19]) ? $render[19] : "";
                    $JDL_local_sheet->w_schedule = isset($render[20]) ? $render[20] : "";
                    $JDL_local_sheet->budget = isset($render[21]) ? $render[21] : "";
                    $JDL_local_sheet->poc = isset($render[22]) ? $render[22] : "";
                    $JDL_local_sheet->note = isset($render[23]) ? $render[23] : "";
                    $JDL_local_sheet->start_date = isset($render[24]) ? $render[24] : "";
                    $JDL_local_sheet->keyword = isset($render[25]) ? $render[21] : "";
                    $JDL_local_sheet->recruiter = isset($render[26]) ? $render[26] : "";
                    $JDL_local_sheet->save();
                }
            }

            return redirect()->back()->with('CSV_FILE_UPLOADED_JDL', 'data Import successfully');
        }
        return redirect()->back()->with('CSV_FILE_UPLOADED_JDL', 'data is not Import successfully');
    }
}
