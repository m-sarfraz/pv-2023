<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Helper;
use Illuminate\Http\Request;
use Str;
use Yajra\DataTables\DataTables;
use Artisan;
class SmartSearchController extends Controller
{
    // private array for controller to summary append on filter change
    private $candidate_arr = array();

    // __construct() for checking permission
    public function __construct()
    {
        set_time_limit(8000000);
 
        $this->middleware('permission:view-smart-search', ['only' => ['index']]);
    }
    //close

    // index function of finance page
    public function index(Request $request)
    {
        return view('smartSearch.smart_search');
    }
    // close

    // append drop down options on page load
    public function appendSmartFilters()
    {
        $domain = Domain::all();
        $user_recruiter = User::where('type', 3)->get();
        $client = Helper::get_dropdown('clients');
        $address = DB::Select("select address from candidate_informations where  address!='' group by address");
        $remarks = Helper::get_dropdown('remarks_for_finance');
        $status = Helper::get_dropdown('data_entry_status');
        $portal = Helper::get_dropdown('source');
        $career = Helper::get_dropdown('career_level');

        // close
        return response()->json(
            [
                'career' => $career,
                'domain' => $domain,
                'user_recruiter' => $user_recruiter,
                'client' => $client,
                'address' => $address,
                'status' => $status,
                'remarks' => $remarks,
                'portal' => $portal,
            ]
        );
    }
    //close

    // convert table to yajra data table on page load
    public function smartTOYajra()
    {
        ini_set('max_execution_time', -1); //30000 seconds = 500 minutes
        ini_set('memory_limit', '10000M'); //10000M  = 10 GB
        Artisan::call('cache:clear');
        $totalCount = DB::select('select count(*) as total from endorsements where candidate_id=candidate_id and is_deleted = 0');
        $totalCount = ($totalCount)[0]->total; 
        $record = DB::table('updated_view_record');
        return Datatables::of($record)
            ->addIndexColumn()
            ->addColumn('id', function ($record) {
                return $record->cid . '-' . $record->numberOfEndo . '-' . $record->saved_by;
            })
            ->addColumn('recruiter', function ($record) {
                // $recr = (User::where('id', $record->saved_by)->first())->name;
                // return $recr;
                return $record->recruiter_name;

            })
            ->addColumn('team', function ($record) {
                // $userid = User::where('id', $record->saved_by)->get();
                // $team = $userid[0]->roles->pluck('name');
                // return json_decode($team);
                return $record->team_name;

            })
            ->addColumn('Candidate', function ($record) {
                return $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name;

            })
            ->addColumn('Email', function ($Alldata) {
                return $Alldata->email;

            })
            ->addColumn('Replacement_For', function ($Alldata) {
                return $Alldata->replacement_for;
            })
            ->addColumn('OR_Number', function ($Alldata) {
                return $Alldata->or_number;

            })
            ->addColumn('appStatus', function ($record) {
                return $record->app_status;
            })
            ->addColumn('profile', function ($record) {
                return $record->candidate_profile;
            })
            ->addColumn('career_level', function ($record) {
                return $record->career_endo;
            })
            ->addColumn('certification', function ($record) {
                return $record->certification;
            })
            ->addColumn('client', function ($record) {
                return $record->client;
            })
            ->addColumn('phone', function ($record) {
                return $record->phone;
            })
            ->addColumn('course', function ($record) {
                return $record->course;
            })
            ->addColumn('endi_date', function ($record) {
                if (!empty($record->endi_date && $record->endi_date != '0000-00-00')) {
                    $endi_date = date_format(date_create($record->endi_date), "m-d-Y");
                    return $endi_date;
                } else {
                    $record->endi_date = '';
                }
            })
            ->addColumn('date_invited', function ($record) {
                return $record->date_invited;
            })
            ->addColumn('date_shifted', function ($record) {
                return $record->date_shifted;
            })
            ->addColumn('educational_attain', function ($record) {
                return $record->educational_attain;
            })
            ->addColumn('emp_history', function ($record) {
                return $record->emp_history;
            })
            ->addColumn('type', function ($record) {
                return $record->type;
            })
            ->addColumn('exp_salary', function ($record) {
                return $record->exp_salary;
            })
            ->addColumn('gender', function ($record) {
                return $record->gender;
            })
            ->addColumn('interview_note', function ($record) {
                return $record->interview_note;
            })
            ->addColumn('invoice_number', function ($record) {
                return $record->invoice_number;
            })
            ->addColumn('onboardnig_date', function ($record) {
                return $record->onboardnig_date;
            })
            ->addColumn('position_title', function ($record) {
                return $record->position_title;
            })
            ->addColumn('remarks', function ($record) {
                return $record->remarks;
            })
            ->addColumn('remarks_for_finance', function ($record) {
                return $record->remarks_for_finance;
            })
            ->addColumn('address', function ($record) {
                return $record->address;
            })
            ->addColumn('segment', function ($record) {
                return $record->segment;
            })
            ->addColumn('site', function ($record) {
                return $record->site;
            })
            ->addColumn('endostatus', function ($record) {
                return $record->endostatus;
            })
            ->addColumn('sub_segment', function ($record) {
                return $record->sub_segment;
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
                'remarks',
                'remarks_for_finance',
                'address',
                'segment',
                'site',
                'endostatus',
                'sub_segment',
            ])
            ->make(true);

    }
    //close

    // filter record on basis of seelcted dropdowns
    public function filterSearch(Request $request)
    {
        ini_set('memory_limit', '10000M'); //10000M  = 10 GB
        $data = [];
        $check = $searchCheck = false;
        // $search = $request->search;
        $Userdata = DB::table('updated_view_record');
        //    check null values coming form selected options
        if (isset($request->domain)) {
            $Userdata->whereIn('updated_view_record.domain_endo', $request->domain);
        }
        if (isset($request->recruiter)) {
            $Userdata->whereIn('updated_view_record.saved_by', $request->recruiter);
        }
        if (isset($request->status)) {
            $status = explode(',', $request->status);
            $Userdata->whereIn('updated_view_record.endostatus', $status);
        }
        if (isset($request->client)) {
            // return $request->client;
            $Userdata->whereIn('updated_view_record.client', $request->client);
        }
        if ($request->cip == 1) {
            $stageArray = [
                'Scheduled for Skills Interview',
                'Scheduled for Technical Interview',
                'Scheduled for Technical exam',
                'Sheduled for Behavioral Interview',
                'Scheduled for account validation',
                'Done Skills interview/ Awaiting Feedback',
                'Done Techincal Interview /Awaiting Feedback',
                'Done Technical exam /Awaiting Feedback',
                'Done Behavioral /Awaiting Feedback',
                'Failed Skills interview',
                'Failed Techincal Interview',
                'Failed Technical exam',
                'Failed Behavioral Interview',
                'Pending Country Head Interview',
                'Pending Final Interview',
                'Pending Hiring Managers Interview',
                'Withdraw / CNI - Mid',
                'Position Closed (Mid Stage)',
                'Done Skills/Technical Interview / Awaiting Feedback',
                'Failed Skills/Technical Interview',
                'Position On Hold (Mid Stage)',
                'Scheduled for Behavioral Interview',
                'Scheduled for Skills/Technical Interview',
                'Fallout/Reneged',
                'Scheduled for Country Head Interview',
                'Scheduled for Final Interview',
                'Scheduled for Hiring Managers Interview',
                'Done Behavioral Interview / Awaiting Feedback',
                'Done Final Interview / Awaiting Feedback',
                'Done Hiring Managers Interview / Awaiting Feedback',
                'Failed Country Head Interview',
                'Failed Final Interview',
                'Failed Hiring Managers Interview',
                'Scheduled for Job Offer',
                'Shortlisted/For Comparison',
                'Offer accepted',
                'Offer Rejected',
                'Position Closed (Final Stage)',
                'Withdraw / CNI - Final',
                'Done Country Head Interview / Awaiting Feedback',
                'Pending Offer Approval',
                'Pending Offer Schedule',
                'Position On Hold (Final Stage)',
                'Shortlisted',
            ];
            $Userdata->whereIn('updated_view_record.remarks_for_finance', $stageArray);
        }
        if (isset($request->residence)) {
            $Userdata->whereIn('updated_view_record.address', $request->residence);
        }
        if (isset($request->career_level)) {
            $Userdata->whereIn('updated_view_record.career_endo', $request->career_level);
        }
        if (isset($request->category)) {
            $Userdata->whereIn('updated_view_record.category', $request->category);
        }
        if (isset($request->remarks)) {
            $Userdata->whereIn('updated_view_record.remarks_for_finance', $request->remarks);
        }
        if (isset($request->portal)) {
            $Userdata->whereIn('updated_view_record.source', $request->portal);
        }
        if (isset($request->ob_start)) {
            $Userdata->whereDate('updated_view_record.onboardnig_date', '>=', $request->ob_start);
        }
        if (isset($request->ob_end)) {
            $Userdata->whereDate('updated_view_record.onboardnig_date', '<=', $request->ob_end);
        }
        if (isset($request->sift_start)) {
            $Userdata->whereDate('updated_view_record.date_shifted', '>=', $request->sift_start);
        }
        if (isset($request->sift_end)) {
            $Userdata->whereDate('updated_view_record.date_shifted', '<=', $request->sift_end);
        }
        if (isset($request->endo_start)) {
            $Userdata->whereDate('updated_view_record.endi_date', '>=', $request->endo_start);
        }
        if (isset($request->endo_end)) {
            $Userdata->whereDate('updated_view_record.endi_date', '<=', $request->endo_end);
        }
        $record = $Userdata->get();
        $totalCount =  count($record); 
        $arrayOfIDS = $Userdata->select('cid', 'endorsement_id')->get();
        // return $arrayOfIDS;
        // $this->candidate_arr = $Userdata->select('candidate_id', 'endorsement_id')->get()->toArray();
        foreach ($arrayOfIDS as $key => $value) {
            $this->candidate_arr[$value->endorsement_id] = $value->cid;
        }
        //    return $this->candidate_arr;
        return Datatables::of($record)
            ->addIndexColumn()
            ->addColumn('id', function ($record) {
                return $record->cid . '-' . $record->numberOfEndo . '-' . $record->saved_by;
            })
            ->addColumn('recruiter', function ($record) {
                // $recr = (User::where('id', $record->saved_by)->first())->name;
                // return $recr;
                return $record->recruiter_name;

            })
            ->addColumn('team', function ($record) {
                // $userid = User::where('id', $record->saved_by)->get();
                // $team = $userid[0]->roles->pluck('name');
                // return json_decode($team);
                return $record->team_name;

            })
            ->addColumn('Candidate', function ($record) {
                return $record->first_name . ' ' . $record->middle_name . ' ' . $record->last_name;

            })
            ->addColumn('Email', function ($Alldata) {
                return $Alldata->email;

            })
            ->addColumn('Replacement_For', function ($Alldata) {
                return $Alldata->replacement_for;
            })
            ->addColumn('OR_Number', function ($Alldata) {
                return $Alldata->or_number;

            })
            ->addColumn('appStatus', function ($record) {
                return $record->app_status;
            })
            ->addColumn('profile', function ($record) {
                return $record->candidate_profile;
            })
            ->addColumn('career_level', function ($record) {
                return $record->career_endo;
            })
            ->addColumn('certification', function ($record) {
                return $record->certification;
            })
            ->addColumn('client', function ($record) {
                return $record->client;
            })
            ->addColumn('phone', function ($record) {
                return $record->phone;
            })
            ->addColumn('course', function ($record) {
                return $record->course;
            })
            ->addColumn('endi_date', function ($record) {
                if (!empty($record->endi_date && $record->endi_date != '0000-00-00')) {
                    $endi_date = date_format(date_create($record->endi_date), "m-d-Y");
                    return $endi_date;
                } else {
                    $record->endi_date = '';
                }
            })
            ->addColumn('date_invited', function ($record) {
                return $record->date_invited;
            })
            ->addColumn('date_shifted', function ($record) {
                return $record->date_shifted;
            })
            ->addColumn('educational_attain', function ($record) {
                return $record->educational_attain;
            })
            ->addColumn('emp_history', function ($record) {
                return $record->emp_history;
            })
            ->addColumn('type', function ($record) {
                return $record->type;
            })
            ->addColumn('exp_salary', function ($record) {
                return $record->exp_salary;
            })
            ->addColumn('gender', function ($record) {
                return $record->gender;
            })
            ->addColumn('interview_note', function ($record) {
                return $record->interview_note;
            })
            ->addColumn('invoice_number', function ($record) {
                return $record->invoice_number;
            })
            ->addColumn('onboardnig_date', function ($record) {
                return $record->onboardnig_date;
            })
            ->addColumn('position_title', function ($record) {
                return $record->position_title;
            })
            ->addColumn('remarks', function ($record) {
                return $record->remarks;
            })
            ->addColumn('remarks_for_finance', function ($record) {
                return $record->remarks_for_finance;
            })
            ->addColumn('address', function ($record) {
                return $record->address;
            })
            ->addColumn('segment', function ($record) {
                return $record->segment;
            })
            ->addColumn('site', function ($record) {
                return $record->site;
            })
            ->addColumn('endostatus', function ($record) {
                return $record->endostatus;
            })
            ->addColumn('sub_segment', function ($record) {
                return $record->sub_segment;
            })
            ->setTotalRecords($totalCount)
            ->with([
                'array' => $this->candidate_arr,
                'search' => $request->search,
            ])
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
                'remarks',
                'remarks_for_finance',
                'address',
                'segment',
                'site',
                'endostatus',
                'sub_segment',
            ])
            ->make(true);
    }
    // close

    // append summary on page load or filter change
    public function summaryAppend(Request $request)
    {
        ini_set('memory_limit', '1000M'); //1000M  = 1 GB

        // \Cache::forget('smartSearch');
        if ($request->array == 1) {
            // if (\Cache::get('smartSearch') != null) {
            //     $data = \Cache::get('smartSearch');
            //     return view('smartSearch.summary', $data);
            // }
            $Userdata = DB::table('candidate_positions')->join('endorsements', 'candidate_positions.candidate_id', 'endorsements.candidate_id')
                ->join('finance', 'endorsements.id', 'finance.endorsement_id')
                ->select(
                    'finance.placement_fee',
                    'endorsements.app_status',
                    'endorsements.remarks_for_finance'
                );
            $Userdata1 = DB::table('candidate_positions')->join('endorsements', 'candidate_positions.candidate_id', 'endorsements.candidate_id')
                ->join('finance', 'endorsements.id', 'finance.endorsement_id')
                ->select(
                    DB::raw("SUM(finance.srp) as t_srp"),
                    'finance.srp',
                    DB::raw("SUM(finance.placement_fee) as t_placement_fee"),
                    DB::raw("SUM(candidate_positions.curr_salary) as t_salary"),
                    'finance.placement_fee',
                    'endorsements.app_status',
                    'endorsements.remarks_for_finance'
                );
        } else if (isset($request->array)) {

            $Userdata = DB::table('candidate_positions')->join('endorsements', 'candidate_positions.candidate_id', 'endorsements.candidate_id')
                ->join('finance', 'endorsements.id', 'finance.endorsement_id')

                ->select(
                    'finance.placement_fee',
                    'endorsements.app_status',
                    'endorsements.remarks_for_finance'
                )
                ->whereIn('endorsements.id', array_keys($request->array))
                ->whereIn('endorsements.candidate_id', array_values($request->array));
            $Userdata1 = DB::table('candidate_positions')->join('endorsements', 'candidate_positions.candidate_id', 'endorsements.candidate_id')
                ->join('finance', 'endorsements.id', 'finance.endorsement_id')
                ->select(
                    DB::raw("SUM(finance.srp) as t_srp"),
                    'finance.srp',
                    DB::raw("SUM(finance.placement_fee) as t_placement_fee"),
                    DB::raw("SUM(candidate_positions.curr_salary) as t_salary"),
                    'finance.placement_fee',
                    'endorsements.app_status',
                    'endorsements.remarks_for_finance'
                )
                ->whereIn('endorsements.id', array_keys($request->array))
                ->whereIn('endorsements.candidate_id', array_values($request->array));
        } else {
            $data = [
                'endo' => 0,
                'active' => 0,
                'onBoarded' => 0,
                'failed' => 0,
                'accepted' => 0,
                'rejected' => 0,
                'final' => 0,
                'mid' => 0,
                'initial' => 0,
                'withdrawn' => 0,
                'fallout' => 0,
                'revenue' => 0,
                'spr' => 0,
                'activeSPR' => 0,
                'salary' => 0,
                'total' => 0,
            ];
            return view('smartSearch.summary', $data);
        }

        $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql());
        // $total = count($Userdata->where('endorsements.is_deleted', '0')->get());
        $sql1 = Str::replaceArray('?', $Userdata1->getBindings(), $Userdata1->toSql());
        if (strpos($sql, 'where') !== false) {
            $sql_salary = DB::select($sql1 . "and endorsements.is_deleted='0'");
            $sql_enors = $sql . "and endorsements.app_status='To Be Endorsed' and endorsements.is_deleted='0'  ";
            $sql_active = $sql . "and endorsements.app_status='Active File' and endorsements.is_deleted='0' ";
            $sql_onboarded = $sql . "and endorsements.remarks_for_finance='Onboarded' and endorsements.is_deleted='0' ";
            $sql_failed = $sql . "and endorsements.remarks_for_finance LIKE '%fail%' and endorsements.is_deleted='0'  ";
            $sql_accepted = $sql . "and endorsements.remarks_for_finance LIKE '%accept%' and endorsements.is_deleted='0'  ";
            $sql_withdrawn = $sql . "and endorsements.remarks_for_finance LIKE '%withdraw%' and endorsements.is_deleted='0' ";
            $sql_reject = $sql . "and endorsements.remarks_for_finance LIKE '%reject%' and endorsements.is_deleted='0'  ";
            $sql_final = $sql . "and endorsements.category LIKE '%final%' and endorsements.is_deleted='0'  ";
            $sql_mid = $sql . "and endorsements.category LIKE '%mid%' and endorsements.is_deleted='0'  ";
            $sql_initial = $sql . "and endorsements.category LIKE '%initial%' and endorsements.is_deleted='0'  ";
            $sql_fallout = $sql . " and endorsements.remarks_for_finance LIKE '%fallout%' OR endorsements.remarks_for_finance LIKE '%replacement%' and endorsements.is_deleted='0'   ";
            $sql_active_spr = $sql1 . " and endorsements.category LIKE '%final%' OR endorsements.category LIKE '%mid%' and endorsements.is_deleted='0'    ";
            $sql_revenue = DB::select($sql1);
            $sql_spr = DB::select($sql1 . "and endorsements.is_deleted='0' ");
            $active_spr = DB::select($sql1);
            $sql_getActive_spr = DB::select($sql_active_spr);
        } else {
            $sql_salary = DB::select($sql1 . "and endorsements.is_deleted='0' group by endorsements.candidate_id ");
            $sql_active = $sql . "where endorsements.app_status='Active File' and endorsements.is_deleted='0' ";
            $sql_enors = $sql . "where endorsements.app_status='To Be Endorsed' and endorsements.is_deleted='0'  ";
            $sql_onboarded = $sql . "where endorsements.remarks_for_finance='Onboarded'and endorsements.is_deleted='0' ";
            $sql_failed = $sql . "where endorsements.remarks_for_finance LIKE '%fail%' and endorsements.is_deleted='0' ";
            $sql_accepted = $sql . "where endorsements.remarks_for_finance LIKE '%accept%'and endorsements.is_deleted='0'  ";
            $sql_withdrawn = $sql . "where endorsements.remarks_for_finance LIKE '%withdraw%' and endorsements.is_deleted='0' ";
            $sql_reject = $sql . "where endorsements.remarks_for_finance LIKE '%reject%'and endorsements.is_deleted='0'  ";
            $sql_final = $sql . "where endorsements.category LIKE '%final%' and endorsements.is_deleted='0' ";
            $sql_mid = $sql . "where endorsements.category LIKE '%mid%' and endorsements.is_deleted='0' ";
            $sql_initial = $sql . "where endorsements.category LIKE '%initial%'and endorsements.is_deleted='0'  ";
            $sql_fallout = $sql . " where endorsements.remarks_for_finance LIKE '%fallout%' OR endorsements.remarks_for_finance LIKE '%replacement%' and endorsements.is_deleted='0'  ";
            $sql_active_spr = $sql1 . " where endorsements.category LIKE '%final%' OR endorsements.category LIKE '%mid%' and endorsements.is_deleted='0'   ";
            $sql_revenue = DB::select($sql1 . "and endorsements.is_deleted='0' ");
            $sql_spr = DB::select($sql1);
            $active_spr = DB::select($sql);
            $sql_getActive_spr = DB::select($sql_active_spr);
        }
        $sql_spr_amount = 0;
        $sql_active_spr_amount = 0;
        $sql_revenue_amount = 0;
        $total_salary = 0;
        foreach ($sql_spr as $spr) {
            $sql_spr_amount = ($sql_spr_amount + $spr->t_srp);
        }
        foreach ($sql_getActive_spr as $active) {
            $sql_active_spr_amount = ($sql_active_spr_amount + $active->t_srp);
        }
        foreach ($sql_revenue as $revenue) {
            $sql_revenue_amount = ($sql_revenue_amount + $revenue->t_placement_fee);
        }
        foreach ($sql_salary as $salary) {
            $total_salary = ($total_salary + $salary->t_salary);
        }
        $data = [
            'endo' => count(DB::select($sql_enors)),
            'active' => count(DB::select($sql_active)),
            'onBoarded' => count(DB::select($sql_onboarded)),
            'failed' => count(DB::select($sql_failed)),
            'accepted' => count(DB::select($sql_accepted)),
            'rejected' => count(DB::select($sql_reject)),
            'final' => count(DB::select($sql_final)),
            'mid' => count(DB::select($sql_mid)),
            'initial' => count(DB::select($sql_initial)),
            'withdrawn' => count(DB::select($sql_withdrawn)),
            'fallout' => count(DB::select($sql_fallout)),
            'revenue' => $sql_revenue_amount,
            'spr' => $sql_spr_amount,
            'activeSPR' => $sql_active_spr_amount,
            'salary' => $total_salary,
            'total' => 0,
        ];
        if ($request->array == 1) {
            \Cache::put('smartSearch', $data);
        }
        return view('smartSearch.summary', $data);
    }
    //close
    public function searchsummary(Request $request)
    {
    }
}
