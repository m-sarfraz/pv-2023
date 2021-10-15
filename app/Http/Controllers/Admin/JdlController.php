<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\CandidateInformation;
use App\Domain;
use App\Endorsement;
use App\Http\Controllers\Controller;
use App\Segment;
use App\SubSegment;
use DB;
use Illuminate\Http\Request;

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

        $Userdata = DB::table('six_table_view')
            ->select(
                'six_table_view.id as cid',
                'six_table_view.address as candidate_address',
                'six_table_view.sub_segment as candidate_sub_segment',
                'six_table_view.segment as candidate_segment',
                'six_table_view.client as endo_client',
                'six_table_view.status as endo_status',
                'six_table_view.position_title as endo_position_title',
                'six_table_view.career_endo as endo_career_endo'
            )
            ->paginate(10);
        // $Userdata = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
        // ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
        // ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
        // ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
        // ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
        // ->select('candidate_educations.*', 'candidate_informations.id as cid', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
        // ->paginate(10);
        $Alldomains = Domain::all();
        $Allsegments = Segment::all();
        $SubSegment = SubSegment::all();

        $data = [
            "Userdata" => $Userdata,
            "Alldomains" => $Alldomains,
            "Allsegments" => $Allsegments,
            "SubSegment" => $SubSegment,
        ];
        return view('JDL.index', $data);
    }
    public function Filter(Request $request)
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
    public function Filter_user_table(Request $request)
    {
        // return $request->all();
        DB::enableQueryLog();
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

        if (isset($request->searchKeyword)) {
            $Userdata->orWhere('endorsements.client', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('candidate_domains.domain', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('candidate_domains.segment', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('candidate_domains.sub_segment', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('endorsements.career_endo', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('endorsements.position_title', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('endorsements.status', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('candidate_informations.address', 'LIKE', '%' . $request->searchKeyword . '%');
        }

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
            $Userdata->where('endorsements.status', $request->status);
        }

        $Userdata = $Userdata->get();
        $count = count($Userdata);
        // dd($Userdata);

        $data = [
            "Userdata" => $Userdata,
            "count" => $count,
        ];
        return view("JDL.Filter_user", $data);
    }
    public function filter_records_jdl_getclient(Request $request)
    {
        // dd($request->all());
        //endorsement .client name
        // candisate domain client domain
        $filter_Client_domain = Endorsement::join("candidate_domains", "endorsements.candidate_id", "candidate_domains.candidate_id")
            ->join("domains", "candidate_domains.domain", "domains.domain_name")
            ->whereIn("endorsements.client", $request->client)
            ->select("candidate_domains.domain", "domains.id as D_id")
            ->groupby("candidate_domains.domain")
            ->get();



        return response()->json($filter_Client_domain);
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
