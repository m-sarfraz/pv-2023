<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CandidateDomain;
use App\CandidateEducation;
use App\CandidateInformation;
use App\CandidatePosition;
use App\Domain;
use App\Endorsement;
use App\Segment;
use App\SubSegment;
use App\User;
use Helper;

class JdlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // join the tables to get ccandidate data

        $Userdata = CandidateInformation::join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->select(
                'candidate_informations.id as cid',
                'candidate_informations.address as candidate_address',
                'candidate_domains.sub_segment as candidate_sub_segment',
                'candidate_domains.segment as candidate_segment',
                'endorsements.client as endo_client',
                'endorsements.status as endo_status',
                'endorsements.position_title as endo_position_title',
                'endorsements.career_endo as endo_career_endo'
            )
            ->paginate(10);
        // $Userdata = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
        // ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
        // ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
        // ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
        // ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
        // ->select('candidate_educations.*', 'candidate_informations.id as cid', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
        // ->paginate(10);
        $data = [
            "Userdata" => $Userdata,
        ];
        return view('JDL.index', $data);
    }
    function Filter(Request $request)
    {

        // return $request->id;
        $user = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.*', 'candidate_informations.id as cid', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->where('candidate_informations.id', $request->id)
            ->first();
        // dd($user);
        $domainDrop = Domain::all();

        $data = [
            'user' => $user,

        ];
        return view('JDL.Filter', $data);
    }
    function Filter_user_table(Request $request)
    {

        $Userdata = CandidateInformation::join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
        ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
        ->select(
            'candidate_informations.id as cid',
            'candidate_informations.address as candidate_address',
            'candidate_domains.sub_segment as candidate_sub_segment',
            'candidate_domains.segment as candidate_segment',
            'endorsements.client as endo_client',
            'endorsements.status as endo_status',
            'endorsements.position_title as endo_position_title',
            'endorsements.career_endo as endo_career_endo'
        );
       
        if (isset($request->client)) {
            $Userdata->whereIn('endorsements.client', $request->client);
        }
        if (isset($request->candidateDomain)) {
            $Userdata->whereIn('candidate_domains.domain', $request->candidateDomain);
        }
        if (isset($request->segment)) {
            $Userdata->whereIn('candidate_domains.segment', $request->segment);
        }
        if (isset($request->sub_segment)) {
            $Userdata->whereIn('candidate_domains.sub_segment', $request->sub_segment);
        }
        if (isset($request->position_title)) {
            $Userdata->whereIn('endorsements.position_title', $request->position_title);
        }
        if (isset($request->career_level)) {
            $Userdata->whereIn('endorsements.career_endo', $request->career_level);
        }
        // if (isset($request->address)) {
        //     $Userdata->whereIn('candidate_domains.location', $request->address);
        // }
        if (isset($request->status)) {
            $Userdata->whereIn('endorsements.status', $request->status);
        }

        $Userdata = $Userdata->get();
        $count = count($Userdata);

        $data = [
            "Userdata" => $Userdata,
            "count" => $count,
        ];
        return view("JDL.Filter_user", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
