<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Finance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
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
            'Userdata' => $Userdata,
        ];
        return view('finance.finance', $data);
    }
    public function recordDetail(Request $request)
    {
        $Userdata = Finance::
            join('endorsements', 'endorsements.candidate_id', 'finance.candidate_id')
            ->select('endorsements.*', 'finance.* ')
            ->where('remarks_for_finance', 'Onboarded')
            ->orWhere('remarks_for_finance', 'Offer accepted')
            ->paginate(10);
        return $Userdata;
    }
}
