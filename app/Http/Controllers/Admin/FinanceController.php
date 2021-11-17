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
use Symfony\Component\Process\Process;
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
        $savedBy = \App\CandidateInformation::where('id', $detail->candidate_id)->first();
        $user = \App\User::where('id', $savedBy->saved_by)->first();
        $role = $user->roles->pluck('name');
        $team = $role;
        $data = [
            'detail' => $detail,
            'team' => $team,
            'fee' => $fee,
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

        $Userdata = DB::table('six_table_view');
        //    check null values coming form selected options
        if (isset($request->recruiter)) {
            $Userdata->whereIn('six_table_view.saved_by', $request->recruiter);
        }
        if (isset($request->candidate)) {
            $Userdata->whereIn('six_table_view.candidate_id', $request->candidate);
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
        if (isset($request->appstatus)) {
            $Userdata->whereIn('six_table_view.endo_status', $request->appstatus);
        }
        if (isset($request->client)) {
            $Userdata->whereIn('six_table_view.client', $request->client);
        }
        if (isset($request->appstatus)) {
            $Userdata->whereIn('six_table_view.app_status', $request->appstatus);
        }


        $user = $Userdata->get();
        return Datatables::of($user)
            ->addIndexColumn()
            ->addColumn('id', function ($user) {
                $team= DB::select('select * from  roles where id='.$user->saved_by);
                return $team[0]->name;
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
                return $user->onboardnig_date;
            })
            ->addColumn('placement_fee', function ($user) {
                return $user->placement_fee;
            })
            ->addColumn('remarks_for_finance', function ($user) {
                return $user->remarks_for_finance;
            })
            ->addColumn('endostatus', function ($user) {
                return $user->endostatus;
            })
            ->rawColumns([
                'id', 'recruiter', 'client', 'reprocess', 'last_name', 'career_endo',
                'onboardnig_date', 'placement_fee', 'remarks_for_finance', 'endostatus'
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
        $Userdata = DB::table('six_table_view')->get();
        return Datatables::of($Userdata)
            ->addIndexColumn()
            ->addColumn('id', function ($Userdata) {
                return $Userdata->id;
            })
            // ->addColumn('team', function ($Userdata) {
            //     return $Userdata->team;
            // })
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
                return $Userdata->onboardnig_date;
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
                'srp', 'onboardnig_date', 'placement_fee', 'address'
            ])
            ->make(true);
    }
}
