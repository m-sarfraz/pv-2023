<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateEducation;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Domain;
use App\Endorsement;
use App\Http\Controllers\Controller;
use App\Segment;
use App\SubSegment;
use App\User;
use Auth;
use DB;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;

class RecordController extends Controller
{
    // index function for showing the record of users with filters starts
    public function index(Request $request)
    {
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        // get recruiter data
        $user = User::where('type', 3)->get();
        // join the tables to get ccandidate data
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $Userdata = DB::table('six_table_view')->join('users', 'users.id', 'six_table_view.saved_by')
            ->select('six_table_view.id as cid', 'six_table_view.*', 'users.name as recruiter')
            ->offset($page)
            ->limit($limit)
            ->paginate();
        // get required data to use for select purpose
        $count = $Userdata->count();

        $candidates = CandidateInformation::select('id', 'first_name')->get();
        $candidateprofile = CandidatePosition::select('candidate_profile', 'candidate_id')->get();

        $candidateDomain = CandidateDomain::select('segment', 'sub_segment')->get();
        $endorsement = Endorsement::select('app_status', 'career_endo', 'client', 'candidate_id')->get();

        $segmentsDropDown = Segment::all();
        $sub_segmentsDropDown = SubSegment::all();
        $AllData = count(DB::table('six_table_view')->get());
        // make array of data to pas to view
        $data = [
            'user' => $user,
            'candidates' => $candidates,
            'count' => $count,
            'Userdata' => $Userdata,
            'candidateprofile' => $candidateprofile,
            'candidateDomain' => $candidateDomain,
            'segmentsDropDown' => $segmentsDropDown,
            'sub_segmentsDropDown' => $sub_segmentsDropDown,
            'endorsement' => $endorsement,
            "AllData" => $AllData,
        ];
        return view('record.view_record', $data);
    }
    // index function for showing the record of users with filters ends

    // function for appending the resulting view to filtered record starts
    public function filter(Request $request)
    {
        // dd($request->all());
        $Userdata = DB::table('six_table_view')->join('users', 'six_table_view.saved_by', 'users.id')
            ->select('six_table_view.id as CID', 'six_table_view.*', 'users.id as UserID', 'users.name as recruiter');

        // condition for checking first to end not null starts here

        if (isset($request->user_id)) {
            $Userdata->whereIn('six_table_view.saved_by', $request->user_id);
        }
        if (isset($request->candidate)) {
            $Userdata->whereIn('six_table_view.id', $request->candidate);
        }
        if (isset($request->profile)) {
            $Userdata->whereIn('six_table_view.candidate_profile', $request->profile);
        }
        if (isset($request->sub_segment)) {
            $Userdata->whereIn('six_table_view.sub_segment', $request->sub_segment);
        }
        if (isset($request->app_status)) {
            $Userdata->whereIn('six_table_view.app_status', $request->app_status);
        }
        if (isset($request->client)) {
            $Userdata->whereIn('six_table_view.client', $request->client);
        }
        if (isset($request->career_level)) {
            // return $request->career_level;
            $Userdata->whereIn('six_table_view.career_endo', $request->career_level);
        }
        if (isset($request->date)) {
            $time = strtotime($request->date);
            $newformat = date('Y-m-d', $time);
            $Userdata->whereDate('six_table_view.endi_date', '<', $newformat);
        }

        if (isset($request->searchKeyword)) {

            ini_set('max_execution_time', 60000); //300 seconds = 5 minutes
            $perfect_match = DB::table('six_table_view')->get();

            foreach ($perfect_match as $match) {
                if (strpos($match->first_name, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.first_name', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos($match->candidate_profile, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.candidate_profile', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos($match->sub_segment, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.sub_segment', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos($match->app_status, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.app_status', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos($match->client, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.client', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos($match->career_endo, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.career_endo', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos($match->curr_salary, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.curr_salary', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos($match->exp_salary, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.exp_salary', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos($match->endi_date, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.endi_date', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos($match->off_salary, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.off_salary', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos($match->candidate_profile, $request->searchKeyword) !== false) {
                    $Userdata->where('six_table_view.candidate_profile', 'like', '%' . $request->searchKeyword . '%');
                }
            }
        }
        $Alldata = $Userdata->get();
        $count = $Alldata->count();
        $data = [
            'count' => $count,
            'Userdata' => $Alldata,
        ];
        return view('record.filter-user', $data);
    }
    // function for appending the resulting view to filtered record ends
    public function onlyCandidate(Request $request)
    {
       $Candidate_filter=DB::table('six_table_view')->whereIn("id",$request->match_profile)->get();
     
       return response()->json($Candidate_filter);
    }
    // function for appending the data of selected row candidate starts
    public function UserDetails(Request $request)
    {
        // return $request->id;
        $user = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as cid', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->where('candidate_informations.id', $request->id)
            ->first();
        // return $user->app_status;
        $domainDrop = Domain::all();

        $data = [
            'user' => $user,
            'domainDrop' => $domainDrop,
        ];
        return view('record.user_detail', $data);
    }
    // function for appending the data of selected row candidate ends

    public function updateDetails(Request $request)
    {
        // return $request->all();

        $arrayCheck = [
            'source' => 'required',
            "first_name" => "required",
            // "EMAIL_ADDRESS" => "required|email",
            "phone" => "required",
            // "GENDER" => "required",
            // "RESIDENCE" => 'required ',
            // "EDUCATIONAL_ATTAINTMENT" => 'required ',
            // // "COURSE" => 'required ',
            // "CANDIDATES_PROFILE" => 'required ',
            // "INTERVIEW_NOTES" => 'required ',
            // // "DATE_SIFTED" => 'required ',
            // "domain" => 'required ',
            // "segment" => 'required ',
            // // "SUB_SEGMENT" => 'required ',
            // "EMPLOYMENT_HISTORY" => 'required ',
            // "POSITION_TITLE_APPLIED" => 'required ',
            // // "DATE_INVITED" => 'required ',
            // "MANNER_OF_INVITE" => 'required ',
            // "CURRENT_SALARY" => 'required ',
            // "CURRENT_ALLOWANCE" => 'required ',
            // "EXPECTED_SALARY" => 'required ',
            // "OFFERED_SALARY" => 'required ',
            // "OFFERED_ALLOWANCE" => 'required ',
        ];
        $validator = Validator::make($request->all(), $arrayCheck);

        // send response mesage if validations are not according to requierd
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()]);
        } else {
            // Update data of eantry page
            $name = explode(" ", $request->first_name);
            CandidateInformation::where('id', $request->id)->update([
                'first_name' => $name[0],
                'middle_name' => $name[1],
                'last_name' => $name[2],
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'status' => '1',
                'saved_by' => Auth::user()->id,
            ]);

            // update candidate education data
            CandidateEducation::where('candidate_id', $request->id)->update([
                'educational_attain' => $request->EDUCATIONAL_ATTAINTMENT,
                'course' => $request->COURSE,
                'certification' => $request->CERTIFICATIONS,
            ]);

            // update candidae domain data
            // $domain_name = Domain::where('id', $request->DOMAIN)->first();
            // $name = Segment::where('id', $request->segment)->first();
            // $Sub_name = SubSegment::where('id', $request->sub_segment)->first();

            CandidateDomain::where('candidate_id', $request->id)->update([
                'date_shifted' => $request->date_shifted,
                'domain' => $request->DOMAIN,
                'interview_note' => $request->notes,
                'segment' => $request->segment,
                'sub_segment' => $request->sub_segment,
            ]);

            // update candidate position data according to requested data
            CandidatePosition::where('candidate_id', $request->id)->update([
                'candidate_profile' => $request->CANDIDATES_PROFILE,
                'position_applied' => $request->position_applied,
                'date_invited' => $request->date_invited,
                'manner_of_invite' => $request->manner_of_invite,
                'curr_salary' => $request->curr_salary,
                'exp_salary' => $request->expec_salary,
                'off_salary' => $request->offered_salary,
                'curr_allowance' => $request->curr_allowance,
                'off_allowance' => $request->offered_allowance,
            ]);

            //update endorsements table according to data updated
            Endorsement::where('candidate_id', $request->id)->update([
                'app_status' => $request->APPLICATION_STATUS,
                'remarks' => $request->REMARKS_FROM_FINANCE,
                'client' => $request->CLIENT_FINANCE,
                'site' => $request->SITE,
                'status' => $request->STATUS,
                'type' => $request->ENDORSEMENT_TYPE,
                'position_title' => $request->POSITION_TITLE,
                'domain_endo' => $request->DOMAIN_endo,
                'interview_date' => $request->INTERVIEW_SCHEDULE,
                'career_endo' => $request->CAREER_LEVEL,
                'segment_endo' => $request->endo_segment,
                'sub_segment_endo' => $request->endo_sub_segment,
                'endi_date' => $request->endo_date,
                'remarks_for_finance' => $request->REMARKS_FROM_FINANCE,
            ]);

            //save CANDIDATE addeed log to table starts
            Helper::save_log('CANDIDATE_UPDATED_FROM_VIEW_RECORD_');
            // save CANDIDATE added to log table ends

            //return success response after successfull data entry
            return response()->json(['success' => true, 'message' => 'Updated successfully']);
        }
    }
}
