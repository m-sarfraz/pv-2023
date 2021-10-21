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
    public function index(Request $request)
    {
        // join the tables to get ccandidate data
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $Userdata = DB::table('jdl')
        ->offset($page)->limit($limit)
        ->paginate();
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
        $user = DB::table('jdl')->where('jdl.id', $request->id)
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
       
        DB::enableQueryLog();
        $Userdata = DB::table('jdl');

        if (isset($request->searchKeyword)) {
            $Userdata->orWhere('jdl.client', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('jdl.domain', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('jdl.segment', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('jdl.subsegment', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('jdl.c_level', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('jdl.p_title', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('jdl.status', 'LIKE', '%' . $request->searchKeyword . '%');
            $Userdata->orWhere('jdl.location', 'LIKE', '%' . $request->searchKeyword . '%');
        }

        if (isset($request->client)) {
            $Userdata->whereIn('jdl.client', $request->client);
        }
        if (isset($request->candidateDomain)) {
            $Userdata->whereIn('jdl.domain', $request->candidateDomain);
        }
        if (isset($request->segment)) {
            $Userdata->whereIn('jdl.segment', $request->segment);
        }
        if (isset($request->sub_segment)) {
            $Userdata->whereIn('jdl.subsegment', $request->sub_segment);
        }
        if (isset($request->position_title)) {
            $Userdata->whereIn('jdl.p_title', $request->position_title);
        }
        if (isset($request->career_level)) {
            $Userdata->whereIn('jdl.c_level', $request->career_level);
        }
        // if (isset($request->address)) {
        //     $Userdata->whereIn('candidate_domains.location', $request->address);
        // }
        if (isset($request->status)) {
            $Userdata->where('jdl.status', $request->status);
        }
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $Userdata = $Userdata->offset($page)->limit($limit)
            ->paginate();
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
        $filter_Client_domain = [];
        if ($request->client) {

            $filter_Client_domain = DB::table('jdl')->where("client",$request->client)->groupby("domain")->get();
        } else {
            $filter_Client_domain == null;
        }

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
