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
use App\Http\Controllers\Controller;
use App\Segment;
use App\User;
use Artisan;
use Auth;
use Cache;
use DB;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Str;
use Yajra\DataTables\DataTables;

class RecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-record', ['only' => ['index']]);
        $this->middleware('permission:edit-record', ['only' => ['updateDetails']]);
    }
    // index function for showing the record of users with filters starts
    public function index(Request $request)
    {
        ini_set('memory_limit', '-1');
        $recordExist = 0;
        $cid = 0;
        if (isset($_GET['id'])) {
            $recordExist = 1;
            $cid = $_GET['id'];
            $data = [
                'recordExist' => $recordExist,
                'cid' => $cid,
            ];
            return view('record.view_record', $data);
        }
        $data = [
            'recordExist' => $recordExist,
            'cid' => $cid,

        ];
        return view('record.view_record', $data);
    }
    // index function for showing the record of users with filters ends

    // show data table for view record page starts
    public function view_record_filter_table(Request $request)
    {
        ini_set('memory_limit', '-1');
        $check = $searchCheck = false;

        // $Userdata = DB::table('updated_view_record')->orderBy('timestamp', 'desc');
        $Userdata = DB::table('updated_view_record');

        // condition for checking first to end not null starts here

        if (isset($request->user_id)) {
            $Userdata->whereIn('updated_view_record.saved_by', $request->user_id);
        }
        if (isset($request->candidate)) {
            $Userdata->whereIn('updated_view_record.cid', $request->candidate);
        }
        if (isset($request->profile)) {
            $Userdata->whereIn('updated_view_record.candidate_profile', $request->profile);
        }
        if (isset($request->sub_segment)) {
            $Userdata->whereIn('updated_view_record.sub_segment', $request->sub_segment);
        }
        if (isset($request->app_status)) {
            $Userdata->whereIn('updated_view_record.app_status', $request->app_status);
        }
        if (isset($request->client)) {
            $Userdata->whereIn('updated_view_record.client', $request->client);
        }
        if (isset($request->career_level)) {
            // return $request->career_level;
            $Userdata->whereIn('updated_view_record.career_endo', $request->career_level);
        }
        if (isset($request->date)) {

            $Userdata->where('updated_view_record.endi_date', $request->date);
        }
        $Alldata = $Userdata->get();
        $totalCount = count($Alldata);
        // return $Alldata;
        return Datatables::of($Alldata)
            ->addIndexColumn()
            ->addColumn('id', function ($Alldata) {
                return $Alldata->cid . '-' . $Alldata->numberOfEndo . '-' . $Alldata->saved_by;
            })

            ->addColumn('team', function ($record) {
                // $userid = User::where('id', $record->saved_by)->get();
                // $team = $userid[0]->roles->pluck('name');
                // return json_decode($team);
                return $record->team_name;

            })
            ->addColumn('recruiter', function ($record) {
                // $recr = (User::where('id', $record->saved_by)->first())->name;
                // return $recr;
                return $record->recruiter_name;

            })
            ->addColumn('date_shifted', function ($record) {
                return $record->date_shifted;
            })
            ->addColumn('profile', function ($record) {
                return $record->candidate_profile;
            })
            ->addColumn('date_invited', function ($record) {
                return $record->date_invited;
            })

            ->addColumn('Candidate', function ($record) {
                return $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name;

            })
            ->addColumn('gender', function ($record) {
                return $record->gender;
            })
            ->addColumn('phone', function ($record) {
                return $record->phone;
            })
            ->addColumn('Email', function ($record) {
                return $record->email;

            })
            ->addColumn('address', function ($record) {
                return $record->address;
            })
            ->addColumn('course', function ($record) {
                return $record->course;
            })
            ->addColumn('educational_attain', function ($record) {
                return $record->educational_attain;
            })
            ->addColumn('certification', function ($record) {
                return $record->certification;
            })
            ->addColumn('emp_history', function ($record) {
                return $record->emp_history;
            })
            ->addColumn('interview_note', function ($record) {
                return $record->interview_note;
            })

            ->addColumn('exp_salary', function ($record) {
                return $record->exp_salary;
            })

        // ->addColumn('Replacement_For', function ($Alldata) {
        //     return $Alldata->replacement_for;
        // })
        // ->addColumn('OR_Number', function ($Alldata) {
        //     return $Alldata->or_number;

        // })
            ->addColumn('appStatus', function ($record) {
                return $record->app_status;
            })
            ->addColumn('type', function ($record) {
                return $record->type;
            })
            ->addColumn('endi_date', function ($record) {
                if (!empty($record->endi_date && $record->endi_date != '0000-00-00')) {
                    $endi_date = date_format(date_create($record->endi_date), "m-d-Y");
                    return $endi_date;
                } else {
                    $record->endi_date = '';
                }
            })

            ->addColumn('client', function ($record) {
                return $record->client;
            })
            ->addColumn('site', function ($record) {
                return $record->site;
            })
            ->addColumn('position_title', function ($record) {
                return $record->position_title;
            })
            ->addColumn('career_level', function ($record) {
                return $record->career_endo;
            })

            ->addColumn('segment', function ($record) {
                return $record->segment;
            })
            ->addColumn('sub_segment', function ($record) {
                return $record->sub_segment;
            })
            ->addColumn('endostatus', function ($record) {
                return $record->endostatus;
            })

            ->addColumn('remarks_for_finance', function ($record) {
                return $record->remarks_for_finance;
            })
        // ->addColumn('invoice_number', function ($record) {
        //     return $record->invoice_number;
        // })
            ->addColumn('onboardnig_date', function ($record) {
                return $record->onboardnig_date;
            })
            ->with([
                'search' => $request->searchKeyword,
            ])
            ->setTotalRecords($totalCount)
            ->rawColumns([
                'id',
                'recruiter',
                'team',
                'Candidate',
                'appStatus',
                'profile',
                'career_level',
                'certification',
                'client',
                'phone',
                'course',
                'endi_date',
                'date_invited',
                'date_shifted',
                'educational_attain',
                'emp_history',
                'type',
                'exp_salary',
                'gender',
                'interview_note',
                'invoice_number',
                'onboardnig_date',
                'position_title',
                'remarks_for_finance',
                'address',
                'segment',
                'site',
                'endostatus',
                'sub_segment',
            ])
            ->make(true);
    }
    public function view_record_table(Request $request)
    {
        if ($request->search['value'] != '') {
            $recordQuery = DB::table('updated_view_record');
            if ($request->search['value'] == strtolower('male') || $request->search['value'] == strtolower('female') || $request->search['value'] == strtolower('graduate')) {
                if ($request->search['value'] == strtolower('male')) {
                    $recordQuery->where('gender', "'MALE'");
                }
                if ($request->search['value'] == strtolower('female')) {
                    $recordQuery->where('gender', "'FEMALE'");
                }
                if ($request->search['value'] == strtolower('graduate')) {
                    $recordQuery->where('educational_attain', "'GRADUATE'");
                }
            } else {

                $columnArray = ['team_name', 'recruiter_name', 'first_name', 'middle_name', 'last_name', 'date_shifted', 'candidate_profile', 'date_invited', 'gender', 'email', 'address', 'course', 'educational_attain', 'certification', 'emp_history', 'type', 'app_status', 'exp_salary', 'interview_note', 'endi_date', 'client', 'site', 'position_title', 'career_endo', 'segment_endo', 'sub_segment_endo', 'endostatus', 'remarks_for_finance', 'remarks_recruiter', 'onboardnig_date', 'invoice_number', 'or_number', 'replacement_for'];
                foreach ($columnArray as $value) {
                    $search = "%" . $request->search['value'] . "%";
                    $recordQuery->orWhere($value, 'like', "'$search'");
                }
            }
            $sqlQuery = Str::replaceArray('?', $recordQuery->getBindings(), $recordQuery->toSql());
            $result = DB::select($sqlQuery);
            $record = $result;
            $totalCount = count($record);

        } else {
            $totalCount = DB::select('select count(*) as total from endorsements where candidate_id=candidate_id and is_deleted = 0');
            $totalCount = ($totalCount)[0]->total;
            $record = DB::table('updated_view_record');
        }
        ini_set('memory_limit', '-1');
        // $record = DB::table('view_record')->orderBy('timestamp', 'desc')->get();
        Artisan::call('cache:clear');
        $totalCount = DB::select('select count(*) as total from endorsements where candidate_id=candidate_id and is_deleted = 0');
        $totalCount = ($totalCount)[0]->total;
        return Datatables::of($record)
            ->addIndexColumn()
            ->addColumn('id', function ($record) {
                return $record->cid . '-' . $record->numberOfEndo . '-' . $record->saved_by;
            })
            ->addColumn('team', function ($record) {
                // $userid = User::where('id', $record->saved_by)->get();
                // $team = $userid[0]->roles->pluck('name');
                // return json_decode($team);
                return $record->team_name;

            })
            ->addColumn('recruiter', function ($record) {
                // $recr = (User::where('id', $record->saved_by)->first())->name;
                // return $recr;
                return $record->recruiter_name;

            })
            ->addColumn('date_shifted', function ($record) {
                return $record->date_shifted;
            })
            ->addColumn('profile', function ($record) {
                return $record->candidate_profile;
            })
            ->addColumn('date_invited', function ($record) {
                return $record->date_invited;
            })

            ->addColumn('Candidate', function ($record) {
                return $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name;

            })
            ->addColumn('gender', function ($record) {
                return $record->gender;
            })
            ->addColumn('phone', function ($record) {
                return $record->phone;
            })
            ->addColumn('Email', function ($record) {
                return $record->email;

            })
            ->addColumn('address', function ($record) {
                return $record->address;
            })
            ->addColumn('course', function ($record) {
                return $record->course;
            })
            ->addColumn('educational_attain', function ($record) {
                return $record->educational_attain;
            })
            ->addColumn('certification', function ($record) {
                return $record->certification;
            })
            ->addColumn('emp_history', function ($record) {
                return $record->emp_history;
            })
            ->addColumn('interview_note', function ($record) {
                return $record->interview_note;
            })

            ->addColumn('exp_salary', function ($record) {
                return $record->exp_salary;
            })

        // ->addColumn('Replacement_For', function ($Alldata) {
        //     return $Alldata->replacement_for;
        // })
        // ->addColumn('OR_Number', function ($Alldata) {
        //     return $Alldata->or_number;

        // })
            ->addColumn('appStatus', function ($record) {
                return $record->app_status;
            })
            ->addColumn('type', function ($record) {
                return $record->type;
            })
            ->addColumn('endi_date', function ($record) {
                if (!empty($record->endi_date && $record->endi_date != '0000-00-00')) {
                    $endi_date = date_format(date_create($record->endi_date), "m-d-Y");
                    return $endi_date;
                } else {
                    $record->endi_date = '';
                }
            })

            ->addColumn('client', function ($record) {
                return $record->client;
            })
            ->addColumn('site', function ($record) {
                return $record->site;
            })
            ->addColumn('position_title', function ($record) {
                return $record->position_title;
            })
            ->addColumn('career_level', function ($record) {
                return $record->career_endo;
            })

            ->addColumn('segment', function ($record) {
                return $record->segment;
            })
            ->addColumn('sub_segment', function ($record) {
                return $record->sub_segment;
            })
            ->addColumn('endostatus', function ($record) {
                return $record->endostatus;
            })

            ->addColumn('remarks_for_finance', function ($record) {
                return $record->remarks_for_finance;
            })
        // ->addColumn('invoice_number', function ($record) {
        //     return $record->invoice_number;
        // })
            ->addColumn('onboardnig_date', function ($record) {
                return $record->onboardnig_date;
            })
            ->setTotalRecords($totalCount)

            ->rawColumns([
                'id',
                'recruiter',
                'team',
                'Candidate',
                'appStatus',
                'profile',
                'career_level',
                'certification',
                'client',
                'phone',
                'course',
                'endi_date',
                'date_invited',
                'date_shifted',
                'educational_attain',
                'emp_history',
                'type',
                'exp_salary',
                'gender',
                'interview_note',
                'invoice_number',
                'onboardnig_date',
                'position_title',
                'remarks_for_finance',
                'address',
                'segment',
                'site',
                'endostatus',
                'sub_segment',
            ])
            ->make(true);

    }
    // show data table for view record page ends

    // function for appending the resulting view to filtered record starts
    public function filter(Request $request)
    {
        return view('record.filter-user');
    }
    // function for appending the resulting view to filtered record ends

    // function for appending the data of selected row candidate starts
    public function UserDetails(Request $request)
    {
        $arrayofID = explode('-', $request->id);
        $user = DB::table('updated_view_record')
            ->where(['numberofEndo' => $arrayofID[1], 'id' => $arrayofID[0] == '' ? 0 : $arrayofID[0], 'recruiter_id' => $arrayofID[2]])
            ->first();
        $domainDrop = Domain::all();
        $pos_title = DB::table('taverse2')->distinct()->select('position')->get();
        $client = DB::table('taverse2')->distinct()->select('client')->get();
        $remarks = $user->remarks_for_finance;
        $data = [
            'user' => $user,
            'client' => $client,
            'pos_title' => $pos_title,
            'domainDrop' => $domainDrop,
            'remarks' => $remarks,
        ];
        return view('record.user_detail', $data);
    }
    // function for appending the data of selected row candidate ends

    public function updateDetails(Request $request)
    {
        // return $request->id;
        $arr = explode('-', $request->id);
        $c_id = $arr[0];
        $endo_id = $arr[1];
        if (Auth::user()->agent == 1) {
            $arrayCheck = [
                "EMPLOYMENT_HISTORY" => 'required ',
                // "DOMAIN" => 'required ',
                'LAST_NAME' => 'required',
                "FIRST_NAME" => "required",
                "EMAIL_ADDRESS" => "required|email",
                "CONTACT_NUMBER" => "required",
                "GENDER" => "required",
                // "CERTIFICATIONS" => "required",
                "RESIDENCE" => 'required ',
                "APPLICATION_STATUS" => 'required ',
                "SOURCE" => 'required ',
                // "EDUCATIONAL_ATTAINTMENT" => 'required ',
                // // "COURSE" => 'required ',
                "MANNER_OF_INVITE" => 'required ',
                "CANDIDATES_PROFILE" => 'required ',
                // "INTERVIEW_NOTES" => 'required ',
                "DATE_SIFTED" => 'required|date|after:1970-01-01',
                // "SEGMENT" => 'required ',
                // "SUB_SEGMENT" => 'required ',
                "POSITION_TITLE_APPLIED" => 'required ',
                // // "DATE_INVITED" => 'required ',
                // "MANNER_OF_INVITE" => 'required ',
                // "CURRENT_SALARY" => 'required ',
                // "file" => 'required ',
                // "CURRENT_ALLOWANCE" => 'required ',
                // "EXPECTED_SALARY" => 'required ',
                // "OFFERED_SALARY" => 'required ',
                // "OFFERED_ALLOWANCE" => 'required ',
            ];
            $status = Str::lower($request->APPLICATION_STATUS);
            if (str_contains($status, 'active') || str_contains($status, 'to be')) {
                $arrayCheck["EDUCATIONAL_ATTAINTMENT"] = "required";
                $arrayCheck["EXPECTED_SALARY"] = "required";
                $arrayCheck["CURRENT_SALARY"] = "required";
                $arrayCheck["INTERVIEW_NOTES"] = "required";
            }
            $manner_of_invite = Str::lower($request->MANNER_OF_INVITE);
            if (
                str_contains($manner_of_invite, 'sms') || str_contains($manner_of_invite, 'email') || str_contains($manner_of_invite, 'call')
                || str_contains($manner_of_invite, 'viber') || str_contains($manner_of_invite, 'skype') || str_contains($manner_of_invite, 'mess')
                || str_contains($manner_of_invite, 'sms')
            ) {
                $arrayCheck["DATE_INVITED"] = "required|date|after:1970-01-01";
            }
            if ($request->rfp == 1) {
                $arrayCheck["REASONS_FOR_NOT_PROGRESSING"] = "required";
            }
            if ($request->interview_schedule == 1) {
                $arrayCheck["INTERVIEW_SCHEDULE"] = "required";
            }
            if ($request->salary_field == 1) {
                $arrayCheck["OFFERED_SALARY"] = "required";
                $arrayCheck["OFFERED_ALLOWANCE"] = "required";
            }
            if ($request->EDUCATIONAL_ATTAINTMENT == 'HIGH SCHOOL GRADUATE' || $request->EDUCATIONAL_ATTAINTMENT == "") {
            } else {
                $arrayCheck["COURSE"] = "required";
            }

            if ($request->endorsement_field == 'active') {
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["ENDORSEMENT_TYPE"] = "required";
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["CAREER_LEVEL"] = "required";
                $arrayCheck["DATE_ENDORSED"] = "required|date|after:1970-01-01";
                $arrayCheck["STATUS"] = "required";
                $arrayCheck["CLIENT"] = "required";
                $arrayCheck["SITE"] = "required";
                $arrayCheck["REMARKS_FOR_FINANCE"] = "required";
                // $arrayCheck["REMARKS_FROM_FINANCE"] = "required";
            }
            $array = Str::lower($request->REMARKS_FOR_FINANCE);

            if (str_contains($array, 'onboarded') || str_contains($array, 'accepted')) {
                // $arrayCheck["REMARKS"] = "required";
                // $arrayCheck["ONBOARDING_DATE"] = "required|date|after:1970-01-01";
                $arrayCheck["TOTAL_BILLABLE_AMOUNT"] = "required";
                $arrayCheck["RATE"] = "required";
                // $arrayCheck["PLACEMENT_FEE"] = "required";
            }
        } else {
            $arrayCheck = [
                'LAST_NAME' => 'required',
                "FIRST_NAME" => "required",
                "EMAIL_ADDRESS" => "required|email",
                "SOURCE" => 'required ',
                "CONTACT_NUMBER" => "required",
                "GENDER" => "required",
                "RESIDENCE" => 'required ',
                "EDUCATIONAL_ATTAINTMENT" => 'required ',
                // "DOMAIN" => 'required ',
                // "SEGMENT" => 'required ',
                // "SUB_SEGMENT" => 'required ',
                // // "COURSE" => 'required ',
                "CANDIDATES_PROFILE" => 'required ',
                "APPLICATION_STATUS" => 'required ',
                // "INTERVIEW_NOTES" => 'required ',
                "DATE_SIFTED" => 'required ',
                "EMPLOYMENT_HISTORY" => 'required ',
                "POSITION_TITLE_APPLIED" => 'required ',
                // // "DATE_INVITED" => 'required ',
                "MANNER_OF_INVITE" => 'required ',
                // "CURRENT_SALARY" => 'required ',
                // "file" => 'required ',
                // "CURRENT_ALLOWANCE" => 'required ',
                // "EXPECTED_SALARY" => 'required ',
                // "OFFERED_SALARY" => 'required ',
                // "OFFERED_ALLOWANCE" => 'required ',
            ];
            if ($request->EDUCATIONAL_ATTAINTMENT == 'HIGH SCHOOL GRADUATE' || $request->EDUCATIONAL_ATTAINTMENT == "" || $request->EDUCATIONAL_ATTAINTMENT == 'SENIOR HIGH SCHOOL GRADUATE') {
            } else {
                $arrayCheck["COURSE"] = "required";
            }

            if ($request->endorsement_field == 'active') {
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["ENDORSEMENT_TYPE"] = "required";
                $arrayCheck["POSITION_TITLE"] = "required";
                $arrayCheck["CAREER_LEVEL"] = "required";
                $arrayCheck["DATE_ENDORSED"] = "required";
                $arrayCheck["STATUS"] = "required";
                $arrayCheck["CLIENT"] = "required";
                $arrayCheck["SITE"] = "required";
                $arrayCheck["REMARKS_FOR_FINANCE"] = "required";
                // $arrayCheck["REMARKS_FROM_FINANCE"] = "required";
            }
            if ($request->finance_field == 1) {
                // $arrayCheck["REMARKS"] = "required";
                // $arrayCheck["ONBOARDING_DATE"] = "required";
                $arrayCheck["TOTAL_BILLABLE_AMOUNT"] = "required";
                $arrayCheck["RATE"] = "required";
                // $arrayCheck["PLACEMENT_FEE"] = "required";
            }
            $status = Str::lower($request->APPLICATION_STATUS);
            if (str_contains($status, 'active') || str_contains($status, 'to be')) {
                $arrayCheck["EDUCATIONAL_ATTAINTMENT"] = "required";
                $arrayCheck["EXPECTED_SALARY"] = "required";
                $arrayCheck["CURRENT_SALARY"] = "required";
                $arrayCheck["INTERVIEW_NOTES"] = "required";
            }
            $manner_of_invite = Str::lower($request->MANNER_OF_INVITE);
            if (
                str_contains($manner_of_invite, 'sms') || str_contains($manner_of_invite, 'email') || str_contains($manner_of_invite, 'call')
                || str_contains($manner_of_invite, 'viber') || str_contains($manner_of_invite, 'skype') || str_contains($manner_of_invite, 'mess')
                || str_contains($manner_of_invite, 'sms')
            ) {
                $arrayCheck["DATE_INVITED"] = "required";
            }
        }

        $validator = Validator::make($request->all(), $arrayCheck);
        if (!$validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()]);
        } else {
            // Update data of eantry page
            // $name = explode(" ", $request->first_name, 3);
            $CandidateInformation =  CandidateInformation::where('id', $c_id)->firstOrfail();
            $CandidateEducation =  CandidateEducation::where('candidate_id', $c_id)->firstOrfail();
            $CandidiateDomain =  CandidateDomain::where('candidate_id', $c_id)->firstOrfail();
            $CandidiatePosition =  CandidatePosition::where('candidate_id', $c_id)->firstOrfail();
            $endorsement =  Endorsement::where('id', $endo_id)->firstOrfail();
            $finance =  Finance::where('endorsement_id', $endo_id)->firstOrfail(); 


            // save data to candidate information table
            $CandidateInformation->last_name = $request->LAST_NAME;
            $CandidateInformation->middle_name = $request->MIDDLE_NAME;
            $CandidateInformation->first_name = $request->FIRST_NAME;
            $CandidateInformation->email = $request->EMAIL_ADDRESS;
            $CandidateInformation->phone = $request->CONTACT_NUMBER;
            $CandidateInformation->gender = $request->GENDER;
            $CandidateInformation->address = $request->RESIDENCE;
            $CandidateInformation->dob = $request->DATE_OF_BIRTH; 
            $CandidateInformation->save();

            $CandidateEducation->educational_attain = $request->EDUCATIONAL_ATTAINTMENT;
            $CandidateEducation->candidate_id = $CandidateInformation->id;

            // save course if according to selcteedd educational attainment
            if ($request->COURSE === null) {
                $CandidateEducation->course = 'N/A';
            } else {
                $CandidateEducation->course = $request->COURSE;
            }
            if (isset($request->CERTIFICATIONS)) {
                $certification = implode(",", $request->CERTIFICATIONS);
                $CandidateEducation->certification = $certification;
            }
            $CandidateEducation->save();


            $CandidiatePosition->candidate_id = $CandidateInformation->id;
            $CandidiatePosition->candidate_profile = $request->CANDIDATES_PROFILE;
            $CandidiatePosition->position_applied = $request->POSITION_TITLE_APPLIED;
            $CandidiatePosition->date_invited = $request->DATE_INVITED;
            $CandidiatePosition->manner_of_invite = $request->MANNER_OF_INVITE;
            $CandidiatePosition->source = $request->SOURCE;
            $CandidiatePosition->curr_salary = $request->CURRENT_SALARY;
            $CandidiatePosition->exp_salary = $request->EXPECTED_SALARY;
            $CandidiatePosition->off_salary = $request->OFFERED_SALARY;
            $CandidiatePosition->curr_allowance = $request->CURRENT_ALLOWANCE;
            $CandidiatePosition->off_allowance = $request->OFFERED_ALLOWANCE;

            // Upload CV of user
            if ($request->hasFile('file')) {
                $path = base_path();
                $path = str_replace("laravel", "public_html", $path); // <= This one !
                $destinationPath = $path . '/public/assets/cv'; // upload path
                $fileName = $request->CONTACT_NUMBER . time() . '.pdf';
                // $path = 'assets/cv';
                $request->file->move($destinationPath, $fileName);
                $CandidiatePosition->cv = $fileName;
            }
            $CandidiatePosition->save();


            if (is_numeric(isset($request->Domainsegment))) {
                $name = (DropDownOption::where('id', $request->Domainsegment)->first())->option_name;
            } else {
                $name = $request->Domainsegment;
            }
            if (is_numeric(isset($request->Domainsub))) {
                $Sub_name = (DropDownOption::where('id', $request->Domainsub)->first())->option_name;
            } else {
                $Sub_name = $request->Domainsub;
            }
            if (is_numeric(isset($request->DOMAIN))) {
                $domain = (Domain::where('id', $request->DOMAIN)->first())->domain_name;
            } else {
                $domain = $request->DOMAIN;
            }
            // return $name;
            //  save data to candidate domain table
            // $CandidiateDomain = CandidateDomain::find($candidate_id);
            $CandidiateDomain->candidate_id = $CandidateInformation->id;
            $CandidiateDomain->date_shifted = $request->DATE_SIFTED;
            // $domain_name = Domain::where('domain_name', $request->DOMAIN)->first();
            $CandidiateDomain->domain = $domain;
            $CandidiateDomain->emp_history = $request->EMPLOYMENT_HISTORY;
            $CandidiateDomain->interview_note = $request->INTERVIEW_NOTES;
            // $name = Segment::where('segment_name', $request->SEGMENT)->first();
            $CandidiateDomain->segment = $name;
            // $Sub_name = SubSegment::where('sub_segment_name', $request->SUB_SEGMENT)->first();
            $CandidiateDomain->sub_segment = $Sub_name;
            $CandidiateDomain->save();

            $array = Str::lower($request->REMARKS_FOR_FINANCE);
            $category = Helper::getCategory($array);
            $endorsement->candidate_id = $CandidateInformation->id;
            $endorsement->app_status = $request->APPLICATION_STATUS;
            $endorsement->remarks = $request->REMARKS_FROM_FINANCE;
            $endorsement->client = $request->CLIENT;
            $endorsement->status = $request->STATUS;
            $endorsement->type = $request->ENDORSEMENT_TYPE;
            $endorsement->site = $request->SITE;
            $endorsement->domain_endo = $request->DOMAIN_ENDORSEMENT;
            $endorsement->position_title = $request->POSITION_TITLE;
            $endorsement->timestamp = time(); 
            $endorsement->interview_date = $request->INTERVIEW_SCHEDULE;
            $endorsement->rfp = $request->REASONS_FOR_NOT_PROGRESSING;
            $endorsement->career_endo = $request->CAREER_LEVEL;
            $endorsement->segment_endo = $request->SEGMENT;
            $endorsement->sub_segment_endo = $request->SUB_SEGMENT;
            $endorsement->endi_date = $request->DATE_ENDORSED;
            $endorsement->remarks_for_finance = $request->REMARKS_FOR_FINANCE;
            $endorsement->saved_by = Auth::user()->id;
            $endorsement->category = $category;
 
            $endorsement->save();



            $finance->candidate_id = $CandidateInformation->id;
            $finance->endorsement_id = $endorsement->id;
            $finance->remarks_recruiter = $request->REMARKS;
            $finance->onboardnig_date = $request->ONBOARDING_DATE;
            $finance->invoice_number = $request->INVOICE_NUMBER;
            $finance->client_finance = $request->CLIENT_FINANCE;
            $finance->career_finance = $request->CAREER_LEVEL_FINANCE;
            $finance->rate = preg_replace('/%/', '', $request->RATE);
            $finance->srp = $request->STANDARD_PROJECTED_REVENUE;
            $finance->Total_bilable_ammount = $request->TOTAL_BILLABLE_AMOUNT;
            $finance->offered_salary = $request->OFFERED_SALARY_finance;
            $finance->allowance = $request->ALLOWANCE;
            $finance->placement_fee = $request->PLACEMENT_FEE;
            $recruiter = Auth::user()->roles->pluck('id');
            $finance->t_id = $recruiter[0];
            $finance->remarks_recruiter = 'Unbilled';
            $finance->save();





            // CandidateInformation::where('id', $c_id)->update([
            //     // 'first_name' => isset($name[0]) ? $name[0] : '',
            //     // 'middle_name' => isset($name[1]) ? $name[1] : '',
            //     // 'last_name' => isset($name[2]) ? $name[2] : '',
            //     'email' => $request->email,
            //     'phone' => $request->phone,
            //     'address' => $request->address,
            //     'gender' => $request->gender,
            //     'dob' => $request->dob,
            //     'status' => '1',
            //     // 'saved_by' => Auth::user()->id,
            // ]);

            // // update candidate education data
            // $For_save_good_format = [];
            // if (isset($request->CERTIFICATIONS)) {

            //     $For_save_good_format = implode(",", $request->CERTIFICATIONS);
            // }

            // CandidateEducation::where('candidate_id', $c_id)->update([
            //     'educational_attain' => $request->EDUCATIONAL_ATTAINTMENT,
            //     'course' => $request->COURSE,
            //     'certification' => $For_save_good_format,
            // ]);

            // $array = Str::lower($request->REMARKS_FOR_FINANCE);
            // $category = Helper::getCategory($array);
            // // update candidae domain data
            // // $domain_name = Domain::where('id', $request->DOMAIN)->first();
            // // $name = Segment::where('id', $request->segment)->first();
            // // $Sub_name = SubSegment::where('id', $request->sub_segment)->first();
            // if (is_numeric(isset($request->segment))) {
            //     $name = (DropDownOption::where('id', $request->segment)->first())->option_name;
            // } else {
            //     $name = $request->segment;
            // }
            // if (is_numeric(isset($request->sub_segment))) {
            //     $Sub_name = (DropDownOption::where('id', $request->sub_segment)->first())->option_name;
            // } else {
            //     $Sub_name = $request->sub_segment;
            // }
            // if (is_numeric(isset($request->DOMAIN))) {
            //     $domain = (Domain::where('id', $request->DOMAIN)->first())->domain_name;
            // } else {
            //     $domain = $request->DOMAIN;
            // }
            // if (is_numeric(isset($request->endo_segment))) {
            //     $e_name = (DropDownOption::where('id', $request->endo_segment)->first())->option_name;
            // } else {
            //     $e_name = $request->endo_segment;

            // }
            // if (is_numeric(isset($request->endo_sub_segment))) {

            //     $e_sub_name = (DropDownOption::where('id', $request->endo_sub_segment)->first())->option_name;
            // } else {
            //     $e_sub_name = $request->endo_sub_segment;
            // }
            // if (is_numeric(isset($request->DOMAIN_endo))) {

            //     $e_domain = (Domain::where('id', $request->DOMAIN_endo)->first())->domain_name;

            // } else {
            //     $e_domain = $request->DOMAIN_endo;

            // }

            // CandidateDomain::where('candidate_id', $c_id)->update([
            //     'date_shifted' => $request->date_shifted,
            //     'domain' => $domain,
            //     'interview_note' => $request->notes,
            //     'segment' => $name,
            //     'sub_segment' => $Sub_name,
            //     'emp_history' => $request->EMPLOYMENT_HISTORY,
            // ]);

            // // update candidate position data according to requested data
            // CandidatePosition::where('candidate_id', $c_id)->update([
            //     'candidate_profile' => $request->CANDIDATES_PROFILE,
            //     'position_applied' => $request->position_applied,
            //     'date_invited' => $request->date_invited,
            //     'manner_of_invite' => $request->manner_of_invite,
            //     'curr_salary' => $request->curr_salary,
            //     'exp_salary' => $request->expec_salary,
            //     'off_salary' => $request->offered_salary,
            //     'source' => $request->SOURCE,
            //     'curr_allowance' => $request->curr_allowance,
            //     'off_allowance' => $request->offered_allowance,

            // ]);
            // //update endorsements table according to data updated
            // Endorsement::where(['candidate_id' => $c_id, 'id' => $endo_id, 'saved_by' => Auth::user()->id])->update([
            //     'app_status' => $request->APPLICATION_STATUS,
            //     'remarks' => $request->REMARKS_FROM_FINANCE,
            //     'client' => $request->CLIENT_FINANCE,
            //     'site' => $request->SITE,
            //     'status' => $request->STATUS,
            //     'type' => $request->ENDORSEMENT_TYPE,
            //     'position_title' => $request->POSITION_TITLE,
            //     'domain_endo' => $e_domain,
            //     'interview_date' => $request->INTERVIEW_SCHEDULE,
            //     'career_endo' => $request->CAREER_LEVEL,
            //     'segment_endo' => $e_name,
            //     'category' => $category,
            //     'sub_segment_endo' => $e_sub_name,
            //     'rfp' => $request->REASONS_FOR_NOT_PROGRESSING,
            //     'endi_date' => $request->endo_date,
            //     'remarks_for_finance' => $request->REMARKS_FOR_FINANCE,
            // ]);

            //save CANDIDATE addeed log to table starts
            Helper::save_log('CANDIDATE_UPDATED_FROM_VIEW_RECORD_');
            // save CANDIDATE added to log table ends
            Cache::forget('users');

            //return success response after successfull data entry
            return response()->json(['success' => true, 'message' => 'Updated successfully']);
        }
    }
    // close
    // append filter options
    public function appendFilterOptions()
    {
        $user = User::where('type', 3)->get();
        // $candidates = DB::table('candidate_informations')
        //     ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
        //     ->select('candidate_informations.id',
        //         'candidate_informations.first_name', 'candidate_informations.last_name', 'candidate_informations.middle_name',
        //         DB::raw("CONCAT(IFNULL(candidate_informations.first_name ,' '),' ',IFNULL(candidate_informations.middle_name ,' '),' ',IFNULL(candidate_informations.last_name,' ')) as name"))
        //     ->where('endorsements.is_deleted', 0)
        //     ->distinct()
        //     ->get();
        $candidates = [];
        // return $candidates;
        $candidates_profile = Helper::get_dropdown('candidates_profile');
        $sub_segment = Helper::get_dropdown('sub_segment');
        $application_status = Helper::get_dropdown('application_status');
        $career_level = Helper::get_dropdown('career_level');
        $clients = Helper::get_dropdown('clients');
        return response()->json(
            [
                'user' => $user,
                'candidates' => $candidates,
                'candidates_profile' => $candidates_profile,
                'sub_segment' => $sub_segment,
                'application_status' => $application_status,
                'career_level' => $career_level,
                'clients' => $clients,
            ]
        );
    }
    // close

    // delete candidate data function
    public function deleteCandidateData(Request $request)
    {
       
        try {
            if ($request->id) {
                $data = explode('-', $request->id);
                $user_id = $data[0];
                $e_id = $data[1];
                $saved_by = $data[2];
                $f_id = $data[3];

                Endorsement::where( 'id', $e_id )->update([ 'is_deleted' => 1 ]);
                Cipprogress::where('endorsement_id' , $e_id)->delete();
                Finance::where( 'endorsement_id' , $e_id)->delete();
                Helper::save_log('CANDIDATE_DELETED');
                return response()->json(['success' => true, 'message' => 'Record Deleted Succesfully!']);
            }
        } catch (\Exception$e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    // close

    public function showCandidate_nameDrpDown(Request $request)
    {
        if ($request->has('q')) {
            $search = $request->q;
            $data = DB::table('updated_view_record')
                ->where('fullName', 'LIKE', "%$search%")->select('id', 'fullName')->distinct()
                ->get();
        }
        return response()->json($data);

    }
}
