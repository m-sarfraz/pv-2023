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
use Cache;
use DB;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Yajra\DataTables\DataTables;

class RecordController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:view-record', ['only' => ['index']]);
        $this->middleware('permission:edit-record', ['only' => ['updateDetails']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
    }
    // index function for showing the record of users with filters starts
    public function index(Request $request)
    {

        ini_set('max_execution_time', 30000); //30000 seconds = 500 minutes
        // get recruiter data
        $user = User::where('type', 3)->get();
        // join the tables to get ccandidate data
        // $page = $request->has('page') ? $request->get('page') : 1;
        // $limit = $request->has('limit') ? $request->get('limit') : 10;
        // $Userdata = DB::table('six_table_view')
        //     ->select('six_table_view.id as cid', 'six_table_view.*')
        //     ->offset($page)
        //     ->limit($limit)
        //     ->paginate();
        // get required data to use for select purpose
        // $count = CandidateInformation::all()->last()->id;
        $candidates = CandidateInformation::select('id', 'last_name')->get();
        $candidateprofile = CandidatePosition::select('candidate_profile', 'candidate_id')->get();
        $candidateDomain = CandidateDomain::select('segment', 'sub_segment', 'candidate_id')->get();
        $endorsement = Endorsement::select('app_status', 'career_endo', 'client', 'candidate_id')->get();

        $segmentsDropDown = Segment::all();
        $sub_segmentsDropDown = SubSegment::all();
        $AllData = DB::select('select max(id) as totalCandidate from candidate_informations');
        // $AllData = count(CandidateInformation::all());
        // return $AllData;
        // make array of data to pas to view
        $data = [
            'user' => $user,
            'candidates' => $candidates,
            // 'count' => $count,
            // 'Userdata' => $Userdata,
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

    // show data table for view record page starts
    public function view_record_filter_table(Request $request)
    {
        $check = $searchCheck = false;

        $Userdata = DB::table('six_table_view')
            ->select('six_table_view.id as CID', 'six_table_view.*');

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

            $Userdata->where('six_table_view.endi_date', $request->date);
        }

        if (isset($request->searchKeyword)) {
            ini_set('max_execution_time', 60000); //300 seconds = 5 minutes
            $searchCheck = true;
            $perfect_match = DB::table('six_table_view')->get();

            foreach ($perfect_match as $match) {
                if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.last_name', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->candidate_profile), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.candidate_profile', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->sub_segment), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.sub_segment', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->app_status), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.app_status', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->client), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.client', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->career_endo), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.career_endo', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->curr_salary), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.curr_salary', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->exp_salary), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.exp_salary', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->endi_date), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.endi_date', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->off_salary), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.off_salary', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->candidate_profile), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.candidate_profile', 'like', '%' . $request->searchKeyword . '%');
                }
            }
        }
        if ($check) {

            $Alldata = $Userdata->get();
        } else {
            if (!$check && !$searchCheck) {
                $Alldata = $Userdata->get();
            } else {
                $Alldata = [];
            }
        }
        return Datatables::of($Alldata)
            ->addIndexColumn()
            ->addColumn('id', function ($Alldata) {
                return $Alldata->id;
            })
            ->addColumn('recruiter', function ($Alldata) {
                return $Alldata->recruiter;
            })

            ->addColumn('Candidate', function ($Alldata) {
                return $Alldata->last_name;
            })
            ->addColumn('profile', function ($Alldata) {
                return $Alldata->candidate_profile;
            })
            ->addColumn('subSegment', function ($Alldata) {
                return $Alldata->sub_segment;
            })
            ->addColumn('cSalary', function ($Alldata) {
                return $Alldata->curr_salary;
            })
            ->addColumn('eSalary', function ($Alldata) {
                return $Alldata->exp_salary;
            })
            ->addColumn('appStatus', function ($Alldata) {
                return $Alldata->app_status;
            })
            ->addColumn('client', function ($Alldata) {
                return $Alldata->client;
            })
            ->addColumn('career_level', function ($Alldata) {
                return $Alldata->career_endo;
            })
            ->addColumn('endi_date', function ($Alldata) {
                if (!empty($Alldata->endi_date && $Alldata->endi_date != '0000-00-00')) {
                    $endi_date = date_format(date_create($Alldata->endi_date), "m-d-Y");
                    return $endi_date;
                } else {
                    $Alldata->endi_date = '';
                }

            })
            ->rawColumns(['recruiter', 'Candidate', 'profile', 'subSegment', 'cSalary', 'eSalary', 'appStatus', 'client',
                'career_level', 'endi_date'])
            ->make(true);

    }
    public function view_record_table()
    {

        // $user = DB::table('six_table_view')->get();
        $user = DB::table('six_table_view');
        return Datatables::of($user)
            ->addIndexColumn()
            ->addColumn('id', function ($user) {
                return $user->id;
            })
            ->addColumn('recruiter', function ($user) {
                return $user->recruiter;
            })

            ->addColumn('Candidate', function ($user) {
                return $user->last_name;
            })
            ->addColumn('profile', function ($user) {
                return $user->candidate_profile;
            })
            ->addColumn('subSegment', function ($user) {
                return $user->sub_segment;
            })
            ->addColumn('cSalary', function ($user) {
                return $user->curr_salary;
            })
            ->addColumn('eSalary', function ($user) {
                return $user->exp_salary;
            })
            ->addColumn('appStatus', function ($user) {
                return $user->app_status;
            })
            ->addColumn('client', function ($user) {
                return $user->client;
            })
            ->addColumn('career_level', function ($user) {
                return $user->career_endo;
            })
            ->addColumn('endi_date', function ($user) {
                return $user->endi_date;
            })
            ->rawColumns(['id', 'recruiter', 'Candidate', 'profile', 'subSegment', 'cSalary', 'eSalary', 'appStatus', 'client',
                'career_level', 'endi_date'])
            ->make(true);
    }
    // show data table for view record page ends

    // function for appending the resulting view to filtered record starts
    public function filter(Request $request)
    {
        // $check = $searchCheck = false;
        // $Userdata = DB::table('six_table_view')
        //     ->select('six_table_view.id as CID', 'six_table_view.*');

        // // condition for checking first to end not null starts here

        // if (isset($request->user_id)) {
        //     $Userdata->whereIn('six_table_view.saved_by', $request->user_id);
        // }
        // if (isset($request->candidate)) {
        //     $Userdata->whereIn('six_table_view.id', $request->candidate);
        // }
        // if (isset($request->profile)) {
        //     $Userdata->whereIn('six_table_view.candidate_profile', $request->profile);
        // }
        // if (isset($request->sub_segment)) {
        //     $Userdata->whereIn('six_table_view.sub_segment', $request->sub_segment);
        // }
        // if (isset($request->app_status)) {
        //     $Userdata->whereIn('six_table_view.app_status', $request->app_status);
        // }
        // if (isset($request->client)) {
        //     $Userdata->whereIn('six_table_view.client', $request->client);
        // }
        // if (isset($request->career_level)) {
        //     // return $request->career_level;
        //     $Userdata->whereIn('six_table_view.career_endo', $request->career_level);
        // }
        // if (isset($request->date)) {

        //     $Userdata->where('six_table_view.endi_date', $request->date);
        // }

        // if (isset($request->searchKeyword)) {
        //     ini_set('max_execution_time', 60000); //300 seconds = 5 minutes
        //     $searchCheck = true;
        //     $perfect_match = DB::table('six_table_view')->get();

        //     foreach ($perfect_match as $match) {
        //         if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.last_name', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->candidate_profile), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.candidate_profile', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->sub_segment), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.sub_segment', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->app_status), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.app_status', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->client), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.client', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->career_endo), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.career_endo', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->curr_salary), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.curr_salary', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->exp_salary), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.exp_salary', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->endi_date), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.endi_date', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->off_salary), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.off_salary', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->candidate_profile), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.candidate_profile', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //     }
        // }
        // if ($check) {

        //     $Alldata = $Userdata->get();
        // } else {
        //     if (!$check && !$searchCheck) {
        //         $Alldata = $Userdata->get();
        //     } else {
        //         $Alldata = [];
        //     }
        // }

        // $count = count($Alldata);
        $data = [
            'count' => 1,
            // 'Userdata' => $Alldata,
        ];
        return view('record.filter-user', $data);
    }
    // function for appending the resulting view to filtered record ends

    // function for appending the data of selected row candidate starts
    public function UserDetails(Request $request)
    {

        // return $request->id;
        $user = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as cid', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.app_status', 'endorsements.*')
            ->where('candidate_informations.id', $request->id)
            ->first();

        $domainDrop = Domain::all();
        $pos_title = DB::table('taverse2')->distinct()->select('position')->get();
        $client = DB::table('taverse2')->distinct()->select('client')->get();

        $data = [
            'user' => $user,
            'client' => $client,
            'pos_title' => $pos_title,
            'domainDrop' => $domainDrop,
        ];
        return view('record.user_detail', $data);
    }
    // function for appending the data of selected row candidate ends

    public function updateDetails(Request $request)
    {
        // return $request->all();

        $arrayCheck = [
            'SOURCE' => 'required',
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
            // $name = explode(" ", $request->first_name);
            CandidateInformation::where('id', $request->id)->update([
                'first_name' => $request->first_name,
                // 'middle_name' => $name[1],
                // 'last_name' => $name[2],
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
                'source' => $request->SOURCE,
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
            Cache::forget('users');

            //return success response after successfull data entry
            return response()->json(['success' => true, 'message' => 'Updated successfully']);
        }
    }
}
