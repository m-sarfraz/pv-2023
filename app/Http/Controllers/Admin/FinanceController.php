<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Http\Controllers\Controller;
use App\User;
use Carbon;
use DB;
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
        $Userdata = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
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
        $detail = DB::table('finance')->
            join('endorsements', 'endorsements.candidate_id', 'finance.candidate_id')
            ->select('endorsements.*', 'finance.*')
            ->where('finance.candidate_id', $request->id)
            ->first();
        $data = [
            'detail' => $detail,
        ];
        return view('finance.detail', $data);

    }
    // close

    // function for filtering record starts
    public function recordFilter(Request $request)
    {
        // dd($request->candidate);
        $arr = ['Onboarded', 'Offer Accepted', 'Fallout'];
        $Userdata = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
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
        // return $user;
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
}
