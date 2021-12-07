<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Finance;
use App\Finance_detail;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Helper;
use Illuminate\Http\Request;
use Str;
use Yajra\DataTables\DataTables;

class FinanceController extends Controller
{

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
        $Userdata = DB::table('finance_view');
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
            $Userdata->whereIn('finance_view.app_status', $request->appstatus);
        }
        $user = $Userdata->get();
        return Datatables::of($user)
            ->addIndexColumn()
            ->addColumn('id', function ($user) {
                return $user->cid;
            })
            ->addColumn('team', function ($user) {
                $team = DB::select('select * from  roles where id=' . $user->saved_by);
                return $team[0]->name;
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
            ->addColumn('app_status', function ($Userdata) {
                return $Userdata->app_status;
            })
            ->rawColumns([
                'id', 'team', 'recruiter', 'client', 'reprocess', 'last_name',
                'career_endo', 'onboardnig_date', 'placement_fee', 'remarks_for_finance', 'app_status',
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
        $Userdata = DB::table('finance_view')->get();
        return Datatables::of($Userdata)
            ->addIndexColumn()
            ->addColumn('id', function ($user) {
                return $user->cid;
            })
            ->addColumn('team', function ($user) {
                $team = DB::select('select * from  roles where id=' . $user->saved_by);
                foreach ($team as $teamName) {
                    $teams = $teamName->name;
                }
                return $teams;
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
            ->addColumn('endostatus', function ($Userdata) {
                return $Userdata->app_status;
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
        $check = $searchCheck = false;
        $arr = ['Onboarded', 'Offer Accepted', 'Fallout'];
        $Userdata = Finance::join('endorsements','endorsements.candidate_id','finance.candidate_id')
        ->whereIn('endorsements.remarks_for_finance', $arr)
        ->select('endorsements.*','finance.*');
  
        // ->groupBy('id');

        // $Userdata = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
        //     ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
        //     ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
        //     ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
        //     ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
        //     ->join('finance_detail', 'candidate_informations.id', 'finance_detail.candidate_id')
        //     ->select(
        //         DB::raw('SUM(finance_detail.c_take) as Summmmmmmm'),
        //         'candidate_educations.*',
        //         'candidate_informations.id as C_id',
        //         'candidate_informations.*',
        //         'candidate_positions.*',
        //         'candidate_domains.*',
        //         'finance.*',
        //         'endorsements.*',
        //         'finance_detail.c_take',
        //         'finance_detail.vcc_amount',

        //     );
       /* if (isset($request->candidate)) {
            $newarr = array();
            foreach ($request->candidate as $candidate) {
                //$strc =
                array_push($newarr, "'$candidate'");
            }
            $Userdata->whereIn('six_table.id', $request->candidate);
        }
        // return $request->recruiter;
        if (isset($request->recruiter)) {

            $Userdata->whereIn('six_table.saved_by', $request->recruiter);
        }
        if (isset($request->remarks)) {
            $newarr = array();
            foreach ($request->remarks as $remarks) {
                //$strc =
                array_push($newarr, "'$remarks'");
            }
            $Userdata->whereIn('six_table.remarks_for_finance', $request->remarks);
        }
        if (isset($request->ob_date)) {
            $Userdata->where('six_table.onboardnig_date', '>', $request->ob_date);
        }
        if (isset($request->toDate)) {
            $Userdata->where('six_table.onboardnig_date', '<', $request->toDate);
        }
        if (isset($request->client)) {
            $newarr = array();
            foreach ($request->client as $client) {
                //$strc =
                array_push($newarr, "'$client'");
            }
            $Userdata->whereIn('six_table.client', $request->client);
        }
        if (isset($request->team_id)) {
            $newarr = array();
            $users = User::role($request->team_id)->select('id')->get();
            for ($i = 0; $i < count($users); $i++) {
                array_push($newarr, $users[$i]->id);
            }
            if (!empty($newarr)) {

                $users = $Userdata->whereIn('six_table.saved_by', $newarr);
            }
            if (empty($newarr)) {
                $check = false;
                $searchCheck = true;
            }
        }
        if (isset($request->process)) {

            $Userdata->whereIn('six_table.reprocess', array($request->process));
        }

        // foreach ($request->career_level as $career) {
        //     $sql = str_replace($career, "'$career'", $sql);
        // }
        if (isset($request->remarks)) {
            # code...
            foreach ($request->remarks as $remarks) {
                $sql = str_replace($remarks, "'$remarks'", $sql);
            }
        }
        if (isset($request->client)) {
            # code...
            foreach ($request->client as $client) {
                $sql = str_replace($client, "'$client'", $sql);
            }
        }
        if (isset($request->recruiter)) {

            foreach ($request->recruiter as $recruiter) {
                $sql = str_replace($recruiter, "'$recruiter'", $sql);
            }
        }
        if (isset($request->candidate)) {

            foreach ($request->candidate as $candidate) {
                $sql = str_replace($candidate, "'$candidate'", $sql);
            }
        }
        if (isset($request->searchKeyword)) {
            $searchCheck = true;
            $perfect_match = DB::table("six_table_view")->get();
            // $roles = DB::table('roles')->pluck("name");

            foreach ($perfect_match as $match) {

                if (strpos(strtolower($match->career_endo), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('career_endo', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('last_name', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->first_name), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('first_name', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->client), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('client', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->onboardnig_date), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('onboardnig_date', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->placement_fee), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('placement_fee', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->remarks_for_finance), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('remarks_for_finance', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->app_status), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('app_status', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->reprocess), strtolower($request->searchKeyword)) !== false) {
                    $check = true;

                    $Userdata->where('reprocess', 'like', '%' . $request->searchKeyword . '%');
                }
            }
        }*/
        // if ($check) {

        //     $user = $Userdata->get();
        // } else {
        //     if (!$check && !$searchCheck) {
        //         $user = $Userdata->whereIn('remarks_for_finance', $arr)->get();
        //     } else {
        //         $user = [];
        //     }
        // }
        
        $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql());
       
        // foreach ($arr as $remarks) {
        //     $sql = str_replace($remarks, "'$remarks'", $sql);
        // }
        if (strpos($sql, 'where') !== false) {


            $sql_fallout = $sql . "  and remarks LIKE '%fallout%' OR remarks LIKE '%replacement%'  ";
            $sql_billed = $sql . " and remarks LIKE '%collect%' OR remarks LIKE '%replace%'OR remarks LIKE 'billed%'  ";
            $sql_unBilled = $sql . " and remarks ='Unbilled' ";
            // $sql_billed_amount = DB::select($sql_billed);
            // $sql_unbilled_amount = DB::select($sql_unBilled);
            // $sql_fallout_amount = DB::select($sql_fallout);
            // $sql_receivables = $sql . " and process_status in('OVERDUE','FFUP','RCVD') group by `id` ";
            // $sql_Current_receivables = $sql . " and process_status in('FFUP','RCVD') group by `id` ";
            // $sql_overDue_receivables = $sql . " and process_status ='OVERDUE' group by `id` ";
            // $sql_unbilled = $sql . "  and endorsements.remarks='Unbilled'";
            // $vcc_amount_sum = $sql . " and (select sum(vcc_amount) from finance_detail )";
            // $sql_onboarded = $sql . " and endorsements.remarks_for_finance='Onboarded'";
        } 
    //  return $sql_overDue_receivables;
        // else {
        //     $sql_fallout = $sql . " where remarks LIKE '%fallout%' OR remarks LIKE '%replacement%' group by `id`  ";
        //     $sql_billed = $sql . " where remarks LIKE '%collect%' OR remarks LIKE '%replace%'OR remarks LIKE 'billed%' group by `id`";
        //     $sql_unBilled = $sql . " where remarks ='Unbilled'";
        //     $sql_billed_amount = DB::select($sql_billed);
        //     $sql_unbilled_amount = DB::select($sql_unBilled);
        //     $sql_fallout_amount = DB::select($sql_fallout);
        //     $sql_receivables = $sql . " where process_status in('OVERDUE','FFUP','RCVD') group by `id` ";
        //     $sql_Current_receivables = $sql . " where process_status in('FFUP','RCVD') group by `id` ";
        //     $sql_overDue_receivables = $sql . " where process_status ='OVERDUE' group by `id` ";
        //     // $sql_enors = $sql . "where endorsements.app_status='To Be Endorsed'";
        //     // $sql_unbilled = $sql . " where endorsements.remarks='Unbilled'";
        //     // $vcc_amount_sum = $sql . "  and (select sum(vcc_amount) from finance_detail )";
        //     // $sql_active = $sql . "where endorsements.app_status='Active File'";
        //     // $sql_onboarded = $sql . "where endorsements.remarks_for_finance='Onboarded'";
        // }
        // $sql_receivables_amount = DB::select($sql_receivables);
        // $sql_Current_receivables_amount = DB::select($sql_Current_receivables);
        // $sql_overDue_receivables_amount = DB::select($sql_overDue_receivables);
        // $sql_ctake_amount = DB::select($sql_billed);
        // $billedAmount = 0;
        // $unbilledAmount = 0;
        // $falloutAmount = 0;
        // $receivablesAmount = 0;
        // $Current_receivablesAmount = 0;
        // $overDue_receivablesAmount = 0;
        // $ctakeAmount = 0;
        // foreach ($sql_billed_amount as $total) {
        //     $billedAmount = $billedAmount + $total->total;
        // }
        // foreach ($sql_unbilled_amount as $unbill) {
        //     $unbilledAmount = $unbilledAmount + $unbill->total;
        // }
        // foreach ($sql_fallout_amount as $fallout) {
        //     $falloutAmount = $falloutAmount + $fallout->total;
        // }
        // foreach ($sql_receivables_amount as $receivable) {
        //     $receivablesAmount = $receivablesAmount + $receivable->totalFee;
        // }
        // foreach ($sql_Current_receivables_amount as $Curr_receivable) {
        //     $Current_receivablesAmount = $Current_receivablesAmount + $Curr_receivable->totalFee;
        // }
        // foreach ($sql_overDue_receivables_amount as $over_receivable) {
        //     $overDue_receivablesAmount = $overDue_receivablesAmount + $over_receivable->totalFee;
        // }
        // foreach ($sql_ctake_amount as $ctake) {
        //     $ctakeAmount = $ctakeAmount + $ctake->totalC_take;
        // }
        $hires = DB::select($sql_fallout);
        return $hires;
        $data = [
            'hires' => count($Userdata),
            'fallout' => count(DB::Select("'".$sql_fallout."'")),
            'billed' => count(DB::select($sql_billed)),
            'unbilled' => count(DB::select($sql_unBilled)),
            // 'billedAmount' => $billedAmount,
            // 'unbilledAmount' => $unbilledAmount,
            // 'falloutAmount' => $falloutAmount,
            // 'receivablesAmount' => $receivablesAmount,
            // 'Current_receivablesAmount' => $receivablesAmount,
            // 'overDue_receivablesAmount' => $overDue_receivablesAmount,
            // 'ctakeAmount' => $ctakeAmount,
            // 'c_take' => count($sql_ctake_amount),
            // 'c_t_sum' => $finance_c_t_sum,
            // 'vcc_amount_sum' => $vcc_amount_sum,
            // 'fallout' => $fallout,
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
        $client = Helper::get_dropdown('clients');
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
}
