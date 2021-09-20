<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Endorsement;
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
            ->select('candidate_educations.*', 'candidate_informations.id as cid', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->paginate(2);
        // return $Userdata;
        $count = $Userdata->count();
        $candidates = CandidateInformation::all();
        $candidateprofile = CandidatePosition::all();
        $candidateDomain = CandidateDomain::all();
        $endorsement = Endorsement::all();
        $data = [
            'user' => $user,
            'candidates' => $candidates,
            'count' => $count,
            'Userdata' => $Userdata,
            'candidateprofile' => $candidateprofile,
            'candidateDomain' => $candidateDomain,
            'endorsement' => $endorsement,
        ];
        return view('record.view_record', $data);
    }
    public function filter(Request $request)
    {

        // dd($request->career_level);
        $Userdata = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
        // ->join('drop_down_options', 'endorsements.app_status', 'drop_down_options.id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as CID', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*');
        // condition for checking first to end not null starts here
        if ($request->candidate == null && $request->user_id != null && $request->profile == null && $request->sub_segment == null && $request->client == null && $request->app_status == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.saved_by', $request->user_id);
        }
        if ($request->candidate != null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->client == null && $request->app_status == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate);
        }
        if ($request->candidate != null && $request->user_id != null && $request->profile == null && $request->sub_segment == null && $request->client == null && $request->app_status == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_informations.saved_by', $request->user_id);
        }
        if ($request->candidate != null && $request->user_id != null && $request->profile != null && $request->sub_segment == null && $request->client == null && $request->app_status == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_informations.saved_by', $request->user_id);
        }
        if ($request->candidate != null && $request->user_id != null && $request->profile != null && $request->sub_segment != null && $request->client == null && $request->app_status == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment)->whereIn('candidate_informations.saved_by', $request->user_id);
        }
        if ($request->candidate != null && $request->user_id != null && $request->profile != null && $request->sub_segment != null && $request->app_status != null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment)->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereIn('endorsements.app_status', $request->app_status);
        }
        if ($request->candidate != null && $request->user_id != null && $request->profile != null && $request->sub_segment != null && $request->app_status != null && $request->client != null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment)->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereIn('endorsements.app_status', $request->app_status)->whereIn('endorsements.client', $request->client);
        }
        if ($request->candidate != null && $request->user_id != null && $request->profile != null && $request->sub_segment != null && $request->app_status != null && $request->client != null && $request->career_level != null && $request->date != null) {
            // dd($request->career_level);
            $time = strtotime($request->date);
            $newformat = date('Y-m-d', $time);
            // dd($newformat);
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment)->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereIn('endorsements.app_status', $request->app_status)->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level)
                ->whereDate('endorsements.endi_date', '<', $newformat);
        }

        // condition for all null ends here

        //condition for checking null in selecte field starts here
        if ($request->candidate == null && $request->user_id != null && $request->profile != null && $request->sub_segment != null && $request->app_status != null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment)->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereIn('endorsements.app_status', $request->app_status)->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile != null && $request->sub_segment != null && $request->app_status != null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment)
                ->whereIn('endorsements.app_status', $request->app_status)->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment != null && $request->app_status != null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('candidate_domains.sub_segment', $request->sub_segment)
                ->whereIn('endorsements.app_status', $request->app_status)->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->app_status != null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('endorsements.app_status', $request->app_status)
                ->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->app_status == null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->app_status == null && $request->client == null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata;
        }
        //condition for checking null in selecte field ends here

        // consition for checking null one by one starts here
        if ($request->candidate != null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile != null && $request->sub_segment == null && $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment != null && $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_domains.sub_segment', $request->sub_segment);

        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->app_status != null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('endorsements.app_status', $request->app_status);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->app_status == null && $request->client != null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('endorsements.client', $request->client);

        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->app_status == null && $request->client == null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate != null && $request->user_id == null && $request->profile == null && $request->sub_segment == null && $request->app_status == null && $request->client == null && $request->career_level == null && $request->date != null) {
            $Userdata->whereIn('endorsements.endi_date', $request->date);
        }
        // consition for checking null one by one ends here

        $Alldata = $Userdata->get();
        // return $Alldata;
        $candidates = CandidateInformation::all();
        $count = $Alldata->count();
        // return $count;
        $data = [
            'count' => $count,
            'Userdata' => $Alldata,
        ];
        return view('record.filter-user', $data);
    }
    public function UserDetails(Request $request)
    {
        // return $request->id;
        $user = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->where('candidate_informations.id', $request->id)
            ->first();
        // return $user;
        $data = [
            'user' => $user,
        ];
        return view('record.user_detail', $data);
    }
}
