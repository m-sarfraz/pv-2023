<?php

namespace App\Http\Controllers\Admin;

use App\CandidateDomain;
use App\Domain;
use App\Http\Controllers\Controller;
use App\jdlSheet;
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
        ini_set('max_execution_time', 60000); //300 seconds = 5 minutes
        // dd(phpinfo());

        // join the tables to get candidate data
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $Userdata = DB::table('jdl')
            ->offset($page)->limit($limit)
            ->paginate();
        $Alldomains = DB::table('jdl')->select("domain")->groupby("domain")->get();

        $Allsegments = DB::table('jdl')->select("segment")->groupby("segment")->get();
        $SubSegment = DB::table('jdl')->select("subsegment")->groupby("subsegment")->get();
        $positions = DB::table('jdl')->select("p_title")->groupby("p_title")->get();
        $c_levels = DB::table('jdl')->select("c_level")->groupby("c_level")->get();
        $Location = DB::table('jdl')->select("location")->groupby("location")->get();

        $data = [
            "Userdata" => $Userdata,
            "Alldomains" => $Alldomains,
            "Allsegments" => $Allsegments,
            "SubSegment" => $SubSegment,
            "positions" => $positions,
            "c_levels" => $c_levels,
            "Location" => $Location,
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

        // DB::enableQueryLog();
        $Userdata = DB::table('jdl');

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
        if (isset($request->address)) {
            $Userdata->whereIn('jdl.location', $request->address);
        }
        if (isset($request->status)) {
            $Userdata->where('jdl.status', $request->status);
        }
        if (isset($request->searchKeyword)) {
            ini_set('max_execution_time', 60000); //300 seconds = 5 minutes
            $perfect_match = DB::select(DB::raw('select client,segment,domain,subsegment,c_level,p_title,status,location,budget,w_schedule from jdl'));
          
            foreach ($perfect_match as $match) {
                if ($request->searchKeyword == $match->client) {
                    $Userdata->where('jdl.client', $request->searchKeyword);
                }
                if ($request->searchKeyword == $match->domain) {
                    $Userdata->where('jdl.domain', $request->searchKeyword);
                }
                if ($request->searchKeyword == $match->segment) {
                    $Userdata->where('jdl.segment', $request->searchKeyword);
                }
                if ($request->searchKeyword == $match->subsegment) {
                    $Userdata->where('jdl.subsegment', $request->searchKeyword);
                }
                if ($request->searchKeyword == $match->c_level) {
                    $Userdata->where('jdl.c_level', $request->searchKeyword);
                }
                if ($request->searchKeyword == $match->p_title) {
                    $Userdata->where('jdl.p_title', $request->searchKeyword);
                }

                if ($request->searchKeyword == $match->status) {
                    $Userdata->where('jdl.status', $request->searchKeyword);
                }

                if ($request->searchKeyword == $match->location) {
                    $Userdata->where('jdl.location', $request->searchKeyword);
                }
                if ($request->searchKeyword == $match->budget) {
                    $Userdata->where('jdl.budget', $request->searchKeyword);
                }
                if ($request->searchKeyword == $match->w_schedule) {
                    $Userdata->where('jdl.w_schedule', $request->searchKeyword);
                }

            }

        }
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $dataJdl = $Userdata->groupBy("jdl.id")->offset($page)->limit($limit)
            ->paginate();
        $count = count($dataJdl);
        // dd($Userdata);

        $data = [
            "Userdata" => $dataJdl,
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

            $filter_Client_domain = DB::table('jdl')->where("client", $request->client)->groupby("domain")->get();
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
