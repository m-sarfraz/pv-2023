<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Endorsement;
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
        $arr = explode('-', $request->id);
        // return $arr[0] . '-'. $arr[1] . '-'. $arr[2] ;
        $detail =
        //  DB::select('select `endorsements`.*, `finance`.*, `finance_detail`.* from `endorsements` inner join `finance`
        // on `finance`.`endorsement_id` = `endorsements`.`id` inner join `finance_detail`
        // on `finance`.`id` = `finance_detail`.`finance_id`
        // WHERE finance.candidate_id =' . $arr[0] . ' and endorsements.numberOfEndo =' . $arr[1] . ' and endorsements.saved_by = ' . $arr[2] . '');
        DB::table('endorsements')
            ->join('finance', 'finance.endorsement_id', 'endorsements.id')
            ->join('finance_detail', 'finance.id', 'finance_detail.finance_id')
            ->select('endorsements.*', 'finance.*', 'finance_detail.*')
            ->where(['finance.candidate_id' => $arr[0],
                'endorsements.numberOfEndo' => $arr[1], 'endorsements.saved_by' => $arr[2], 'endorsements.id' => $arr[4]])
            ->first();
        // $sql = Str::replaceArray('?', $detail->getBindings(), $detail->toSql());

        // dd($detail);
        $fee = $detail->placementFee != null ? $detail->placementFee : 0;
        $remarks_finance = $detail->remarks_for_finance != null ? $detail->remarks_for_finance : '';
        $remarks_recruiter = $detail->remarks != null ? $detail->remarks : '';
        // $remarks = $detail->remarks_for_finance;
        // $remarks_finance = $remarks;
        $salary1 = \App\Finance::where(['candidate_id' => $arr[0], 'endorsement_id' => $arr[4]])->first();
        $salary = Finance_detail::where('finance_id', $salary1->id)->first();
        $off_salary = $salary->offered_salary != null ? $salary->offered_salary : 0;
        $off_allowance = $salary->allowance != null ? $salary->allowance : 0;
        $billAmount = $salary1->Total_bilable_ammount != null ? $salary1->Total_bilable_ammount : 0;
        // $savedBy = \App\CandidateInformation::where('id', $detail->candidate_id)->first();
        $user = \App\User::where('id', $arr[2])->first();
        $role = $user->roles->pluck('name');
        $team = $role;
        $data = [
            'detail' => $detail,
            'team' => $team,
            'fee' => $fee,
            'billAmount' => $billAmount,
            'off_salary' => $off_salary,
            'off_allowance' => $off_allowance,
            'remarks_finance' => $remarks_finance,
            'remarks_recruiter' => $remarks_recruiter,
            'fid' => $arr[3],
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
        $Userdata = DB::table('finance_view');
        //    check null values coming form selected options
        if (isset($request->recruiter)) {
            $Userdata->whereIn('finance_view.origionalRecruiter', $request->recruiter);
        }
        if (isset($request->team_id)) {

            $Userdata->whereIn('finance_view.t_id', $request->team_id);
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
            $Userdata->whereDate('finance_view.onboardnig_date', '>=', $request->ob_date);
        }
        if (isset($request->toDate)) {
            $Userdata->whereDate('finance_view.onboardnig_date', '<=', $request->toDate);
        }

        if (isset($request->process)) {
            if (isset($request->recruiter)) {
                $Userdata->orWhereIn('finance_view.tap', $request->process);
            } else {
                $Userdata->whereIn('finance_view.tap', $request->process);
            }
        }
        if (isset($request->appstatus)) {
            $Userdata->whereIn('finance_view.process_status', $request->appstatus);
        }
        // $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql());
        // return $sql;
        $user = $Userdata->get();

        // $this->candidate_arr = $Userdata->pluck('cid')->toArray();
        $arrayOfIDS = $Userdata->select('cid', 'endorsement_id')->get();
        foreach ($arrayOfIDS as $key => $value) {
            $this->candidate_arr[$value->endorsement_id] = $value->cid;
        }
        // return $this->candidate_arr;
        return Datatables::of($user)
            ->addIndexColumn()
            ->addColumn('array', function ($user) {
                return $user->cid . '-' . $user->endorsement_id;

            })
            ->addColumn('id', function ($user) {
                return $user->cid . '-' . $user->numberOfEndo . '-' . $user->saved_by . '-' . $user->fid . '-' . $user->e_id;

            })
            ->addColumn('team', function ($user) {
                $userid = User::where('id', $user->saved_by)->get();
                $team = $userid[0]->roles->pluck('name');
                return json_decode($team);
            })
            ->addColumn('recruiter', function ($user) {
                $id = Endorsement::where('candidate_id', $user->cid)->where('origionalRecruiter', '!=', '0')->first();
                return (User::where('id', $id->saved_by)->first('name'))->name;
            })
            ->addColumn('tapped', function ($user) {
                $id = $user->origionalRecruiter == '0' ? $user->tap : $user->origionalRecruiter; 
                if ( $user->origionalRecruiter != '0') {
                    return '';
                }
                else{

                    return (User::where('id', $id)->first('name'))->name;
                }
            })
            ->addColumn('client', function ($user) {
            
                return $user->client;
            })
            ->addColumn('reprocess', function ($user) {
                return $user->reprocess;
            })
            ->addColumn('last_name', function ($user) {
                return $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
            })
            ->addColumn('career_endo', function ($user) {
                return $user->career_endo;
            })
            ->addColumn('onboardnig_date', function ($user) {
                if (!empty($user->onboardnig_date && $user->onboardnig_date != '0000-00-00')) {
                    $onboardnig_date = date_format(date_create($user->onboardnig_date), "m-d-Y");
                    return $onboardnig_date;
                } else {
                    return $user->onboardnig_date = '';
                }
            })
            ->addColumn('placement_fee', function ($user) {
                return $user->placementFee;
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

    // yajra data table of finance data
    public function view_finance_search_table()
    {
        // user, information ,endo , finance
        $arr = ['Fallout', 'Offer accepted', 'Onboarded'];
        $Userdata = DB::table('finance_view')->get();
        // dd($Userdata->get());
        return Datatables::of($Userdata)
            ->addIndexColumn()
            ->addColumn('array', function ($user) {
                return ($user->cid . '-' . $user->endorsement_id);
            })
            ->addColumn('id', function ($user) {
                return $user->cid . '-' . $user->numberOfEndo . '-' . $user->saved_by . '-' . $user->fid . '-' . $user->e_id;
            })
            ->addColumn('team', function ($user) {
                $userid = User::where('id', $user->saved_by)->get();
                $team = $userid[0]->roles->pluck('name');
                return json_decode($team);
            })
            ->addColumn('recruiter', function ($user) {
                $id = Endorsement::where('candidate_id', $user->cid)->where('origionalRecruiter', '!=', '0')->first();
                return (User::where('id', $id->saved_by)->first('name'))->name;
            })
            ->addColumn('tapped', function ($user) {
                $id = $user->origionalRecruiter == '0' ? $user->tap : $user->origionalRecruiter; 
                if ( $user->origionalRecruiter != '0') {
                    return '';
                }
                else{

                    return (User::where('id', $id)->first('name'))->name;
                }
                // $id = Endorsement::where('candidate_id' ,$user->cid)->where('origionalRecruiter', '!=', '0')->first();
            })
            ->addColumn('client', function ($user) {
                return $user->client;
            })
            ->addColumn('reprocess', function ($user) {
                return $user->reprocess;
            })
            ->addColumn('last_name', function ($user) {
                return $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
            })
            ->addColumn('career_endo', function ($user) {
                return $user->career_endo;
            })
            ->addColumn('onboardnig_date', function ($user) {
                if (!empty($user->onboardnig_date && $user->onboardnig_date != '0000-00-00')) {
                    $onboardnig_date = date_format(date_create($user->onboardnig_date), "m-d-Y");
                    return $onboardnig_date;
                } else {
                    return $user->onboardnig_date = '';
                }
            })
            ->addColumn('placement_fee', function ($user) {
                return $user->placementFee;
            })
            ->addColumn('remarks_for_finance', function ($user) {
                return $user->remarks_for_finance;
            })
            ->addColumn('process_status', function ($user) {
                return $user->process_status;
            })

            ->rawColumns([
                'id', 'team', 'recruiter', 'client', 'reprocess', 'last_name',
                'career_endo', 'onboardnig_date', 'placement_fee', 'remarks_for_finance', 'status',
            ])
            ->make(true);
    }
    // close

    // save the update data of candidate
    public function SavefinanceReference(Request $request)
    {

        DB::table('finance')->where('id', $request->fid)->update([
            'remarks_recruiter' => $request->remarks,
        ]);
        $id = Auth::user()->id;
        $user = User::find($id);
        $userRole = $user->roles->pluck('id')->all();
        $t_id = $userRole;
        // dd($request->onboardnig_date);
        $data = [
            'remarks' => $request->remarks,
            "ob_date" => $request->onboardnig_date,
            "term_date" => $request->term_date,
            "code" => str_replace(',', '', $request->code),
            "payment_term" => str_replace(',', '', $request->payment_term),
            "offered_salary" => str_replace(',', '', $request->offered_salary),
            "replacement_for" => str_replace(',', '', $request->replacement_for),
            "date_delvrd" => $request->date_delvrd,
            "process_status" => $request->process_status,
            "allowance" => str_replace(',', '', $request->allowance),
            "vat_per" => str_replace(',', '', $request->vat_per),
            "credit_memo" => str_replace(',', '', $request->credit_memo),
            "invoice_number" => str_replace(',', '', $request->invoice_number),
            "invoice_date" => $request->invoice_date,
            "compensation" => str_replace(',', '', $request->compensation),
            "rate_per" => str_replace(',', '', $request->rate_per),
            "placementFee" => str_replace(',', '', $request->placement_fee),
            "or_number" => str_replace(',', '', $request->or_number),
            "date_collected" => $request->date_collected,
            "reprocess_share" => str_replace(',', '', $request->reprocess_share),
            "reprocess_share_per" => str_replace(',', '', $request->reprocess_share_per),
            "vcc_share_per" => str_replace(',', '', $request->vcc_share_per),
            "vcc_amount" => str_replace(',', '', $request->VSA),
            "finalFee" => str_replace(',', '', $request->finalFee),
            "owner_share_per" => str_replace(',', '', $request->owner_share_per),
            "owner_share" => str_replace(',', '', $request->owner_share),
            "c_take_per" => str_replace(',', '', $request->c_take_per),
            "c_take" => str_replace(',', '', $request->c_take),
            "adjustment" => str_replace(',', '', $request->adjustment),
            "ind_revenue" => str_replace(',', '', $request->ind_revenue),
            "t_id" => $t_id,
        ];

        $eid = (Finance::where('id', $request->fid)->first())->endorsement_id;
        Endorsement::where('id', $eid)->update([
            'remarks' => $request->remarks,
        ]);
        Finance::where('id', $request->fid)->update([
            'rate' => str_replace(',', '', $request->rate_per),
            'onboardnig_date' => $request->onboardnig_date,
        ]);
        Finance_detail::where("finance_id", $request->fid)->update($data);
        Helper::save_log('Finance_Reference_Updated');
        // return $request->candidate_id;
        return response()->json(['success' => true, 'message' => 'Updated successfully']);
    }
    // close

    // append the summary of filtered record
    public function summaryAppend(Request $request)
    {
        //for check team revenue
        // $recruiter = Auth::user()->roles()->pluck('name');
        $revenueArray = [];
        $revenue = DB::select('select id from roles where team_revenue = 1 and id != 3 and id != 24');
        //  DB::table('roles')->where('team_revenue', 1)->whereNotIn('id',)->get('id');
        // dd($revenue);
        foreach ($revenue as $key => $value) {
            $revenueArray[$key] = $value->id;
        }
        // dd($revenueArray);
        $teamRevenueAmount = DB::table('finance_detail')
            ->select(DB::raw('Sum(vcc_amount) as totoalRevenue'))
            ->whereIn('t_id', $revenueArray)->get();

        //for check team revenue close
        $arr = ['Onboarded', 'Offer Accepted', 'Fallout'];
        if ($request->array == 1) {
            $Userdata = DB::table('finance_formula_view');
        } elseif (isset($request->array)) {
            $Userdata = DB::table('finance_formula_view')
                ->whereIn('candidate_id', array_values($request->array))
                ->whereIn('endorsement_id', array_keys($request->array));
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
        // foreach ($arr as $remarks) {
        //     $sql = str_replace($remarks, "'$remarks'", $sql);
        // }
        // end modify  wherein()

        if (strpos($sql, 'where') !== false) {
            $sql_fallout = $sql . " and  remarks_recruiter in('fall out' , 'Replacement')";
            $sql_billed = $sql . " and  remarks_recruiter in('Billed' , 'Collected' , 'For Replacement' , 'Replaced')";
            $sql_unBilled = $sql . " and remarks_recruiter ='Unbilled' ";
            $sql_billed_amount = DB::select($sql_billed);
            $sql_unbilled_amount = DB::select($sql_unBilled);
            $sql_fallout_amount = DB::select($sql_fallout);
            // $Revenue_In_Incentive="";
            $sql_receivables = $sql . " and process_status in('OVERDUE','FFUP','RCVD') ";
            $sql_Current_receivables = $sql . " and process_status in('FFUP','RCVD')  ";
            $sql_overDue_receivables = $sql . " and process_status ='OVERDUE' ";
            $c_share = $sql . " and remarks_recruiter in('Billed' , 'Collected' , 'For Replacement' , 'Replaced') and team =3 ";
            $bod_share = $sql . " and remarks_recruiter in('Billed' , 'Collected' , 'For Replacement' , 'Replaced') and team = 24 ";
            $c_take = $sql . " and remarks_recruiter in('Billed' , 'Collected' , 'For Replacement' , 'Replaced') ";
            $vcc_amount_sum = $sql . " and remarks_recruiter in('Billed' , 'Collected' , 'For Replacement' , 'Replaced')   ";
            // $vcc_amount_sum_for_I_B_R=$sql." and remarks_recruiter LIKE '%collect%' OR "
            // $sql_onboarded = $sql . " and remarks_recruiter_for_finance='Onboarded'";
        } else {

            $sql_fallout = $sql . " where  remarks_recruiter in('fall out' , 'Replacement')";
            $sql_billed = $sql . "where  remarks_recruiter in('Billed' , 'Collected' , 'For Replacement' , 'Replaced')";
            $sql_unBilled = $sql . "where remarks_recruiter ='Unbilled' ";
            $sql_billed_amount = DB::select($sql_billed);
            $sql_unbilled_amount = DB::select($sql_unBilled);
            $sql_fallout_amount = DB::select($sql_fallout);
            // $Revenue_In_Incentive="";
            $sql_receivables = $sql . "where process_status in('OVERDUE','FFUP','RCVD') ";
            $sql_Current_receivables = $sql . "where process_status in('FFUP','RCVD')  ";
            $sql_overDue_receivables = $sql . "where process_status ='OVERDUE' ";
            $c_share = $sql . " where remarks_recruiter in('Billed' , 'Collected' , 'For Replacement' , 'Replaced') and team =3 ";
            $bod_share = $sql . " where   remarks_recruiter in('Billed' , 'Collected' , 'Replaced') and team = 24 ";
            $c_take = $sql . " where remarks_recruiter in('Billed' , 'Collected' , 'For Replacement' , 'Replaced') ";
            $vcc_amount_sum = $sql . "where remarks_recruiter in('Billed' , 'Collected' , 'For Replacement' , 'Replaced')   ";

        }
        $sql_receivables_amount = DB::select($sql_receivables);
        $sql_Current_receivables_amount = DB::select($sql_Current_receivables);
        $sql_overDue_receivables_amount = DB::select($sql_overDue_receivables);
        $sql_ctake_amount = DB::select($c_take);
        $sql_c_share_db = DB::select($c_share);
        $sql_bod_share_db = DB::select($bod_share);
        $sql_vcc_amount_sum = DB::select($vcc_amount_sum);
        $billedAmount = 0;
        $unbilledAmount = 0;
        $falloutAmount = 0;
        $receivablesAmount = 0;
        $Current_receivablesAmount = 0;
        $overDue_receivablesAmount = 0;
        $ctakeAmount = 0;
        $sql_c_share = 0;
        $sql_bod_share = 0;
        $vcc_amount_sum = 0;
        foreach ($sql_billed_amount as $total) {
            $billedAmount = $billedAmount + $total->vcc_share;
        }
        foreach ($sql_unbilled_amount as $unbill) {
            $unbilledAmount = $unbilledAmount + $unbill->vcc_share;
        }

        foreach ($sql_fallout_amount as $fallout) {
            $falloutAmount = $falloutAmount + $fallout->vcc_share;
        }
        foreach ($sql_receivables_amount as $receivable) {
            $receivablesAmount = $receivablesAmount + $receivable->finalFee;
        }
        foreach ($sql_Current_receivables_amount as $Curr_receivable) {
            $Current_receivablesAmount = $Current_receivablesAmount + $Curr_receivable->finalFee;
        }
        foreach ($sql_overDue_receivables_amount as $over_receivable) {
            $overDue_receivablesAmount = $overDue_receivablesAmount + $over_receivable->finalFee;
        }
        foreach ($sql_ctake_amount as $ctake) {
            //unknown vlaue for some
            $ctakeAmount = $ctakeAmount + $ctake->c_take;
        }

        foreach ($sql_c_share_db as $cftake) {
            //unknown vlaue for some
            $sql_c_share = $sql_c_share + $cftake->c_take;
        }
        foreach ($sql_bod_share_db as $bod) {
            //unknown vlaue for some
            $sql_bod_share = $sql_bod_share + $bod->vcc_share;
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

            $teamRevenueAmountFinance += $value->totoalRevenue;
        }

        // $traf = $teamRevenueAmountFinance + $vcc_amount_sum + $sql_c_share;
        // return $traf ;
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
            'sql_bod_share' => $sql_bod_share,
            'vcc_amount_sum' => $vcc_amount_sum,
            'teamRevenueAmount' => $teamRevenueAmountFinance,
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
            ->select('candidate_informations.id as cid', 'candidate_informations.reprocess', 'candidate_informations.first_name', 'candidate_informations.middle_name', 'candidate_informations.last_name')->get();
        $recruiter = User::where("type", 3)->get();
        $teams = DB::select("select * from roles order by name");
        $appstatus = DB::select("select app_status from endorsements group by app_status");
        $remarks_finance = DB::select("select remarks_for_finance from endorsements where remarks_for_finance !='' group by remarks_for_finance");
        $client = DB::select('select distinct client from endorsements where client!="" order by client ASC;');
        $process =  Helper::get_dropdown('process_status'); 
        return response()->json([
            'candidates' => $candidates,
            'recruiter' => $recruiter,
            "teams" => $teams,
            "appstatus" => $appstatus,
            'remarks_finance' => $remarks_finance,
            'client' => $client,
            'process' => $process,
        ]);
    }
    // close
    // public function FinanceSearchForSummary(Request $request)
    // {
    //     $revenueArray = [];
    //     $revenue = DB::table('roles')->where('team_revenue', 1)->get('id');
    //     // dd($revenue);
    //     foreach ($revenue as $key => $value) {
    //         $revenueArray[$key] = $value->id;
    //     }
    //     $teamRevenueAmount = DB::table('finance_detail')->select(DB::raw('Sum(vcc_amount) as totoalRevenue'))->whereIn('t_id', $revenueArray)->get();

    //     $check = $searchCheck = false;
    //     if ($request->searchKeyword == null) {
    //         $request->searchKeyword = 1;
    //         $objetoRequest = new \Illuminate\Http\Request();
    //         $objetoRequest->setMethod('POST');
    //         $objetoRequest->request->add([
    //             'array' => '1',
    //         ]);
    //         return $this->summaryAppend($objetoRequest);
    //         // return $this->summaryAppend($request->searchKeyword);
    //     }
    //     // dd($request->all());
    //     $arr = ['Onboarded', 'Offer Accepted', 'Fallout'];
    //     $Userdata = DB::table('finance')
    //         ->join('candidate_informations', 'finance.candidate_id', 'candidate_informations.id', )->join('endorsements', 'endorsements.candidate_id', 'finance.candidate_id')
    //         ->join('finance_detail', 'finance_detail.candidate_id', 'finance.candidate_id')
    //         ->whereIn('endorsements.remarks_for_finance', $arr)
    //         ->select('endorsements.remarks_for_finance', 'endorsements.client', 'endorsements.career_endo', 'endorsements.status',
    //             'candidate_informations.last_name', 'endorsements.saved_by', 'finance.placement_fee', 'finance.srp', 'finance_detail.*');

    //     //start search
    //     if (isset($request->searchKeyword)) {
    //         $perfect_match = DB::table('finance')
    //             ->join('candidate_informations', 'finance.candidate_id', 'candidate_informations.id', )->join('endorsements', 'endorsements.candidate_id', 'finance.candidate_id')
    //             ->join('finance_detail', 'finance_detail.candidate_id', 'finance.candidate_id')
    //             ->whereIn('endorsements.remarks_for_finance', $arr)
    //             ->select('endorsements.remarks_for_finance', 'endorsements.client', 'endorsements.career_endo', 'endorsements.status',
    //                 'candidate_informations.last_name', 'endorsements.saved_by', 'finance.placement_fee', 'finance.srp', 'finance_detail.*')->get();
    //         foreach ($perfect_match as $match) {
    //             if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {
    //                 $check = true;
    //                 $Userdata->where('candidate_informations.last_name', 'like', '"%' . $request->searchKeyword . '%"');
    //             }
    //             if (strpos(strtolower($match->saved_by), strtolower($request->searchKeyword)) !== false) {
    //                 $check = true;
    //                 $Userdata->where('endorsements.saved_by', 'like', '"%' . $request->searchKeyword . '%"');
    //             }
    //             if (strpos(strtolower($match->client), strtolower($request->searchKeyword)) !== false) {
    //                 $check = true;
    //                 $Userdata->where('endorsements.client', 'like', '"%' . $request->searchKeyword . '%"');
    //             }
    //             if (strpos(strtolower($match->remarks_for_finance), strtolower($request->searchKeyword)) !== false) {
    //                 $check = true;
    //                 $Userdata->where('endorsements.remarks_for_finance', 'like', '"%' . $request->searchKeyword . '%"');
    //             }
    //             if (strpos(strtolower($match->career_endo), strtolower($request->searchKeyword)) !== false) {
    //                 $check = true;
    //                 $Userdata->where('endorsements.career_endo', 'like', '"%' . $request->searchKeyword . '%"');
    //             }
    //             if (strpos(strtolower($match->status), strtolower($request->searchKeyword)) !== false) {
    //                 $check = true;
    //                 $Userdata->where('endorsements.status', 'like', '"%' . $request->searchKeyword . '%"');
    //             }
    //             if (strpos(strtolower($match->placement_fee), strtolower($request->searchKeyword)) !== false) {
    //                 $check = true;
    //                 $Userdata->where('finance.placement_fee', 'like', '"%' . $request->searchKeyword . '%"');
    //             }
    //         }
    //     }
    //     if ($check) {
    //         $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql());
    //         foreach ($arr as $remarks) {
    //             $sql = str_replace($remarks, "'$remarks'", $sql);
    //         }
    //     } else {
    //         if (!$check) {
    //             $data = [
    //                 'hires' => 0,
    //                 'fallout' => 0,
    //                 'billed' => 0,
    //                 'unbilled' => 0,
    //                 'billedAmount' => 0,
    //                 'unbilledAmount' => 0,
    //                 'falloutAmount' => 0,
    //                 'receivablesAmount' => 0,
    //                 'Current_receivablesAmount' => 0,
    //                 'overDue_receivablesAmount' => 0,
    //                 'ctakeAmount' => 0,
    //                 'sql_c_share' => 0,
    //                 'vcc_amount_sum' => 0,
    //                 'teamRevenueAmount' => 0,

    //             ];

    //             return view('finance.summary', $data);
    //         }
    //     }

    //     if (strpos($sql, 'where') !== false) {
    //         $sql_fallout = $sql . "  and endorsements.remarks LIKE '%fallout%' OR endorsements.remarks LIKE '%replacement%'   ";
    //         $sql_billed = $sql . " and  endorsements.remarks in('fallout','Billed','replacement')";
    //         $sql_unBilled = $sql . " and endorsements.remarks ='Unbilled' ";
    //         $sql_billed_amount = DB::select($sql_billed);
    //         $sql_unbilled_amount = DB::select($sql_unBilled);
    //         $sql_fallout_amount = DB::select($sql_fallout);
    //         $sql_receivables = $sql . " and finance_detail.process_status in('OVERDUE','FFUP','RCVD') ";
    //         $sql_Current_receivables = $sql . " and finance_detail.process_status in('FFUP','RCVD')  ";
    //         $sql_overDue_receivables = $sql . " and finance_detail.process_status ='OVERDUE' ";
    //         $c_share = $sql . "  and endorsements.remarks LIKE '%collect%' OR endorsements.remarks LIKE '%replace%'OR endorsements.remarks LIKE 'billed%' and t_id =3  ";
    //         $vcc_amount_sum = $sql . " and endorsements.remarks LIKE '%collect%' OR endorsements.remarks LIKE '%replace%'OR endorsements.remarks LIKE 'billed%'  ";
    //     };

    //     $sql_receivables_amount = DB::select($sql_receivables);
    //     $sql_Current_receivables_amount = DB::select($sql_Current_receivables);
    //     $sql_overDue_receivables_amount = DB::select($sql_overDue_receivables);
    //     $sql_ctake_amount = DB::select($sql_billed);
    //     $sql_c_share_db = DB::select($c_share);
    //     $sql_vcc_amount_sum = DB::select($vcc_amount_sum);
    //     $billedAmount = 0;
    //     $unbilledAmount = 0;
    //     $falloutAmount = 0;
    //     $receivablesAmount = 0;
    //     $Current_receivablesAmount = 0;
    //     $overDue_receivablesAmount = 0;
    //     $ctakeAmount = 0;
    //     $sql_c_share = 0;
    //     $vcc_amount_sum = 0;
    //     foreach ($sql_billed_amount as $total) {
    //         $billedAmount = $billedAmount + $total->srp;
    //     }
    //     foreach ($sql_unbilled_amount as $unbill) {
    //         $unbilledAmount = $unbilledAmount + $unbill->srp;
    //     }

    //     foreach ($sql_fallout_amount as $fallout) {
    //         $falloutAmount = $falloutAmount + $fallout->srp;
    //     }
    //     foreach ($sql_receivables_amount as $receivable) {
    //         $receivablesAmount = $receivablesAmount+isset($receivable->finalFee) ? $receivable->finalFee : 0;
    //     }
    //     foreach ($sql_Current_receivables_amount as $Curr_receivable) {
    //         $Current_receivablesAmount = $Current_receivablesAmount+isset($Curr_receivable->finalFee) ? $Curr_receivable->finalFee : 0;
    //     }
    //     foreach ($sql_overDue_receivables_amount as $over_receivable) {
    //         $overDue_receivablesAmount = $overDue_receivablesAmount+isset($over_receivable->finalFee) ? $over_receivable->finalFee : 0;
    //     }
    //     foreach ($sql_ctake_amount as $ctake) {
    //         //unknown vlaue for some
    //         $ctakeAmount = $ctakeAmount + $ctake->c_take;
    //     }
    //     foreach ($sql_c_share_db as $cftake) {
    //         //unknown vlaue for some
    //         $sql_c_share = $sql_c_share + $cftake->c_take;
    //     }
    //     foreach ($sql_vcc_amount_sum as $cftake) {
    //         //unknown vlaue for some
    //         $vcc_amount_sum = $vcc_amount_sum + $cftake->c_take;
    //     }
    //     $teamRevenueAmountFinance = 0;
    //     foreach ($teamRevenueAmount as $value) {
    //         # code...
    //         $teamRevenueAmountFinance += $value->totoalRevenue;
    //     }

    //     $traf = $teamRevenueAmountFinance + $vcc_amount_sum + $sql_c_share;
    //     $data = [
    //         'hires' => count(DB::select($sql)),
    //         'fallout' => count(DB::Select($sql_fallout)),
    //         'billed' => count(DB::select($sql_billed)),
    //         'unbilled' => count(DB::select($sql_unBilled)),
    //         'billedAmount' => $billedAmount,
    //         'unbilledAmount' => $unbilledAmount,
    //         'falloutAmount' => $falloutAmount,
    //         'receivablesAmount' => $receivablesAmount,
    //         'Current_receivablesAmount' => $Current_receivablesAmount,
    //         'overDue_receivablesAmount' => $overDue_receivablesAmount,
    //         'ctakeAmount' => $ctakeAmount,
    //         'sql_c_share' => $sql_c_share,
    //         'vcc_amount_sum' => $vcc_amount_sum,
    //         'teamRevenueAmount' => $traf,

    //     ];
    //     return view('finance.summary', $data);
    // }
}
