<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Http\Controllers\Controller;
use App\User;
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
        $data = [
            'candidates' => $candidates,
            'Userdata' => $Userdata,
            'user' => $user,
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
        $where = [];
        // dd($request->candidate);
        // for ($i = 0; $i < count($request->all()); $i++) {
        if (isset($request->candidate)) {
            foreach ($request->candidate as $key => $value) {
                $where['candidate_informations.id'] = $request->candidate;
            }

        }
        if (isset($request->recruiter)) {
            foreach ($request->recruiter as $key => $value) {

                $where['saved_by'] = $request->recruiter;
            }
        }
        if (isset($request->remarks)) {
            foreach ($request->remarks as $key => $value) {

                $where['endorsements.remarks_for_finance'] = $request->remarks;
            }
        }
        // if (isset($request->recruiter)) {
        //     foreach ($request->recruiter as $key => $value) {

        //         $where['saved_by'] = $request->recruiter;
        //     }
        // }
        // if (isset($request->recruiter)) {
        //     foreach ($request->recruiter as $key => $value) {

        //         $where['saved_by'] = $request->recruiter;
        //     }
        // }
        // if (isset($request->recruiter)) {
        //     foreach ($request->recruiter as $key => $value) {

        //         $where['saved_by'] = $request->recruiter;
        //     }
        // }
        // if (isset($request->recruiter)) {
        //     foreach ($request->recruiter as $key => $value) {

        //         $where['saved_by'] = $request->recruiter;
        //     }
        // }
        // if (isset($request->recruiter)) {
        //     foreach ($request->recruiter as $key => $value) {

        //         $where['saved_by'] = $request->recruiter;
        //     }
        // }
        // if (isset($request->recruiter)) {
        //     foreach ($request->recruiter as $key => $value) {

        //         $where['saved_by'] = $request->recruiter;
        //     }
        // }
        // dd($where);
        $Userdata = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.id as C_id', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->where($where)
        // ->where('remarks_for_finance', 'Onboarded')
        // ->orWhere('remarks_for_finance', 'Offer accepted')
            ->get();
        // return $Userdata;
        $data = [
            'Userdata' => $Userdata,
        ];
        return view('finance.filter_data', $data);
    }
    //close
}
