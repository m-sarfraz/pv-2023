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

        // close
        return response()->json(
            [
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
        ini_set('max_execution_time', 30000); //30000 seconds = 500 minutes
        $allData = DB::select('select * from smart_view limit 100');
        return Datatables::of($allData)
        // ->addIndexColumn()
            ->addColumn('array', function ($allData) {

                return $allData->candidate_id . '-' . $allData->endorsement_id;
                // return $allData->recruiter;
            })
            ->addColumn('recruiter', function ($allData) {
                $name = User::where('id', $allData->saved_by)->first();
                return isset($name->name) ? $name->name : '';
                // return $allData->recruiter;
            })
            ->addColumn('candidate', function ($allData) {
                // $name = DB::select('select last_name from  candidate_informations where id=' . $allData->id);
                return $allData->last_name;
            })
            ->addColumn('client', function ($allData) {
                return $allData->client;
            })
            ->addColumn('position_title', function ($allData) {
                return $allData->position_title;
            })
            ->addColumn('email', function ($allData) {
                return $allData->email;
            })
            ->addColumn('phone', function ($allData) {
                return $allData->phone;
            })
            ->addColumn('gender', function ($allData) {
                return $allData->gender;
            })
            ->addColumn('domain', function ($allData) {
                return $allData->domain;
            })
            ->addColumn('candidate_profile', function ($allData) {

                return $allData->candidate_profile;
            })
            ->addColumn('educational_attain', function ($allData) {
                return $allData->educational_attain;
            })
            ->addColumn('curr_salary', function ($allData) {
                return $allData->curr_salary;
            })
            ->addColumn('portal', function ($allData) {
                return $allData->source;
            })
            ->addColumn('date_shifted', function ($allData) {
                if (!empty($allData->date_shifted && $allData->date_shifted != '0000-00-00')) {
                    $date_shifted = date_format(date_create($allData->date_shifted), "m-d-Y");
                    return $date_shifted;
                } else {
                    $allData->date_shifted = '';
                }
            })

            ->addColumn('career_endo', function ($allData) {
                return $allData->career_endo;
            })
            ->addColumn('app_status', function ($allData) {
                return $allData->status;
            })
            ->addColumn('endi_date', function ($allData) {
                if (!empty($allData->endi_date && $allData->endi_date != '0000-00-00')) {
                    $endi_date = date_format(date_create($allData->endi_date), "m-d-Y");
                    return $endi_date;
                } else {
                    $allData->endi_date = '';
                }
            })
            ->addColumn('remarks_for_finance', function ($allData) {
                return $allData->remarks_for_finance;
            })
            ->addColumn('category', function ($allData) {
                return $allData->category;

            })
            ->addColumn('srp', function ($allData) {
                return $allData->srp;
            })
            ->addColumn('onboardnig_date', function ($allData) {
                if (!empty($allData->onboardnig_date && $allData->onboardnig_date != '0000-00-00')) {
                    $onboardnig_date = date_format(date_create($allData->onboardnig_date), "m-d-Y");
                    return $onboardnig_date;
                } else {
                    $allData->onboardnig_date = '';
                }
            })
            ->addColumn('placement_fee', function ($allData) {
                return $allData->placement_fee;
            })
            ->addColumn('address', function ($allData) {
                return $allData->address;
            })

            ->rawColumns(['recruiter', 'candidate', 'client', 'position_title', 'email', 'phone', 'gender',
                'domain', 'educational_attain', 'curr_salary', 'portal', 'date_shifted', 'career_endo', 'app_status', 'endi_date', 'remarks_for_finance'
                , 'category', 'srp', 'onboardnig_date', 'placement_fee', 'address'])
            ->make(true);

    }
    //close

    // filter record on basis of seelcted dropdowns
    public function filterSearch(Request $request)
    {
        $data = [];
        $check = $searchCheck = false;
        // return $request->all();
        $Userdata = DB::table('smart_view');
        //    check null values coming form selected options
        if (isset($request->domain)) {
            $Userdata->whereIn('smart_view.domain', $request->domain);
        }
        if (isset($request->recruiter)) {
            $Userdata->whereIn('smart_view.saved_by', $request->recruiter);
        }
        if (isset($request->status)) {
            $Userdata->whereIn('smart_view.status', array($request->status));
        }
        if (isset($request->client)) {
            // return $request->client;
            $Userdata->whereIn('smart_view.client', $request->client);
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
            $Userdata->whereIn('smart_view.remarks_for_finance', $stageArray);
        }
        if (isset($request->residence)) {
            $Userdata->whereIn('smart_view.address', $request->residence);
        }
        if (isset($request->career_level)) {
            $Userdata->whereIn('smart_view.career_endo', $request->career_level);
        }
        if (isset($request->category)) {
            $Userdata->whereIn('smart_view.category', $request->category);
        }
        if (isset($request->remarks)) {
            $Userdata->whereIn('smart_view.remarks_for_finance', $request->remarks);
        }
        if (isset($request->portal)) {
            $Userdata->whereIn('smart_view.source', $request->portal);
        }
        if (isset($request->ob_start)) {
            $Userdata->whereDate('smart_view.onboardnig_date', '>=', $request->ob_start);
        }
        if (isset($request->ob_end)) {
            $Userdata->whereDate('smart_view.onboardnig_date', '<=', $request->ob_end);
        }
        if (isset($request->sift_start)) {
            $Userdata->whereDate('smart_view.date_shifted', '>=', $request->sift_start);
        }
        if (isset($request->sift_end)) {
            $Userdata->whereDate('smart_view.date_shifted', '<=', $request->sift_end);
        }
        if (isset($request->endo_start)) {
            $Userdata->whereDate('smart_view.endi_date', '>=', $request->endo_start);
        }
        if (isset($request->endo_end)) {
            $Userdata->whereDate('smart_view.endi_date', '<=', $request->endo_end);
        }
        $user = $Userdata->get();
        $arrayOfIDS = $Userdata->select('candidate_id', 'endorsement_id')->get();
        // return $arrayOfIDS;
        // $this->candidate_arr = $Userdata->select('candidate_id', 'endorsement_id')->get()->toArray();
        foreach ($arrayOfIDS as $key => $value) {
            $this->candidate_arr[$value->endorsement_id] = $value->candidate_id;
        }
        //    return $this->candidate_arr;
        return Datatables::of($user)
            ->addColumn('array', function ($allData) {
                return $allData->candidate_id . '-' . $allData->endorsement_id;
            })
            ->addColumn('recruiter', function ($allData) {
                $name = User::where('id', $allData->saved_by)->first();
                return isset($name->name) ? $name->name : '';

            })
            ->addColumn('candidate', function ($allData) {
                return $allData->last_name;
            })
            ->addColumn('client', function ($user) {
                return $user->client;
            })
            ->addColumn('position_title', function ($allData) {
                return $allData->position_title;
            })
            ->addColumn('email', function ($allData) {
                return $allData->email;
            })
            ->addColumn('phone', function ($allData) {
                return $allData->phone;
            })
            ->addColumn('gender', function ($allData) {
                return $allData->gender;
            })
            ->addColumn('domain', function ($allData) {
                return $allData->domain;
            })
            ->addColumn('candidate_profile', function ($allData) {
                return $allData->candidate_profile;
            })
            ->addColumn('educational_attain', function ($allData) {
                return $allData->educational_attain;
            })
            ->addColumn('curr_salary', function ($allData) {
                return $allData->curr_salary;
            })
            ->addColumn('portal', function ($allData) {
                return $allData->source;
            })
            ->addColumn('date_shifted', function ($allData) {
                if (!empty($allData->date_shifted && $allData->date_shifted != '0000-00-00')) {
                    $date_shifted = date_format(date_create($allData->date_shifted), "m-d-Y");
                    return $date_shifted;
                } else {
                    $allData->date_shifted = '';
                }
            })
            ->addColumn('career_endo', function ($allData) {
                return $allData->career_endo;
            })
            ->addColumn('app_status', function ($allData) {
                return $allData->status;
            })
            ->addColumn('endi_date', function ($allData) {
                if (!empty($allData->endi_date && $allData->endi_date != '0000-00-00')) {
                    $endi_date = date_format(date_create($allData->endi_date), "m-d-Y");
                    return $endi_date;
                } else {
                    $allData->endi_date = '';
                }
            })
            ->addColumn('remarks_for_finance', function ($allData) {
                return $allData->remarks_for_finance;
            })
            ->addColumn('category', function ($allData) {
                return $allData->category;

            })
            ->addColumn('srp', function ($allData) {
                return $allData->srp;
            })
            ->addColumn('onboardnig_date', function ($allData) {
                if (!empty($allData->onboardnig_date && $allData->onboardnig_date != '0000-00-00')) {
                    $onboardnig_date = date_format(date_create($allData->onboardnig_date), "m-d-Y");
                    return $onboardnig_date;
                } else {
                    $allData->onboardnig_date = '';
                }
            })
            ->addColumn('placement_fee', function ($allData) {
                return $allData->placement_fee;
            })
            ->addColumn('address', function ($allData) {
                return $allData->address;
            })
            ->addColumn('saved_by', function ($allData) {
                $name = DB::select('select name from  users where id=' . $allData->saved_by);
                return isset($name[0]->name) ? $name[0]->name : '';
            })
            ->with([
                'array' => $this->candidate_arr,
            ])
            ->rawColumns(['id', 'client', 'gender', 'domain', 'candidate_profile', 'educational_attain',
                'curr_salary', 'portal', 'date_shifted', 'career_endo', 'app_status', 'endi_date', 'remarks_for_finance', 'category',
                'srp', 'onboardnig_date', 'placement_fee', 'address'])
            ->make(true);

        // close
    }
    // close

    // append summary on page load or filter change
    public function summaryAppend(Request $request)
    {
        if ($request->array == 1) {
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
            ];
            return view('smartSearch.summary', $data);
        }
        $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql());
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
            $sql_salary = DB::select($sql1 . "and endorsements.is_deleted='0'");
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
            $sql_spr_amount = ceil($sql_spr_amount + $spr->t_srp);
        }
        foreach ($sql_getActive_spr as $active) {
            $sql_active_spr_amount = ceil($sql_active_spr_amount + $active->t_srp);
        }
        foreach ($sql_revenue as $revenue) {
            $sql_revenue_amount = ceil($sql_revenue_amount + $revenue->t_placement_fee);
        }
        foreach ($sql_salary as $salary) {
            $total_salary = ceil($total_salary + $salary->t_salary);
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
        ];
        return view('smartSearch.summary', $data);
    }
    //close
    public function searchsummary(Request $request)
    {
    }
}
