<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    //
    public function index()
    {
        $user = User::where('type', 3)->get();
        $candidates = CandidateInformation::all();
        $Userdata = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->get();
        // return $Userdata;
        $count = count($Userdata);
        $data = [
            'user' => $user,
            'candidates' => $candidates,
            'count' => $count,
            'Userdata' => $Userdata,
        ];
        return view('record.view_record', $data);
    }
    public function filter(Request $request)
    {

        // return $request->all();
        $Userdata = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as CID', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*');
        if ($request->candidate != null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->client == null && $request->app_status == null && $request->cl == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate);
        }
        if ($request->candidate != null && $request->user_id == null && $request->profile != null && $request->sub_segment == null && $request->client == null && $request->app_status == null && $request->cl == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_positions.candidate_profile', $request->profile);
        }
        if ($request->candidate != null && $request->user_id == null && $request->profile != null && $request->sub_segment != null && $request->client == null && $request->app_status == null && $request->cl == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment);
        }
        if ($request->candidate != null && $request->user_id == null && $request->profile != null && $request->sub_segment != null && $request->client != null && $request->app_status == null && $request->cl == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment)->whereIn('candidate_domains.segment', $request->segment);
        }
        if ($request->candidate != null && $request->user_id == null && $request->profile != null && $request->sub_segment != null && $request->client != null && $request->app_status != null && $request->cl == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment)->whereIn('candidate_domains.segment', $request->segment)->whereIn('endorsements.app_status', $request->app_status);
        }
        $a = $Userdata->get();
        // return $Userdata;
        $count = $a->count();
        $data = [
            'count' => $count,
            'Userdata' => $a,
        ];
        return view('record.filter-user', $data);
    }
}
