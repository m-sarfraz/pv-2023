<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\Http\Controllers\Controller;
use App\Segment;
use App\SubSegment;
use DB;
use Illuminate\Http\Request;
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
        ini_set('max_execution_time', 60000); //300 seconds = 5 minutes
        // dd(phpinfo());

        // join the tables to get candidate data
        // $page = $request->has('page') ? $request->get('page') : 1;
        // $limit = $request->has('limit') ? $request->get('limit') : 10;
        // $Userdata = DB::table('jdl')
        //     ->offset($page)->limit($limit)
        //     ->paginate();
        $Alldomains = DB::table('jdl')->select("domain")->groupby("domain")->get();

        $Allsegments = DB::table('jdl')->select("segment")->groupby("segment")->get();
        $SubSegment = DB::table('jdl')->select("subsegment")->groupby("subsegment")->get();
        $positions = DB::table('jdl')->select("p_title")->groupby("p_title")->get();
        $c_levels = DB::table('jdl')->select("c_level")->groupby("c_level")->get();
        $Location = DB::table('jdl')->select("location")->groupby("location")->get();
        $AllData = 3530;
        $data = [
            // "Userdata" => $Userdata,
            "Alldomains" => $Alldomains,
            "Allsegments" => $Allsegments,
            "SubSegment" => $SubSegment,
            "positions" => $positions,
            "c_levels" => $c_levels,
            "Location" => $Location,
            "AllData" => $AllData,
        ];
        return view('JDL.index', $data);
    }
    public function view_jdl_table()
    {

        $Userdata = DB::table('jdl')->get();
        return Datatables::of($Userdata)
            ->addIndexColumn()
            ->addColumn('id', function ($Userdata) {
                return $Userdata->id;
            })
            ->addColumn('client', function ($Userdata) {
                return $Userdata->client;
            })

            ->addColumn('segment', function ($Userdata) {
                return $Userdata->segment;
            })
            ->addColumn('subsegment', function ($Userdata) {
                return $Userdata->subsegment;
            })

            ->addColumn('c_level', function ($Userdata) {
                return $Userdata->c_level;
            })
            ->addColumn('p_title', function ($Userdata) {
                return $Userdata->p_title;
            })
            ->addColumn('maturity', function ($Userdata) {
                return $Userdata->maturity;
            })
            ->addColumn('budget', function ($Userdata) {
                return $Userdata->budget;
            })
            ->addColumn('location', function ($Userdata) {
                return $Userdata->location;
            })
            ->addColumn('w_schedule', function ($Userdata) {
                return $Userdata->w_schedule;
            })
            ->addColumn('status', function ($Userdata) {
                return $Userdata->status;
            })
            ->addColumn('priority', function ($Userdata) {
                return $Userdata->priority;
            })
            ->rawColumns(['id', 'client', 'segment', 'subsegment', 'c_level', 'p_title', 'maturity', 'budget',
                'location', 'w_schedule', 'status', 'priority'])
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
        // dd($user);
        $domainDrop = Domain::all();

        $data = [
            'user' => $user,

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
            $searchCheck = true;
            $perfect_match = DB::select(DB::raw('select client,domain,segment,subsegment,p_title,c_level,status,location,budget,w_schedule from jdl'));
            foreach ($perfect_match as $match) {

                if (strpos(strtolower($match->client), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    //    return $match->client;
                    $Userdata->where('jdl.client', 'like', '%' . strtolower($request->searchKeyword) . '%');
                }

                if (strpos(strtolower($match->domain), strtolower($request->searchKeyword)) !== false) {
                    $check = true;

                    $Userdata->where('jdl.domain', 'like', '%' . strtolower($request->searchKeyword) . '%');
                }
                if (strpos(strtolower($match->segment), strtolower($request->searchKeyword)) !== false) {
                    $check = true;

                    $Userdata->where('jdl.segment', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->subsegment), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('jdl.subsegment', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->c_level), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('jdl.c_level', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->p_title), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('jdl.p_title', 'like', '%' . $request->searchKeyword . '%');
                }

                if (strpos(strtolower($match->status), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('jdl.status', 'like', '%' . $request->searchKeyword . '%');
                }

                if (strpos(strtolower($match->location), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    if (strtolower($request->searchKeyword) == strtolower($match->client)) {
                        break;
                    } else {

                        $Userdata->where('jdl.location', 'like', '%' . $request->searchKeyword . ' %');
                    }
                }
                if (strpos(strtolower($match->budget), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('jdl.budget', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->w_schedule), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('jdl.w_schedule', 'like', '%' . $request->searchKeyword . '%');
                }
            }
        }
        if ($check) {

            $dataJdl = $Userdata->get();
        } else {
            if (!$check && !$searchCheck) {
                $dataJdl = $Userdata->get();

            } else {

                $dataJdl = [];

            }
        }
        $count = count($dataJdl);
        return Datatables::of($dataJdl)
            ->addIndexColumn()
            ->addColumn('id', function ($dataJdl) {
                return $dataJdl->id;
            })
            ->addColumn('client', function ($dataJdl) {
                return $dataJdl->client;
            })

            ->addColumn('segment', function ($dataJdl) {
                return $dataJdl->segment;
            })
            ->addColumn('subsegment', function ($dataJdl) {
                return $dataJdl->subsegment;
            })

            ->addColumn('c_level', function ($dataJdl) {
                return $dataJdl->c_level;
            })
            ->addColumn('p_title', function ($dataJdl) {
                return $dataJdl->p_title;
            })
            ->addColumn('maturity', function ($dataJdl) {
                return $dataJdl->maturity;
            })
            ->addColumn('budget', function ($dataJdl) {
                return $dataJdl->budget;
            })
            ->addColumn('location', function ($dataJdl) {
                return $dataJdl->location;
            })
            ->addColumn('w_schedule', function ($dataJdl) {
                return $dataJdl->w_schedule;
            })
            ->addColumn('status', function ($dataJdl) {
                return $dataJdl->status;
            })
            ->addColumn('priority', function ($dataJdl) {
                return $dataJdl->priority;
            })
            ->rawColumns(['id', 'client', 'segment', 'subsegment', 'c_level', 'p_title', 'maturity', 'budget',
                'location', 'w_schedule', 'status', 'priority'])
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
}
