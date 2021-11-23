<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Finance_detail;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;
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

        ini_set('max_execution_time', 30000); //30000 seconds = 500 minutes
        $arr = ['Offer accepted', 'Onboarded'];
        $candidates = CandidateInformation::join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->whereIn('remarks_for_finance', $arr)
            ->select('candidate_informations.first_name', 'candidate_informations.id as cid', 'candidate_informations.reprocess', 'candidate_informations.last_name')->get();
        $recruiter = User::where("type", 3)->get();
        $teams = DB::select("select * from roles");
        $appstatus = DB::select("select app_status from endorsements group by app_status");
        $remarks_finance = DB::select("select remarks_for_finance from endorsements where remarks_for_finance !='' group by remarks_for_finance");
        // return $Userdata;
        $data = [
            'candidates' => $candidates,
            'recruiter' => $recruiter,
            "teams" => $teams,
            "appstatus" => $appstatus,
            'remarks_finance' => $remarks_finance,

        ];
        return view('finance.finance', $data);
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
        $Userdata = DB::table('six_table_view')->whereIn('remarks_for_finance', $arr);
        //    check null values coming form selected options
        if (isset($request->recruiter)) {
            $Userdata->whereIn('six_table_view.saved_by', $request->recruiter);
        }
        if (isset($request->client)) {
            $Userdata->whereIn('six_table_view.client', $request->client);
        }
        if (isset($request->candidate)) {
            $Userdata->whereIn('six_table_view.id', $request->candidate);
        }
        if (isset($request->remarks)) {
            $Userdata->whereIn('six_table_view.remarks_for_finance', $request->remarks);
        }
        if (isset($request->ob_date)) {
            $Userdata->whereDate('six_table_view.onboardnig_date', '>', $request->ob_date);
        }
        if (isset($request->toDate)) {
            $Userdata->whereDate('six_table_view.onboardnig_date', '<', $request->toDate);
        }

        if (isset($request->process)) {
            $Userdata->whereIn('six_table_view.reprocess', $request->process);
        }
        if (isset($request->appstatus)) {
            $Userdata->whereIn('six_table_view.app_status', $request->appstatus);
        }

        $user = $Userdata->get();

        return Datatables::of($user)
            ->addIndexColumn()
            ->addColumn('id', function ($user) {
                return $user->id;
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
            ->addColumn('endostatus', function ($Userdata) {
                return $Userdata->endostatus;
            })

            ->rawColumns([
                'id', 'client', 'gender', 'domain', 'candidate_profile', 'educational_attain',
                'curr_salary', 'portal', 'date_shifted', 'career_endo', 'endostatus', 'endi_date', 'remarks_for_finance', 'category',
                'srp', 'onboardnig_date', 'placement_fee', 'address',
            ])
            ->make(true);
    }
    //close

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
    public function view_finance_search_table()
    {
        $arr = ['Fallout', 'Offer accepted', 'Onboarded'];
        $Userdata = DB::table('six_table_view')->whereIn('remarks_for_finance', $arr)->get();
        return Datatables::of($Userdata)
            ->addIndexColumn()
            ->addColumn('id', function ($user) {
                return $user->id;
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
            ->addColumn('endostatus', function ($Userdata) {
                return $Userdata->endostatus;
            })

            ->rawColumns([
                'id', 'client', 'gender', 'domain', 'candidate_profile', 'educational_attain',
                'curr_salary', 'portal', 'date_shifted', 'career_endo', 'endostatus', 'endi_date', 'remarks_for_finance', 'category',
                'srp', 'onboardnig_date', 'placement_fee', 'address',
            ])
            ->make(true);
    }
    public function summaryAppend(Request $request)
    {
        $check = $searchCheck = false;
        $arr = ['Onboarded', 'Offer Accepted', 'Fallout'];
        $Userdata = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->join('finance_detail', 'candidate_informations.id', 'finance_detail.candidate_id')
            ->select(
                'candidate_educations.*',
                'candidate_informations.id as C_id',
                'candidate_informations.*',
                'candidate_positions.*',
                'candidate_domains.*',
                'finance.*',
                'endorsements.*',
                'finance_detail.c_take',
                'finance_detail.vcc_amount',

            );
        if (isset($request->candidate)) {
            $newarr = array();
            foreach ($request->candidate as $candidate) {
                //$strc =
                array_push($newarr, "'$candidate'");
            }
            $Userdata->whereIn('candidate_informations.id', $request->candidate);
        }
        // return $request->recruiter;
        if (isset($request->recruiter)) {

            $Userdata->whereIn('candidate_informations.saved_by', $request->recruiter);
        }
        if (isset($request->remarks)) {
            $newarr = array();
            foreach ($request->remarks as $remarks) {
                //$strc =
                array_push($newarr, "'$remarks'");
            }
            $Userdata->whereIn('endorsements.remarks_for_finance', $request->remarks);
        }
        if (isset($request->ob_date)) {
            $Userdata->where('finance.onboardnig_date', '>', $request->ob_date);
        }
        if (isset($request->toDate)) {
            $Userdata->where('finance.onboardnig_date', '<', $request->toDate);
        }
        if (isset($request->client)) {
            $newarr = array();
            foreach ($request->client as $client) {
                //$strc =
                array_push($newarr, "'$client'");
            }
            $Userdata->whereIn('endorsements.client', $request->client);
        }
        if (isset($request->team_id)) {
            $newarr = array();
            $users = User::role($request->team_id)->select('id')->get();
            for ($i = 0; $i < count($users); $i++) {
                array_push($newarr, $users[$i]->id);
            }
            if (!empty($newarr)) {

                $users = $Userdata->whereIn('candidate_informations.saved_by', $newarr);
            }
            if (empty($newarr)) {
                $check = false;
                $searchCheck = true;
            }
        }
        if (isset($request->process)) {

            $Userdata->whereIn('candidate_informations.reprocess', array($request->process));
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
                    $Userdata->where('endorsements.career_endo', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('candidate_informations.last_name', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->first_name), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('candidate_informations.first_name', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->client), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('endorsements.client', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->onboardnig_date), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('finance.onboardnig_date', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->placement_fee), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('finance.placement_fee', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->remarks_for_finance), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('endorsements.remarks_for_finance', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->app_status), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('endorsements.app_status', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->reprocess), strtolower($request->searchKeyword)) !== false) {
                    $check = true;

                    $Userdata->where('candidate_informations.reprocess', 'like', '%' . $request->searchKeyword . '%');
                }
            }
        }
        if ($check) {

            $user = $Userdata->whereIn('endorsements.remarks_for_finance', $arr)->get();
        } else {
            if (!$check && !$searchCheck) {
                $user = $Userdata->whereIn('endorsements.remarks_for_finance', $arr)->get();
            } else {
                $user = [];
            }
        }
        $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql());
        foreach ($arr as $remarks) {
            $sql = str_replace($remarks, "'$remarks'", $sql);
        }
        if (strpos($sql, 'where') !== false) {
            $sql_fallout = $sql . " and remarks_for_finance LIKE '%fallout%' OR remarks_for_finance LIKE '%replacement%' ";
            $sql_billed = $sql . " and endorsements.remarks LIKE '%collect%' OR endorsements.remarks LIKE '%replace%'OR endorsements.remarks LIKE 'billed%' ";
            $sql_unBilled = $sql . " and endorsements.remarks LIKE '%unbilled%' ";
            // $sql_unbilled = $sql . "  and endorsements.remarks='Unbilled'";
            // $finance_c_t_sum = $sql . " and (select sum(c_take) from finance_detail )";
            // $vcc_amount_sum = $sql . " and (select sum(vcc_amount) from finance_detail )";
            // $sql_onboarded = $sql . " and endorsements.remarks_for_finance='Onboarded'";
        } else {
            $sql_fallout = $sql . " where remarks_for_finance LIKE '%fallout%' OR remarks_for_finance LIKE '%replacement%'  ";
            $sql_billed = $sql . " where remarks LIKE '%collect%' OR remarks LIKE '%replace%'OR remarks LIKE 'billed%' ";
            $sql_unBilled = $sql . " where remarks LIKE '%unbilled%' ";
            // $sql_enors = $sql . "where endorsements.app_status='To Be Endorsed'";
            // $sql_unbilled = $sql . " where endorsements.remarks='Unbilled'";
            // $finance_c_t_sum = $sql . "  and (select sum(c_take) from finance_detail )";
            // $vcc_amount_sum = $sql . "  and (select sum(vcc_amount) from finance_detail )";
            // $sql_active = $sql . "where endorsements.app_status='Active File'";
            // $sql_onboarded = $sql . "where endorsements.remarks_for_finance='Onboarded'";
        }
        $hires = count($user);
        $data = [
            'hires' => $hires,
            'fallout' => count(DB::select($sql_fallout)),
            'billed' => count(DB::select($sql_billed)),
            'unbilled' => count(DB::select($sql_unBilled)),
            // 'Userdata' => $user,
            // 'c_t_sum' => $finance_c_t_sum,
            // 'vcc_amount_sum' => $vcc_amount_sum,
            // 'fallout' => $fallout,
        ];

        return view('finance.summary', $data);
    }
}
