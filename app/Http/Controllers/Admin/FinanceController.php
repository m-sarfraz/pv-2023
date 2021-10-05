<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Finance_detail;
use App\Http\Controllers\Controller;
use App\User;
use Carbon;
use DB;
use Helper;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    // index view of finance page starts
    public function index()
    {
        $candidates = CandidateInformation::join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->where('endorsements.remarks_for_finance', 'Onboarded')
            ->orWhere('endorsements.remarks_for_finance', 'Offer accepted')
            ->select('candidate_informations.first_name', 'candidate_informations.id as cid', 'candidate_informations.last_name')->get();
        // return $candidate;
        $user = User::where('type', 3)->get();
        $Userdata = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.id as C_id', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->where('remarks_for_finance', 'Onboarded')
            ->orWhere('remarks_for_finance', 'Offer accepted')
            ->paginate(10);
        // return $Userdata;
        $billsArray = ['Billed', 'For Replacement', 'Replaced'];
        $billed = $Userdata->whereIn('endorsements.remarks', $billsArray)->count();
        $unbilled = $Userdata->where('endorsements.remarks', 'Unbilled')->count();
        $fallout = $Userdata->where('endorsements.remarks', 'Fallout')->count();
        $count = count($Userdata);
        $hires = count($Userdata);
        $data = [
            'candidates' => $candidates,
            'Userdata' => $Userdata,
            'user' => $user,
            'count' => $count,
            'hires' => $hires,
            'billed' => $billed,
            'unbilled' => $unbilled,
            'fallout' => $fallout,
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

    // function for filtering record starts
    public function recordFilter(Request $request)
    {
        // dd($request->candidate);
        $arr = ['Onboarded', 'Offer Accepted', 'Fallout'];
        $Userdata = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.id as C_id', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->whereIn('endorsements.remarks_for_finance', $arr);
        // ->orWhere('remarks_for_finance', 'Offer accepted');
        if (isset($request->candidate)) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate);
        }
        if (isset($request->recruiter)) {
            $Userdata->whereIn('candidate_informations.saved_by', $request->recruiter);
        }
        if (isset($request->remarks)) {
            $Userdata->whereIn('endorsements.remarks_for_finance', $request->remarks);
        }
        if (isset($request->ob_date)) {
            $time = strtotime($request->ob_date);
            $newformat = date('Y-m-d', $time);
            $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('finance.onboardnig_date', '>', $newformat);
        }
        if (isset($request->toDate)) {
            $time = strtotime($request->toDate);
            $newformat = date('Y-m-d', $time);
            $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('finance.onboardnig_date', '<', $newformat);
        }
        if (isset($request->client)) {
            $Userdata->whereIn('endorsements.client', $request->client);
        }
        $user = $Userdata->get();
        $billsArray = ['Billed', 'For Replacement', 'Replaced'];
        $billed = $Userdata->whereIn('endorsements.remarks', $billsArray)->count();
        $unbilled = $Userdata->where('endorsements.remarks', 'Unbilled')->count();
        $fallout = $Userdata->where('endorsements.remarks', 'Fallout')->count();
        $billamout = $Userdata->whereIn('endorsements.remarks', $billsArray)->get();
        // dd($billamout);
        // $compnayRevenue = $Userdata->whereIn('');
        $hires = count($user);
        $data = [
            'Userdata' => $user,
            'hires' => $hires,
            'billed' => $billed,
            'unbilled' => $unbilled,
            'fallout' => $fallout,
        ];
        return view('finance.filter_data', $data);
    }
    //close

    public function SavefinanceReference(Request $request)
    {
 
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
        ];
        Finance_detail::where("candidate_id", $request->candidate_id)->update($data);
        Helper::save_log('Finance_Reference_updated');
        return $request->candidate_id;
    }
}
