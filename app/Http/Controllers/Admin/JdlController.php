<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\Endorsement;
use App\Http\Controllers\Controller;
use App\Segment;
use App\SubSegment;
use carbon\carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;

class JdlController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:view-jdl', ['only' => ['index']]);
        // $this->middleware('permission:can-view-jdl-detail', ['only' => ['Filter']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('JDL.index');
    }
    public function view_jdl_table()
    {
        $now = \Carbon\Carbon::now();
        ini_set('max_execution_time', -1); //30000 seconds = 500 minutes
        ini_set('memory_limit', '1000M'); //1000M  = 1 GB
        if (Cache::has('jdl')) {
            $jdlData = Cache::get('jdl');
        } else {
            $jdlData = DB::table('jdl')->get();
            Cache::put('jdl', $jdlData, $now->addMonth(1));
        }
        return Datatables::of($jdlData)
        ->addColumn('id', function ($jdlData) {
            return $jdlData->id;
        })
            ->addIndexColumn()
            ->addColumn('priority', function ($jdlData) {
                return $jdlData->priority;
            })
            ->addColumn('keyword', function ($jdlData) {
                return $jdlData->keyword;
            })
            ->addColumn('status', function ($jdlData) {
                return $jdlData->status;
            })

            ->addColumn('client', function ($jdlData) {
                return $jdlData->client;
            })
            ->addColumn('domain', function ($jdlData) {
                return $jdlData->domain;
            })
            ->addColumn('segment', function ($jdlData) {
                return $jdlData->segment;
            })
            ->addColumn('subsegment', function ($jdlData) {
                return $jdlData->subsegment;
            })
            ->addColumn('p_title', function ($jdlData) {
                return $jdlData->p_title;
            })
            ->addColumn('c_level', function ($jdlData) {
                return $jdlData->c_level;
            })

            ->addColumn('jd', function ($jdlData) {
                return $jdlData->jd;
            })
            ->addColumn('edu_attainment', function ($jdlData) {
                return $jdlData->edu_attainment;
            })
            ->addColumn('location', function ($jdlData) {
                return $jdlData->location;
            })
            ->addColumn('w_schedule', function ($jdlData) {
                return $jdlData->w_schedule;
            })
            ->addColumn('budget', function ($jdlData) {
                return $jdlData->budget;
            })
            ->addColumn('poc', function ($jdlData) {
                return $jdlData->poc;
            })
            ->addColumn('note', function ($jdlData) {
                return $jdlData->note;
            })
            ->addColumn('start_date', function ($jdlData) {
                return $jdlData->start_date;
            })
            ->addColumn('sll_no', function ($jdlData) {
                return $jdlData->sll_no;
            })

            ->addColumn('t_fte', function ($jdlData) {
                return $jdlData->t_fte;
            })
            ->addColumn('updated_fte', function ($jdlData) {
                return $jdlData->updated_fte;
            })
            ->addColumn('ref_code', function ($jdlData) {
                return $jdlData->ref_code;
            })

            ->addColumn('req_date', function ($jdlData) {
                return $jdlData->req_date;
            })
            ->addColumn('maturity', function ($jdlData) {
                $maturityDate = $jdlData->maturity;
                $date = Carbon::parse($jdlData->req_date);
                $curren_date = Carbon::now();
                $maturityDate = $date->diffInDays($curren_date);
                return $maturityDate;
            })
            ->addColumn('updated_date', function ($jdlData) {
                return $jdlData->updated_date;
            })
            ->addColumn('closed_date', function ($jdlData) {
                return $jdlData->closed_date;
            })

            ->addColumn('os_date', function ($jdlData) {
                return $jdlData->os_date;
            })
            ->addColumn('recruiter', function ($jdlData) {
                return $jdlData->recruiter;
            })

            ->rawColumns([
                'budget',
                'c_level',
                'client',
                'domain',
                'jd',
                'poc',
                'keyword',
                'location',
                'note',
                'p_title',
                'edu_attainment',
                'priority',
                'segment',
                'sll_no',
                'start_date',
                'status',
                'subsegment',
                'w_schedule',
                'maturity',
                't_fte',
                'updated_fte',
                'ref_code',
                'req_date',
                'updated_date',
                'closed_date',
                'os_date',
                'recruiter',
            ])
            ->make(true);
    }
    public function append_filter_data(Request $request)
    {
        $user = DB::table('jdl')->where('jdl.client', $request->client)
            ->get();
        return response()->json($user);
    }
    public function Filter(Request $request)
    {

        // return $request->id;
        $user = DB::table('jdl')->where('jdl.id', $request->id)
            ->first();
        $endorsmentCount = Endorsement::where('client', $user->client)
            ->where('position_title', $user->p_title)->where('career_endo', $user->c_level)
            ->count();
        $domainDrop = Domain::all();

        $data = [
            'user' => $user,
            'endorsmentCount' => $endorsmentCount,

        ];
        return view('JDL.Filter', $data);
    }
    public function Filter_user_table(Request $request)
    {
        //     $check = $searchCheck = false;
        //     // DB::enableQueryLog();

        //     $Userdata = DB::table('jdl');

        //     if (isset($request->client)) {
        //         $Userdata->whereIn('jdl.client', $request->client);
        //     }
        //     if (isset($request->candidateDomain)) {
        //         $Userdata->whereIn('jdl.domain', $request->candidateDomain);
        //     }
        //     if (isset($request->segment)) {
        //         $Userdata->whereIn('jdl.segment', $request->segment);
        //     }
        //     if (isset($request->sub_segment)) {
        //         $Userdata->whereIn('jdl.subsegment', $request->sub_segment);
        //     }
        //     if (isset($request->position_title)) {
        //         $Userdata->whereIn('jdl.p_title', $request->position_title);
        //     }
        //     if (isset($request->career_level)) {
        //         $Userdata->whereIn('jdl.c_level', $request->career_level);
        //     }
        //     if (isset($request->address)) {
        //         $Userdata->whereIn('jdl.location', $request->address);
        //     }
        //     if (isset($request->status)) {
        //         $Userdata->where('jdl.status', $request->status);
        //     }
        //     if (isset($request->searchKeyword)) {
        //         ini_set('max_execution_time', 60000); //300 seconds = 5 minutes
        //         $searchCheck = true;
        //         $perfect_match = DB::select(DB::raw('select client,domain,segment,subsegment,p_title,c_level,status,location,budget,w_schedule from jdl'));
        //         foreach ($perfect_match as $match) {

        //             if (strpos(strtolower($match->client), strtolower($request->searchKeyword)) !== false) {
        //                 $check = true;
        //                 //    return $match->client;
        //                 $Userdata->where('jdl.client', 'like', '%' . strtolower($request->searchKeyword) . '%');
        //             }

        //             if (strpos(strtolower($match->domain), strtolower($request->searchKeyword)) !== false) {
        //                 $check = true;

        //                 $Userdata->where('jdl.domain', 'like', '%' . strtolower($request->searchKeyword) . '%');
        //             }
        //             if (strpos(strtolower($match->segment), strtolower($request->searchKeyword)) !== false) {
        //                 $check = true;

        //                 $Userdata->where('jdl.segment', 'like', '%' . $request->searchKeyword . '%');
        //             }
        //             if (strpos(strtolower($match->subsegment), strtolower($request->searchKeyword)) !== false) {
        //                 $check = true;
        //                 $Userdata->where('jdl.subsegment', 'like', '%' . $request->searchKeyword . '%');
        //             }
        //             if (strpos(strtolower($match->c_level), strtolower($request->searchKeyword)) !== false) {
        //                 $check = true;
        //                 $Userdata->where('jdl.c_level', 'like', '%' . $request->searchKeyword . '%');
        //             }
        //             if (strpos(strtolower($match->p_title), strtolower($request->searchKeyword)) !== false) {
        //                 $check = true;
        //                 $Userdata->where('jdl.p_title', 'like', '%' . $request->searchKeyword . '%');
        //             }

        //             if (strpos(strtolower($match->status), strtolower($request->searchKeyword)) !== false) {
        //                 $check = true;
        //                 $Userdata->where('jdl.status', 'like', '%' . $request->searchKeyword . '%');
        //             }

        //             if (strpos(strtolower($match->location), strtolower($request->searchKeyword)) !== false) {
        //                 $check = true;
        //                 if (strtolower($request->searchKeyword) == strtolower($match->client)) {
        //                     break;
        //                 } else {

        //                     $Userdata->where('jdl.location', 'like', '%' . $request->searchKeyword . ' %');
        //                 }
        //             }
        //             if (strpos(strtolower($match->budget), strtolower($request->searchKeyword)) !== false) {
        //                 $check = true;
        //                 $Userdata->where('jdl.budget', 'like', '%' . $request->searchKeyword . '%');
        //             }
        //             if (strpos(strtolower($match->w_schedule), strtolower($request->searchKeyword)) !== false) {
        //                 $check = true;
        //                 $Userdata->where('jdl.w_schedule', 'like', '%' . $request->searchKeyword . '%');
        //             }
        //         }
        //     }
        //     if ($check) {

        //         $dataJdl = $Userdata->get();
        //     } else {
        //         if (!$check && !$searchCheck) {
        //             $dataJdl = $Userdata->get();

        //         } else {

        //             $dataJdl = [];

        //         }
        //     }
        //     $count = count($dataJdl);

        //     if ($count < 1) {
        //         return response()->json(['sms' => 'no record fond', 'count' => $count]);
        //     }
        $data = [
            // "Userdata" => $dataJdl,
            "count" => 11,
        ];

        return view("JDL.Filter_user", $data);
    }
    public function view_jdl_filter_table(Request $request)
    {
        $check = $searchCheck = false;
        // DB::enableQueryLog();
        // return $request->all();
        ini_set('memory_limit', '1000M'); //1000M  = 1 GB
        ini_set('max_execution_time', -1); //30000 seconds = 500 minutes

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
            $status = explode(',', $request->status);
            $Userdata->whereIn('jdl.status', $status);
        }
        $dataJdl = $Userdata;
        return Datatables::of($dataJdl)
        ->addColumn('id', function ($dataJdl) {
            return $dataJdl->id;
        })
            ->addIndexColumn()
            ->addColumn('priority', function ($dataJdl) {
                return $dataJdl->priority;
            })
            ->addColumn('keyword', function ($dataJdl) {
                return $dataJdl->keyword;
            })
            ->addColumn('status', function ($dataJdl) {
                return $dataJdl->status;
            })

            ->addColumn('client', function ($dataJdl) {
                return $dataJdl->client;
            })
            ->addColumn('domain', function ($dataJdl) {
                return $dataJdl->domain;
            })
            ->addColumn('segment', function ($dataJdl) {
                return $dataJdl->segment;
            })
            ->addColumn('subsegment', function ($dataJdl) {
                return $dataJdl->subsegment;
            })
            ->addColumn('p_title', function ($dataJdl) {
                return $dataJdl->p_title;
            })
            ->addColumn('c_level', function ($dataJdl) {
                return $dataJdl->c_level;
            })

            ->addColumn('jd', function ($dataJdl) {
                return $dataJdl->jd;
            })
            ->addColumn('edu_attainment', function ($dataJdl) {
                return $dataJdl->edu_attainment;
            })
            ->addColumn('location', function ($dataJdl) {
                return $dataJdl->location;
            })
            ->addColumn('w_schedule', function ($dataJdl) {
                return $dataJdl->w_schedule;
            })
            ->addColumn('budget', function ($dataJdl) {
                return $dataJdl->budget;
            })
            ->addColumn('poc', function ($dataJdl) {
                return $dataJdl->poc;
            })
            ->addColumn('note', function ($dataJdl) {
                return $dataJdl->note;
            })
            ->addColumn('start_date', function ($dataJdl) {
                return $dataJdl->start_date;
            })
            ->addColumn('sll_no', function ($dataJdl) {
                return $dataJdl->sll_no;
            })

            ->addColumn('t_fte', function ($dataJdl) {
                return $dataJdl->t_fte;
            })
            ->addColumn('updated_fte', function ($dataJdl) {
                return $dataJdl->updated_fte;
            })
            ->addColumn('ref_code', function ($dataJdl) {
                return $dataJdl->ref_code;
            })

            ->addColumn('req_date', function ($dataJdl) {
                return $dataJdl->req_date;
            })
            ->addColumn('maturity', function ($dataJdl) {
                $maturityDate = $dataJdl->maturity;
                $date = Carbon::parse($dataJdl->req_date);
                $curren_date = Carbon::now();
                $maturityDate = $date->diffInDays($curren_date);
                return $maturityDate;
            })
            ->addColumn('updated_date', function ($dataJdl) {
                return $dataJdl->updated_date;
            })
            ->addColumn('closed_date', function ($dataJdl) {
                return $dataJdl->closed_date;
            })

            ->addColumn('os_date', function ($dataJdl) {
                return $dataJdl->os_date;
            })
            ->addColumn('recruiter', function ($dataJdl) {
                return $dataJdl->recruiter;
            })
            ->with([
                'search' => $request->searchKeyword,
            ])
            ->rawColumns([
                'budget',
                'c_level',
                'client',
                'domain',
                'jd',
                'poc',
                'keyword',
                'location',
                'note',
                'p_title',
                'edu_attainment',
                'priority',
                'segment',
                'sll_no',
                'start_date',
                'status',
                'subsegment',
                'w_schedule',
                'maturity',
                't_fte',
                'updated_fte',
                'ref_code',
                'req_date',
                'updated_date',
                'closed_date',
                'os_date',
                'recruiter',
            ])
            ->make(true); 
    }
    public function filter_records_jdl_getclient(Request $request)
    {
        // dd($request->all());
        //endorsement .client name
        // candisate domain client domain
        $filter_Client_domain = [];
        $return = [];
        if ($request->client) {
            $filter_Client_domain = DB::select('SELECT DISTINCT segment FROM `jdl` WHERE client=' . $request->client . '');

            $filter_Client_segment = DB::table('jdl')->where("client", $request->client)->groupby("client")->get("segment")->toArray();
            $filter_Client_sub_segment = DB::table('jdl')->where("client", $request->client)->groupby("client")->get("subsegment")->toArray();
            $filter_Client_postion = DB::table('jdl')->where("client", $request->client)->groupby("client")->get("p_title")->toArray();
            // $filter_Client_domain = DB::table('jdl')->where("client", $request->client)->groupby("client")->get("domain");
            // $filter_Client_domain = DB::table('jdl')->where("client", $request->client)->groupby("client")->get("domain");
            // $filter_Client_domain = DB::table('jdl')->where("client", $request->client)->groupby("client")->get("domain");
        } else {
            $filter_Client_domain == null;
        }

        return response()->json(['data' => [
            "domain" => $filter_Client_domain,
            "segment" => array_unique($filter_Client_segment),
            "sub_segment" => array_unique($filter_Client_sub_segment),
            "position" => array_unique($filter_Client_postion),
            "return" => $return,
        ]]);
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
    public function appendJdlOptions()
    {
        $domains = DB::table('jdl')->select("domain")->groupby("domain")->get();
        $segment = DB::table('jdl')->select("segment")->groupby("segment")->get();
        $subSegment = DB::table('jdl')->select("subsegment")->groupby("subsegment")->get();
        $position_title = DB::table('jdl')->select("p_title")->groupby("p_title")->get();
        $career_level = DB::table('jdl')->select("c_level")->groupby("c_level")->get();
        $location = DB::table('jdl')->select("location")->groupby("location")->get();
        $client = DB::table('jdl')->select("client")->groupby("client")->get();
        return response()->json([
            'domains' => $domains,
            'segment' => $segment,
            'subSegment' => $subSegment,
            'position_title' => $position_title,
            'career_level' => $career_level,
            'location' => $location,
            'client' => $client,
        ]);
    }
}
