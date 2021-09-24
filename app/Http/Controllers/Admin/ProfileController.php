<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateEducation;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Endorsement;
use App\Finance;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


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
    public function readsheet(\App\Services\GoogleSheet $googleSheet)
    {
        
        $data = $googleSheet->readGoogleSheet();

        foreach ($data as $render_skipped_rows) {
            //unset first two rows
            unset($data[0][0]);
            unset($data[0][1]);
            foreach ($render_skipped_rows as $render) {

                //Explode candidate index into first,middle,last
                $candidate_name = explode(' ', $render[13]);
                $candidate_phone = $render[19];

                $con = 0;
                $con1 = 1;
                $con2 = 2;
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

                    $store_by_google_sheet->first_name = $candidate_name[$con];
                    $store_by_google_sheet->middle_name = $candidate_name[$con1];
                    $store_by_google_sheet->last_name = $candidate_name[$con2];
                } else {

                    $store_by_google_sheet->first_name = $candidate_name[$con];
                    $store_by_google_sheet->middle_name = $candidate_name[$con1];
                }

                $store_by_google_sheet->gender = $render[17];
                $store_by_google_sheet->dob = $render[18];
                if (strstr($candidate_phone, ';', false)) {

                    $store_by_google_sheet->phone = strstr($candidate_phone, ';', true);
                } else {
                    $store_by_google_sheet->phone = $candidate_phone;
                }

                $store_by_google_sheet->email = $render[20];
                $store_by_google_sheet->address = $render[21];
                // $store_by_google_sheet->status = $render[21];
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
                $candidateEducation->course = $render[22];
                $candidateEducation->educational_attain = $render[23];
                $candidateEducation->certification = $render[24];
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
                $candidateDomain->date_shifted = $render[4];
                $candidateDomain->domain = $render[8];
                $candidateDomain->emp_history = $render[25];
                $candidateDomain->interview_note = $render[26];
                $candidateDomain->segment = $render[9];
                $candidateDomain->sub_segment = $render[10];
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
                $candidatePosition->candidate_profile = $render[7];
                $candidatePosition->position_applied = $render[6];
                $candidatePosition->date_invited = $render[12];
                $candidatePosition->manner_of_invite = $render[11];
                $candidatePosition->curr_salary = intval($render[27]);
                $candidatePosition->exp_salary = intval($render[29]);
                $candidatePosition->exp_salary = intval($render[29]);
                $candidatePosition->off_salary = intval($render[30]);
                $candidatePosition->curr_allowance = intval($render[28]);
                $candidatePosition->off_allowance = intval($render[31]);
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
                    $endorsement  = new Endorsement();
                }
                $endorsement->app_status = $render[32];
                $endorsement->client =  $render[35];
                $endorsement->status = $render[42];
                $endorsement->type =$render[33];
                $endorsement->site =  $render[36];
                $endorsement->position_title =  $render[37];
                $endorsement->domain_endo = intval($render[39]);
                $endorsement->interview_date = $render[45];
                $endorsement->career_endo =  $render[38];
                $endorsement->segment_endo = intval($render[40]);
                $endorsement->sub_segment_endo = intval($render[41]);
                $endorsement->endi_date = $render[34];
                $endorsement->remarks_for_finance = $render[43];
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
$finance  = new Finance();
}
$finance->candidate_id = $store_by_google_sheet->id;
// $finance->onboardnig_date = $render[59];
// $finance->invoice_number =  $render[61];
// $finance->client_finance = $render[48];
// $finance->career_finance =$render[63];
// $finance->rate =  $render[67];

// $finance->srp = $render[47];
// $finance->offered_salary = $render[49];
// $finance->placement_fee =  $render[54];
// $finance->allowance = intval($render[51]);

$finance->save();

//finance close 
                $con++;
                $con1++;
                $con2++;
            }
        }
    }
}
