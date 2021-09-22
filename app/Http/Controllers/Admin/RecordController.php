<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Domain;
use App\Endorsement;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    // index function for showing the record of users with filters starts
    public function index()
    {
        // get recruiter data
        $user = User::where('type', 3)->get();

        // join the tables to get ccandidate data
        $Userdata = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.id as cid', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->paginate(3);

        // get required data to use for select purpose
        $count = $Userdata->count();
        $candidates = CandidateInformation::all();
        $candidatess = CandidateInformation::paginate(1);
        $links = str_replace('/?', '?', $Userdata->render());
        $candidateprofile = CandidatePosition::all();
        $candidateDomain = CandidateDomain::all();
        $endorsement = Endorsement::all();

        // make array of data to pas to view
        $data = [
            'user' => $user,
            'candidates' => $candidates,
            'count' => $count,
            'Userdata' => $Userdata,
            'candidateprofile' => $candidateprofile,
            'candidateDomain' => $candidateDomain,
            'candidatess' => $candidatess,
            'endorsement' => $endorsement,
        ];
        return view('record.view_record', $data);
    }
    // index function for showing the record of users with filters ends

    // function for appending the resulting view to filtered record starts
    public function filter(Request $request)
    {

        // dd($request->search);
        $Userdata = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as CID', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*');

        // condition for checking first to end not null starts here
        if ($request->candidate == null && $request->user_id != null && $request->profile == null && $request->sub_segment == null && $request->client == null && $request->app_status == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.saved_by', $request->user_id);
        }

        if ($request->candidate != null && $request->user_id != null && $request->profile == null && $request->sub_segment == null && $request->client == null && $request->app_status == null && $request->career_level == null && $request->date == null) {
            // dd('ji');
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
        if ($request->candidate != null && $request->user_id != null && $request->profile != null && $request->sub_segment != null && $request->app_status != null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate)->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('endorsements.career_endo', $request->career_level)
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
        if ($request->candidate == null && $request->user_id != null && $request->profile != null && $request->sub_segment != null &&
            $request->app_status != null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment)->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereIn('endorsements.app_status', $request->app_status)->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile != null && $request->sub_segment != null &&
            $request->app_status != null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile)

                ->whereIn('candidate_domains.sub_segment', $request->sub_segment)
                ->whereIn('endorsements.app_status', $request->app_status)->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment != null &&
            $request->app_status != null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('candidate_domains.sub_segment', $request->sub_segment)
                ->whereIn('endorsements.app_status', $request->app_status)->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status != null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('endorsements.app_status', $request->app_status)
                ->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata;
        }
        //condition for checking null in selecte field ends here

        // condition for checking null one by one starts here
        if ($request->candidate != null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.id', $request->candidate);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile != null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment != null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_domains.sub_segment', $request->sub_segment);

        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status != null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('endorsements.app_status', $request->app_status);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client != null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('endorsements.client', $request->client);

        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate != null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date != null) {

            $time = strtotime($request->date);
            $newformat = date('Y-m-d', $time);
            $Userdata-- > whereDate('endorsements.endi_date', '<', $newformat);
        }
        // condition for checking null one by one ends here

        // custom condition for checking the null values if profile is not null select starts here
        if ($request->candidate == null && $request->user_id == null && $request->profile != null && $request->sub_segment != null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile != null && $request->sub_segment == null &&
            $request->app_status != null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('endorsements.app_status', $request->app_status);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile != null && $request->sub_segment == null &&
            $request->app_status == null && $request->client != null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('endorsements.client', $request->client);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile != null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile != null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date != null) {
            $time = strtotime($request->date);
            $newformat = date('Y-m-d', $time);
            $Userdata->whereIn('candidate_positions.candidate_profile', $request->profile)
                ->whereDate('endorsements.endi_date', '<', $newformat);
        }
        // custom condition for checking the null values if profile is not null select starts here

        // custom condition for checking all not null if sub segment is not null starts
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment != null &&
            $request->app_status != null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_domains.sub_segment', $request->sub_segment)
                ->whereIn('endorsements.app_status', $request->app_status);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment != null &&
            $request->app_status == null && $request->client != null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_domains.sub_segment', $request->sub_segment)
                ->whereIn('endorsements.client', $request->client);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment != null &&
            $request->app_status == null && $request->client == null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('candidate_domains.sub_segment', $request->sub_segment)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment != null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date != null) {
            $time = strtotime($request->date);
            $newformat = date('Y-m-d', $time);
            $Userdata->whereIn('candidate_domains.sub_segment', $request->sub_segment)
                ->whereDate('endorsements.endi_date', '<', $newformat);
        }
        // custom condition for checking all not null if sub segment is not null ends

        // custom condition for checking not null app_status with other not null starts
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status != null && $request->client != null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('endorsements.app_status', $request->app_status)
                ->whereIn('endorsements.client', $request->client);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status != null && $request->client != null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('endorsements.app_status', $request->app_status)
                ->whereIn('endorsements.client', $request->client);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status != null && $request->client == null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('endorsements.app_status', $request->app_status)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status != null && $request->client == null && $request->career_level == null && $request->date != null) {
            $time = strtotime($request->date);
            $newformat = date('Y-m-d', $time);
            $Userdata->whereIn('endorsements.app_status', $request->app_status)
                ->whereDate('endorsements.endi_date', '<', $newformat);
        }
        // custom condition for checking not null app_status with other not null ends

        // custom condition for checking not null client with other not null starts
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client != null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('endorsements.client', $request->client)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client != null && $request->career_level == null && $request->date != null) {
            $time = strtotime($request->date);
            $newformat = date('Y-m-d', $time);
            $Userdata->whereIn('endorsements.client', $request->client)
                ->whereDate('endorsements.endi_date', '<', $newformat);
        }
        // custom condition for checking not null client with other not null ends

        // custom condition for checking not null carer level with other not null starts
        if ($request->candidate == null && $request->user_id == null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level != null && $request->date != null) {
            $time = strtotime($request->date);
            $newformat = date('Y-m-d', $time);
            $Userdata->whereIn('endorsements.career_endo', $request->career_level)
                ->whereDate('endorsements.endi_date', '<', $newformat);
        }
        // custom condition for checking not null carer level with other not null ends

        // Custom condition if user id not null with all other select starts
        if ($request->candidate == null && $request->user_id != null && $request->profile != null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereIn('candidate_positions.candidate_profile', $request->profile);
        }
        if ($request->candidate == null && $request->user_id != null && $request->profile == null && $request->sub_segment != null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereIn('candidate_domains.sub_segment', $request->sub_segment);
        }
        if ($request->candidate == null && $request->user_id != null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status != null && $request->client == null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereIn('endorsements.app_status', $request->app_status);
        }
        if ($request->candidate == null && $request->user_id != null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client != null && $request->career_level == null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereIn('endorsements.client', $request->client);
        }
        if ($request->candidate == null && $request->user_id != null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level != null && $request->date == null) {
            $Userdata->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereIn('endorsements.career_endo', $request->career_level);
        }
        if ($request->candidate == null && $request->user_id != null && $request->profile == null && $request->sub_segment == null &&
            $request->app_status == null && $request->client == null && $request->career_level == null && $request->date != null) {
            $time = strtotime($request->date);
            $newformat = date('Y-m-d', $time);
            $Userdata->whereIn('candidate_informations.saved_by', $request->user_id)
                ->whereDate('endorsements.endi_date', '<', $newformat);
        }
        // Custom condition if user id not null with all other select ends

        // condiiton for one null with all other starts

        // condiiton for one null with all other ends
        $Alldata = $Userdata->where('candidate_informations.first_name', 'like', '%' . $request->search . '%')
        //     ->where('candidate_positions.candidate_profile', 'like', '%' . $request->search . '%')
        //     ->where('endorsements.career_endo', 'like', '%' . $request->search . '%')
        // // ->where('candidate_domains.sub_segment', 'like', '%' . $request->search . '%')
        //     ->where('endorsements.app_status', 'like', '%' . $request->search . '%')
        // ->orWhere('endorsements.client', 'like', '%' . $request->search . '%')
        // ->orWhere('candidate_positions.curr_salary', 'like', '%' . $request->search . '%')
        // ->orWhere('candidate_positions.exp_salary', 'like', '%' . $request->search . '%')
            ->get();
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
    // function for appending the resulting view to filtered record ends

    // function for appending the data of selected row candidate starts
    public function UserDetails(Request $request)
    {
        // return $request->id;
        $user = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as cid', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->where('candidate_informations.id', $request->id)
            ->first();
        // return $user;

        $domainDrop = Domain::all();

        $data = [
            'user' => $user,
            'domainDrop' => $domainDrop,
        ];
        return view('record.user_detail', $data);
    }
    // function for appending the data of selected row candidate ends

    public function updateDetails(Request $request)
    {
        return $request->id;
    }
}
