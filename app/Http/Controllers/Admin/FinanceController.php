<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Finance;
use App\Finance_detail;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;
use Yajra\DataTables\DataTables;

class FinanceController extends Controller
{
    // private array for controller to summary append on filter change
    private $candidate_arr = [];
    public function __construct()
    {
        $this->middleware('permission:view-finance', ['only' => ['index']]);
        $this->middleware('permission:edit-finance-record', ['only' => ['SavefinanceReference']]);
    }
    // index view of finance page starts
    public function index(Request $request)
    {
       
        return view('finance.finance');
    }
    // close

    // function for detail of team start
    public function recordDetail(Request $request)
    {
        $detail = DB::table('finance')->join('endorsements', 'endorsements.candidate_id', 'finance.candidate_id')
            ->join('finance_detail', 'finance_detail.candidate_id', 'finance.candidate_id')
            ->select('endorsements.*', 'finance.*', 'finance_detail.*')
            ->where('finance.candidate_id', $request->id)
            ->first();

        // dd($detail);
        $fee = $detail->placement_fee;
        $remarks = $detail->remarks_for_finance;
        $remarks_finance = $remarks;
        $savedBy = \App\CandidateInformation::where('id', $detail->candidate_id)->first();
        $user = \App\User::where('id', $savedBy->saved_by)->first();
        $role = $user->roles->pluck('name');
        $team = $role;
        $data = [
            'detail' => $detail,
            'team' => $team,
            'fee' => $fee,
            'remarks_finance' => $remarks_finance,
        ];
        return view('finance.detail', $data);
    }
    // close

    // function for filter view starts
    public function filterView()
    {
        return view('finance.filter_data');
    }
    // close

    // function for filtering record starts
    public function recordFilter(Request $request)
    {

        $arr = ['Fallout', 'Offer accepted', 'Onboarded'];
        $Userdata = DB::table('finance_view')
            ->join('finance_detail', 'finance_detail.candidate_id', 'finance_view.cid')
            ->select('finance_view.*', 'finance_detail.process_status');
        //    check null values coming form selected options
        if (isset($request->recruiter)) {
            $Userdata->whereIn('finance_view.saved_by', $request->recruiter);
        }
        if (isset($request->client)) {
            $Userdata->whereIn('finance_view.client', $request->client);
        }
        if (isset($request->candidate)) {
            $Userdata->whereIn('finance_view.cid', $request->candidate);
        }
        if (isset($request->remarks)) {
            $Userdata->whereIn('finance_view.remarks_for_finance', $request->remarks);
        }
        if (isset($request->ob_date)) {
            $Userdata->whereDate('finance_view.onboardnig_date', '>', $request->ob_date);
        }
        if (isset($request->toDate)) {
            $Userdata->whereDate('finance_view.onboardnig_date', '<', $request->toDate);
        }

        if (isset($request->process)) {
            $Userdata->whereIn('finance_view.reprocess', $request->process);
        }
        if (isset($request->appstatus)) {
            $Userdata->whereIn('finance_detail.process_status', $request->appstatus);
        }
        $user = $Userdata->get();

        $this->candidate_arr = $Userdata->pluck('cid')->toArray();

        return Datatables::of($user)
            ->addIndexColumn()
            ->addColumn('id', function ($user) {
                return $user->cid;
            })
            ->addColumn('team', function ($user) {
                $userid=User::where('id',$user->saved_by)->get();
                $team = $userid[0]->roles->pluck('name');
                return json_decode($team);
            })
            ->addColumn('recruiter', function ($user) {
                return $user->recruiter;
            })
            ->addColumn('client', function ($user) {
                return $user->client;
            })
            ->addColumn('reprocess', function ($user) {
                return $user->reprocess;
            })
            ->addColumn('last_name', function ($user) {
                return $user->last_name;
            })
            ->addColumn('career_endo', function ($user) {
                return $user->career_endo;
            })
            ->addColumn('onboardnig_date', function ($user) {
                if (!empty($user->onboardnig_date && $user->onboardnig_date != '0000-00-00')) {
                    $onboardnig_date = date_format(date_create($user->onboardnig_date), "m-d-Y");
                    return $onboardnig_date;
                } else {
                    $user->onboardnig_date = '';
                }
            })
            ->addColumn('placement_fee', function ($user) {
                return $user->placement_fee;
            })
            ->addColumn('remarks_for_finance', function ($user) {
                return $user->remarks_for_finance;
            })
            ->addColumn('process_status', function ($user) {

                return $user->process_status;
            })
            ->rawColumns([
                'id', 'team', 'recruiter', 'client', 'reprocess', 'last_name',
                'career_endo', 'onboardnig_date', 'placement_fee', 'remarks_for_finance', 'app_status',
            ])
            ->with([
                'array' => $this->candidate_arr,
            ])
            ->make(true);
    }
    //close

    // save the update data of candidate
    public function SavefinanceReference(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $userRole = $user->roles->pluck('id')->all();
        $t_id = $userRole;

        $data = [
            "ob_date" => $request->onboardnig_date,
            "term_date" => $request->term_date,
            "code" => $request->code,
            "payment_term" => $request->payment_term,
            "offered_salary" => $request->offered_salary,
            "replacement_for" => $request->replacement_for,
            "date_delvrd" => $request->date_delvrd,
            "process_status" => $request->process_status,
            "allowance" => $request->allowance,
            "vat_per" => $request->vat_per,
            "credit_memo" => $request->credit_memo,
            "invoice_number" => $request->invoice_number,
            "invoice_date" => $request->invoice_date,
            "compensation" => $request->compensation,
            "rate_per" => $request->rate_per,
            "placementFee" => $request->placement_fee,
            "or_number" => $request->or_number,
            "date_collected" => $request->date_collected,
            "reprocess_share" => $request->reprocess_share,
            "reprocess_share_per" => $request->reprocess_share_per,
            "vcc_share_per" => $request->vcc_share_per,
            // "VSA" => $request->VSA,
            "finalFee" => $request->finalFee,
            "owner_share_per" => $request->owner_share_per,
            "owner_share" => $request->owner_share,
            "c_take_per" => $request->c_take_per,
            "c_take" => $request->c_take,
            "adjustment" => $request->adjustment,
            "ind_revenue" => $request->ind_revenue,
            "t_id" => $t_id,
        ];
        Finance_detail::where("candidate_id", $request->candidate_id)->update($data);
        Helper::save_log('Finance_Reference_updated');
        return $request->candidate_id;
    }
    // close

    // yajra data table of finance data
    public function view_finance_search_table()
    {
        // user, information ,endo , finance
        $arr = ['Fallout', 'Offer accepted', 'Onboarded'];
        $Userdata = DB::table('finance_view')
            ->join('endorsements', 'endorsements.id', 'finance_view.cid')
            ->join('finance_detail', 'finance_detail.candidate_id', 'finance_view.cid')
            ->select('finance_view.*', 'endorsements.remarks', 'finance_detail.process_status')
            ->get();

        return Datatables::of($Userdata)
            ->addIndexColumn()
            ->addColumn('id', function ($Userdata) {
                return $Userdata->cid;
            })
            ->addColumn('team', function ($Userdata) {
                $userid=User::where('id',$Userdata->saved_by)->get();
                $team = $userid[0]->roles->pluck('name');
                return json_decode($team);
            })

            ->addColumn('recruiter', function ($Userdata) {
                return $Userdata->recruiter;
            })
            ->addColumn('client', function ($Userdata) {
                return $Userdata->client;
            })
            ->addColumn('reprocess', function ($Userdata) {
                return $Userdata->reprocess;
            })
            ->addColumn('last_name', function ($Userdata) {
                return $Userdata->last_name;
            })
            ->addColumn('career_endo', function ($Userdata) {
                return $Userdata->career_endo;
            })
            ->addColumn('onboardnig_date', function ($Userdata) {
                if (!empty($Userdata->onboardnig_date && $Userdata->onboardnig_date != '0000-00-00')) {
                    $onboardnig_date = date_format(date_create($Userdata->onboardnig_date), "m-d-Y");
                    return $onboardnig_date;
                } else {
                    $Userdata->onboardnig_date = '';
                }
            })
            ->addColumn('placement_fee', function ($Userdata) {
                return $Userdata->placement_fee;
            })
            ->addColumn('remarks_for_finance', function ($Userdata) {
                return $Userdata->remarks_for_finance;
            })
            ->addColumn('process_status', function ($Userdata) {
                return $Userdata->process_status;
            })

            ->rawColumns([
                'id', 'team', 'recruiter', 'client', 'reprocess', 'last_name',
                'career_endo', 'onboardnig_date', 'placement_fee', 'remarks_for_finance', 'endostatus',
            ])
            ->make(true);
    }
    // close

    // append the summary of filtered record
    public function summaryAppend(Request $request)
    {
        //for check team revenue
        // $recruiter = Auth::user()->roles()->pluck('name');
        $revenueArray = [];
        $revenue = DB::table('roles')->where('team_revenue', 1)->get('id');
        // dd($revenue);
        foreach ($revenue as $key => $value) {
            $revenueArray[$key] = $value->id;
        }
        $teamRevenueAmount = DB::table('finance_detail')->select(DB::raw('Sum(vcc_amount) as totoalRevenue'))->whereIn('t_id', $revenueArray)->get();
        //for check team revenue close
        $arr = ['Onboarded', 'Offer Accepted', 'Fallout'];
        if ($request->array == 1) {
            $Userdata = Finance::join('endorsements', 'endorsements.candidate_id', 'finance.candidate_id')
                ->join('finance_detail', 'finance_detail.candidate_id', 'finance.candidate_id')
                ->whereIn('endorsements.remarks_for_finance', $arr)
                ->select('endorsements.*', 'finance.*', 'finance_detail.*');
        } elseif (isset($request->array)) {
            // dd($request->array);
            $Userdata = Finance::join('endorsements', 'endorsements.candidate_id', 'finance.candidate_id')
                ->join('finance_detail', 'finance_detail.candidate_id', 'finance.candidate_id')
                ->whereIn('endorsements.remarks_for_finance', $arr)
                ->whereIn('endorsements.candidate_id', $request->array)
                ->select('endorsements.*', 'finance.*', 'finance_detail.*');
        } else {
            $data = [
                'hires' => 0,
                'fallout' => 0,
                'billed' => 0,
                'unbilled' => 0,
                'billedAmount' => 0,
                'unbilledAmount' => 0,
                'falloutAmount' => 0,
                'receivablesAmount' => 0,
                'Current_receivablesAmount' => 0,
                'overDue_receivablesAmount' => 0,
                'ctakeAmount' => 0,
                'sql_c_share' => 0,
                'vcc_amount_sum' => 0,
                'teamRevenueAmount' => 0,
            ];

            return view('finance.summary', $data);
        }

        $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql());
        //start modify  wherein()
        foreach ($arr as $remarks) {
            $sql = str_replace($remarks, "'$remarks'", $sql);
        }

        // end modify  wherein()
        if (strpos($sql, 'where') !== false) {

            $sql_fallout = $sql . "  and endorsements.remarks LIKE '%fallout%' OR endorsements.remarks LIKE '%replacement%'   ";
            $sql_billed = $sql . " and  endorsements.remarks in('fallout','Billed','replacement')";
            $sql_unBilled = $sql . " and endorsements.remarks ='Unbilled' ";
            $sql_billed_amount = DB::select($sql_billed);
            $sql_unbilled_amount = DB::select($sql_unBilled);
            $sql_fallout_amount = DB::select($sql_fallout);
            // $Revenue_In_Incentive="";
            $sql_receivables = $sql . " and finance_detail.process_status in('OVERDUE','FFUP','RCVD') ";
            $sql_Current_receivables = $sql . " and finance_detail.process_status in('FFUP','RCVD')  ";
            $sql_overDue_receivables = $sql . " and finance_detail.process_status ='OVERDUE' ";
            $c_share = $sql . "  and endorsements.remarks LIKE '%collect%' OR endorsements.remarks LIKE '%replace%'OR endorsements.remarks LIKE 'billed%'   ";

            $vcc_amount_sum = $sql . " and endorsements.remarks LIKE '%collect%' OR endorsements.remarks LIKE '%replace%'OR endorsements.remarks LIKE 'billed%'   ";
            // $vcc_amount_sum_for_I_B_R=$sql." and endorsements.remarks LIKE '%collect%' OR "
            // $sql_onboarded = $sql . " and endorsements.remarks_for_finance='Onboarded'";
        };

        $sql_receivables_amount = DB::select($sql_receivables);
        $sql_Current_receivables_amount = DB::select($sql_Current_receivables);
        $sql_overDue_receivables_amount = DB::select($sql_overDue_receivables);
        $sql_ctake_amount = DB::select($sql_billed);
        $sql_c_share_db = DB::select($c_share);
        $sql_vcc_amount_sum = DB::select($vcc_amount_sum);
        $billedAmount = 0;
        $unbilledAmount = 0;
        $falloutAmount = 0;
        $receivablesAmount = 0;
        $Current_receivablesAmount = 0;
        $overDue_receivablesAmount = 0;
        $ctakeAmount = 0;
        $sql_c_share = 0;
        $vcc_amount_sum = 0;
        foreach ($sql_billed_amount as $total) {
            $billedAmount = $billedAmount + $total->Total_bilable_ammount;
        }
        foreach ($sql_unbilled_amount as $unbill) {
            $unbilledAmount = $unbilledAmount + $unbill->Total_bilable_ammount;
        }

        foreach ($sql_fallout_amount as $fallout) {
            $falloutAmount = $falloutAmount + $fallout->Total_bilable_ammount;
        }
        foreach ($sql_receivables_amount as $receivable) {
            $receivablesAmount = $receivablesAmount + $receivable->totalFee;
        }
        foreach ($sql_Current_receivables_amount as $Curr_receivable) {
            $Current_receivablesAmount = $Current_receivablesAmount + $Curr_receivable->totalFee;
        }
        foreach ($sql_overDue_receivables_amount as $over_receivable) {
            $overDue_receivablesAmount = $overDue_receivablesAmount + $over_receivable->totalFee;
        }
        foreach ($sql_ctake_amount as $ctake) {
            //unknown vlaue for some
            $ctakeAmount = $ctakeAmount + $ctake->c_take;
        }
        foreach ($sql_c_share_db as $cftake) {
            //unknown vlaue for some
            $sql_c_share = $sql_c_share + $cftake->c_take;
        }
        foreach ($sql_vcc_amount_sum as $cftake) {
            //unknown vlaue for some
            $vcc_amount_sum = $vcc_amount_sum + $cftake->c_take;
        }
        //find incentive_base_revenue formula consultant share +Bod Share +vcc share of agent TAT EHT
        // if ($Revenue[0]->team_revenue) {

        //     $incentive_base_revenue = $sql_c_share + $vcc_amount_sum + 5;
        // } else {
        //     $incentive_base_revenue = $sql_c_share + $vcc_amount_sum + 1;
        // }

        $teamRevenueAmountFinance = 0;
        foreach ($teamRevenueAmount as $value) {
            # code...
            $teamRevenueAmountFinance += $value->totoalRevenue;
        }

        $traf = $teamRevenueAmountFinance + $vcc_amount_sum + $sql_c_share;
        $data = [
            'hires' => count($Userdata->get()),
            'fallout' => count(DB::Select($sql_fallout)),
            'billed' => count(DB::select($sql_billed)),
            'unbilled' => count(DB::select($sql_unBilled)),
            'billedAmount' => $billedAmount,
            'unbilledAmount' => $unbilledAmount,
            'falloutAmount' => $falloutAmount,
            'receivablesAmount' => $receivablesAmount,
            'Current_receivablesAmount' => $Current_receivablesAmount,
            'overDue_receivablesAmount' => $overDue_receivablesAmount,
            'ctakeAmount' => $ctakeAmount,
            'sql_c_share' => $sql_c_share,
            'vcc_amount_sum' => $vcc_amount_sum,
            'teamRevenueAmount' => $traf,

        ];

        return view('finance.summary', $data);
    }
    // close

    // append finace filter options on page laod
    public function appendFinanceOptions()
    {
        $arr = ['Offer accepted', 'Onboarded'];
        $candidates = CandidateInformation::join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->whereIn('remarks_for_finance', $arr)
            ->select('candidate_informations.id as cid', 'candidate_informations.reprocess', 'candidate_informations.last_name')->get();
        $recruiter = User::where("type", 3)->get();
        $teams = DB::select("select * from roles");
        $appstatus = DB::select("select app_status from endorsements group by app_status");
        $remarks_finance = DB::select("select remarks_for_finance from endorsements where remarks_for_finance !='' group by remarks_for_finance");
        $client = DB::select('select distinct client from endorsements where client!="" order by client ASC;');

        return response()->json([
            'candidates' => $candidates,
            'recruiter' => $recruiter,
            "teams" => $teams,
            "appstatus" => $appstatus,
            'remarks_finance' => $remarks_finance,
            'client' => $client,
        ]);
    }
    // close
    public function FinanceSearchForSummary(Request $request)
    {
        $check = $searchCheck = false;
        if ($request->searchKeyword == null) {
            $request->searchKeyword = 1;
            return $this->summaryAppend($request->searchKeyword);
        }
        // dd($request->all());
        $arr = ['"Onboarded"', '"Offer Accepted"', '"Fallout"'];
        $Userdata = DB::table('six_table_view')
            ->whereIn('six_table_view.remarks_for_finance', $arr)
            ->select('six_table_view.*');
        //start search
        if (isset($request->searchKeyword)) {

            $perfect_match = DB::table("six_table_view")->get();

            foreach ($perfect_match as $match) {
                if (strpos(strtolower($match->domain), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.domain', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.last_name', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->saved_by), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.saved_by', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->client), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.client', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->remarks_for_finance), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.remarks_for_finance', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->address), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.address', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->career_endo), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.career_endo', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->remarks), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.remarks', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->onboardnig_date), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.onboardnig_date', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->date_shifted), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.date_shifted', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->endi_date), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.endi_date', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->gender), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.gender', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->candidate_profile), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.candidate_profile', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->educational_attain), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.educational_attain', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->status), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.endostatus', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->first_name), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.first_name', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.last_name', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->curr_salary), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.curr_salary', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->placement_fee), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.placement_fee', 'like', '"%' . $request->searchKeyword . '%"');
                }
                if (strpos(strtolower($match->srp), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.srp', 'like', '"%' . $request->searchKeyword . '%"');
                }
            }
        }
        if ($check) {
            $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql());
        } else {
            if (!$check && !$searchCheck) {
                $data = [
                    'hires' => 0,
                    'fallout' => 0,
                    'billed' => 0,
                    'unbilled' => 0,
                    'billedAmount' => 0,
                    'unbilledAmount' => 0,
                    'falloutAmount' => 0,
                    'receivablesAmount' => 0,
                    'Current_receivablesAmount' => 0,
                    'overDue_receivablesAmount' => 0,
                    'ctakeAmount' => 0,
                    'sql_c_share' => 0,
                    'vcc_amount_sum' => 0,

                ];

                return view('finance.summary', $data);
            }
        }

        if (strpos($sql, 'where') !== false) {
            $sql_fallout = $sql . "  and six_table_view.remarks LIKE '%fallout%' OR six_table_view.remarks LIKE '%replacement%'   ";
            $sql_billed = $sql . " and  six_table_view.remarks in('fallout','Billed','replacement')   ";
            $sql_unBilled = $sql . " and six_table_view.remarks ='Unbilled' ";
            $sql_billed_amount = DB::select($sql_billed);
            $sql_unbilled_amount = DB::select($sql_unBilled);
            $sql_fallout_amount = DB::select($sql_fallout);
            $sql_receivables = $sql . " and six_table_view.process_status in('OVERDUE','FFUP','RCVD') ";
            $sql_Current_receivables = $sql . " and six_table_view.process_status in('FFUP','RCVD')  ";
            $sql_overDue_receivables = $sql . " and six_table_view.process_status ='OVERDUE' ";
            $c_share = $sql . "  and six_table_view.remarks LIKE '%collect%' OR six_table_view.remarks LIKE '%replace%'OR six_table_view.remarks LIKE 'billed%'  ";
            $vcc_amount_sum = $sql . " and six_table_view.remarks LIKE '%collect%' OR six_table_view.remarks LIKE '%replace%'OR six_table_view.remarks LIKE 'billed%'  ";
        };

        $sql_receivables_amount = DB::select($sql_receivables);
        $sql_Current_receivables_amount = DB::select($sql_Current_receivables);
        $sql_overDue_receivables_amount = DB::select($sql_overDue_receivables);
        $sql_ctake_amount = DB::select($sql_billed);
        $sql_c_share_db = DB::select($c_share);
        $sql_vcc_amount_sum = DB::select($vcc_amount_sum);
        $billedAmount = 0;
        $unbilledAmount = 0;
        $falloutAmount = 0;
        $receivablesAmount = 0;
        $Current_receivablesAmount = 0;
        $overDue_receivablesAmount = 0;
        $ctakeAmount = 0;
        $sql_c_share = 0;
        $vcc_amount_sum = 0;
        foreach ($sql_billed_amount as $total) {
            $billedAmount = $billedAmount + $total->Total_bilable_ammount;
        }
        foreach ($sql_unbilled_amount as $unbill) {
            $unbilledAmount = $unbilledAmount + $unbill->Total_bilable_ammount;
        }

        foreach ($sql_fallout_amount as $fallout) {
            $falloutAmount = $falloutAmount + $fallout->Total_bilable_ammount;
        }
        foreach ($sql_receivables_amount as $receivable) {
            $receivablesAmount = $receivablesAmount+isset($receivable->totalFee) ? $receivable->totalFee : 0;
        }
        foreach ($sql_Current_receivables_amount as $Curr_receivable) {
            $Current_receivablesAmount = $Current_receivablesAmount+isset($Curr_receivable->totalFee) ? $Curr_receivable->totalFee : 0;
        }
        foreach ($sql_overDue_receivables_amount as $over_receivable) {
            $overDue_receivablesAmount = $overDue_receivablesAmount+isset($over_receivable->totalFee) ? $over_receivable->totalFee : 0;
        }
        foreach ($sql_ctake_amount as $ctake) {
            //unknown vlaue for some
            $ctakeAmount = $ctakeAmount + $ctake->c_take;
        }
        foreach ($sql_c_share_db as $cftake) {
            //unknown vlaue for some
            $sql_c_share = $sql_c_share + $cftake->c_take;
        }
        foreach ($sql_vcc_amount_sum as $cftake) {
            //unknown vlaue for some
            $vcc_amount_sum = $vcc_amount_sum + $cftake->c_take;
        }
        $data = [
            'hires' => count(DB::select($sql)),
            'fallout' => count(DB::Select($sql_fallout)),
            'billed' => count(DB::select($sql_billed)),
            'unbilled' => count(DB::select($sql_unBilled)),
            'billedAmount' => $billedAmount,
            'unbilledAmount' => $unbilledAmount,
            'falloutAmount' => $falloutAmount,
            'receivablesAmount' => $receivablesAmount,
            'Current_receivablesAmount' => $Current_receivablesAmount,
            'overDue_receivablesAmount' => $overDue_receivablesAmount,
            'ctakeAmount' => $ctakeAmount,
            'sql_c_share' => $sql_c_share,
            'vcc_amount_sum' => $vcc_amount_sum,

        ];

        return view('finance.summary', $data);
    }
}
