<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Http\Controllers\Controller;

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
            ->select('candidate_educations.*', 'candidate_informations.id as candidate_id', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->paginate(10);
        $data = [
            'Userdata' => $Userdata,
        ];
        return view('finance.finance', $data);
    }
}
