<?php

namespace App\Http\Controllers\Admin;

use App\ClientManagement;
use App\Domain;
use App\Endorsement;
use App\Http\Controllers\Controller;
use App\JDL;
use App\PositionData;
use App\Segment;
use App\SubSegment;
use carbon\carbon;
use DB;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;
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
    public function view_jdl_table(Request $request)
    {

        ini_set('max_execution_time', -1); //30000 seconds = 500 minutes
        ini_set('memory_limit', '1000M'); //1000M  = 1 GB
        $jdlData = DB::table('jdl');
        if ($request->search['value'] != '') {
            $columnArray = ['id', 'priority', 'ref_code', 'status', 'req_date', 'maturity', 'updated_date', 'closed_date', 'os_date', 'client', 'domain', 'segment', 'subsegment', 'p_title', 'c_level', 'sll_no', 't_fte', 'updated_fte', 'edu_attainment', 'jd', 'location', 'w_schedule', 'budget', 'poc', 'note', 'start_date', 'keyword', 'recruiter', 'assignment', 'classification', 'req_classification', 'client_classification', 'client_spiel', 'req_id', 'numberOfActive', 'numberOfInactive'];

            foreach ($columnArray as $value) {
                $search = "%" . $request->search['value'] . "%";
                $jdlData->orWhere($value, 'like', "'$search'");
            }
            $sqlQuery = Str::replaceArray('?', $jdlData->getBindings(), $jdlData->toSql());
            $result = DB::select($sqlQuery);
            $totalCount = count($result);
            $jdlData = $result;
        } else {
            $totalCount = ($jdlData->count());
        }

        return Datatables::of($jdlData)
            ->addColumn('id', function ($jdlData) {
                return $jdlData->id;
            })
            ->addIndexColumn()
            ->addColumn('action', function ($jdlData) {
                $b = '<input class="selectCheckBox" type="checkbox" value="' . $jdlData->id . '" onclick="selectDataForBulkUpdate(' . $jdlData->id . ')" />';
                return $b;
            })
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
            ->with([
                'totalCount' => $totalCount,
            ])
            ->rawColumns([
                'budget',
                'action',
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
    public function Filter(Request $request, $id)
    {

        $user = DB::table('jdl')->where('jdl.id', $id)
            ->first();
        $activeEndorsmentCount = Endorsement::where('client', $user->client)
            ->where('position_title', $user->p_title)->where('career_endo', $user->c_level)->where('category', 'LIKE', 'active%')
            ->count();
        $inActiveEndorsmentCount = Endorsement::where('client', $user->client)
            ->where('position_title', $user->p_title)->where('career_endo', $user->c_level)->where('category', 'LIKE', 'Inactive%')
            ->count();
        $domainDrop = Domain::all();
        $segmentsDropDown = DB::table('segments')->get();
        $sub_segmentsDropDown = DB::table('sub_segments')->get();
        $endorsement = Endorsement::where('client', $user->client)
            ->where('position_title', $user->p_title)
            ->where('career_endo', $user->c_level)
            ->first();

        $createdDate = null;
        $turnAround = 0;
        if ($endorsement) {
            $createdDate = date('Y-m-d', strtotime($endorsement->created_at));
            $reqDate = date($user->req_date);
            $createdDateTime = Carbon::parse($createdDate);
            $reqDateTime = Carbon::parse($reqDate);
            $diff = $createdDateTime->diff($reqDateTime);
            $turnAround = $diff->days;
        }
        $clientData = ClientManagement::all();
        $data = [
            'clientData' => $clientData,
            'sub_segmentsDropDown' => $sub_segmentsDropDown,
            'segmentsDropDown' => $segmentsDropDown,
            'user' => $user,
            'activeEndorsmentCount' => $activeEndorsmentCount,
            'inActiveEndorsmentCount' => $inActiveEndorsmentCount,
            'turnAround' => $turnAround,
        ];
        return view('JDL.jdl-detail', $data);
    }

    public function updateJDL(Request $request)
    {
        // return $request->all();
        $arrayCheck = [
            'client' => 'required',
            "p_title" => "required",
            "c_level" => "required",
            "domain" => "required",
            "segment" => "required",
            "subsegment" => "required",
            "status" => "required",
            "assignment" => "required",
            "updated_fte" => "required",
            "location" => "required",
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()]);

        } else {
            // return  ($request->all());
            // $recruiters = implode(',', $request->recruiter);
            $domainName = $request->domain;
            $segmentaName = $request->segment;
            $subsegmentName = $request->subsegment;
            $dataArray = $request->except('_token', 'id', 'domain', 'segment', 'subsegment');
            $dataArray['domain'] = $domainName;
            $dataArray['segment'] = $segmentaName;
            $dataArray['subsegment'] = $subsegmentName;
            // return $request->id;
            $checkDup = JDL::where([
                'client' => $request->client,
                'p_title' => $request->p_title,
                'domain' => $domainName,
                'c_level' => $request->c_level,
                'segment' => $segmentaName,
                'subsegment' => $subsegmentName,
            ])->where('id', '!=', $request->id)->first();
            if ($checkDup) {
                return response()->json(['success' => false, 'status' => 1, 'message' => 'You are overwriting Existing Job']);

            } else {
                JDL::updateOrCreate(['id' => $request->id], $dataArray);
                return response()->json(['success' => true, 'message' => 'Data has been inserted successfully']);

            }
        }
    }

    public function deleteJDL(Request $request)
    {
        try {
            JDL::where('id', $request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Data has been Delete successfully']);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->Message()]);

        }
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
        ini_set('memory_limit', '1000M'); //1000M  = 1 GB
        ini_set('max_execution_time', -1); //30000 seconds = 500 minutes 
        $Userdata = DB::table('jdl');

        if (isset($request->client)) {
            $Userdata->whereIn('client', $request->client);
        }
        if (isset($request->candidateDomain)) {
            $Userdata->whereIn('domain', $request->candidateDomain);
        }
        if (isset($request->segment)) {
            $Userdata->whereIn('segment', $request->segment);
        }
        if (isset($request->sub_segment)) {
            $Userdata->whereIn('subsegment', $request->sub_segment);
        }
        if (isset($request->position_title)) {
            $Userdata->whereIn('p_title', $request->position_title);
        }
        if (isset($request->career_level)) {
            $Userdata->whereIn('c_level', $request->career_level);
        }
        if (isset($request->address)) {
            $Userdata->whereIn('location', $request->address);
        }
        if (isset($request->status)) {
            $status = explode(',', $request->status);
            $Userdata->whereIn('status', $status);
        }
        if (isset($request->keyword)) {
            $Userdata->whereIn('keyword', $request->keyword);
        }

        // if ($request->agent == 1) {
        //     $Userdata->where('ref_code', 'LIKE', 'A%');
        // }

        // if ($request->nonAgent == 1) {
        //     $Userdata->where('ref_code', 'LIKE', 'N%');
        // }
        if (isset($request->priority)) {
            $Userdata->whereIn('priority', $request->priority);
        }
        if (isset($request->assignment)) {
            $Userdata->whereIn('assignment', $request->assignment);
        }
        if (isset($request->wschedule)) {
            $Userdata->whereIn('w_schedule', $request->wschedule);
        }

        if (isset($request->turnAroundDaysVar)) {
            $Userdata->where('turn_around', $request->turnAroundDaysVar);
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

    // add new jdl entry
    public function addJDLEntry(Request $request)
    {
        if ($request->isMethod('get')) {
            $segmentsDropDown = DB::table('segments')->get();
            $sub_segmentsDropDown = DB::table('sub_segments')->get();
            $clientData = ClientManagement::all();
            $data = [
                'clientData' => $clientData,
                'sub_segmentsDropDown' => $sub_segmentsDropDown,
                'segmentsDropDown' => $segmentsDropDown,
            ];
            return view('JDL.addJDL', $data);
        }
        if ($request->isMethod('post')) {

            $arrayCheck = [
                'client' => 'required',
                "p_title" => "required",
                "c_level" => "required",
                "domain" => "required",
                "segment" => "required",
                "subsegment" => "required",
                "req_date" => "required |date|after:1970-01-01",
                "status" => "required",
                "assignment" => "required",
                "updated_fte" => "required",
                "location" => "required",
                "t_fte" => "required",

                // "priority" => "required",
                // "ref_code" => "required",
                // "updated_date" => "required |date|after:1970-01-01",
                // "closed_date" => "required |date|after:1970-01-01",
                // "os_date" => "required |date|after:1970-01-01",
                // "sll_no" => "required",
                // "edu_attainment" => "required",
                // "jd" => "required",
                // "w_schedule" => "required",
                // "budget" => "required",
                // "poc" => "required",
                // "note" => "required",
                // "start_date" => "required |date|after:1970-01-01",
                // "keyword" => "required",
                // 'recruiter[]' => 'required|array|min:1',
            ];
            $validator = Validator::make($request->all(), $arrayCheck);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'message' => $validator->errors()]);
            } else {
                $recruiters = isset($request->recruiter) ? implode(',', $request->recruiter) : '';
                $domainName = $request->domain;
                $segmentaName = $request->segment;
                $subsegmentName = $request->subsegment;
                $reqDate = $request->req_date; // 2023-05-02
                $todayDate = Carbon::now()->format('Y-m-d'); // 2023-08-02
                $maturity = Carbon::parse($reqDate)->diffInDays(Carbon::parse($todayDate));
                $reqDate = $request->req_date;
                $checkDup = JDL::where([
                    'client' => $request->client,
                    'p_title' => $request->p_title,
                    'domain' => $domainName,
                    'c_level' => $request->c_level,
                    'segment' => $segmentaName,
                    'subsegment' => $subsegmentName,
                ])->first();
                if ($checkDup) {
                    return response()->json(['success' => false, 'status' => 1, 'message' => 'Job Exists in Database']);

                } else {
                    $endorsement = Endorsement::where('client', $request->client)
                        ->where('position_title', $request->p_title)
                        ->where('career_endo', $request->c_level)
                        ->first();

                    $createdDate = null;
                    $turnAround = 0;
                    if ($endorsement) {
                        $createdDate = date('Y-m-d', strtotime($endorsement->created_at));
                        $reqDate = date($request->req_date);
                        $createdDateTime = Carbon::parse($createdDate);
                        $reqDateTime = Carbon::parse($reqDate);
                        $diff = $createdDateTime->diff($reqDateTime);
                        $turnAround = $diff->days;
                    }
                    $jdl = new JDL();
                    $jdl->priority = $request->priority;
                    $jdl->ref_code = $request->ref_code;
                    $jdl->status = $request->status;
                    $jdl->req_date = $request->req_date;
                    $jdl->maturity = $request->maturity;
                    $jdl->updated_date = $request->updated_date;
                    $jdl->closed_date = $request->closed_date;
                    $jdl->os_date = $request->os_date;
                    $jdl->client = $request->client;
                    $jdl->domain = $domainName;
                    $jdl->segment = $segmentaName;
                    $jdl->subsegment = $subsegmentName;
                    $jdl->p_title = $request->p_title;
                    $jdl->c_level = $request->c_level;
                    $jdl->sll_no = $request->sll_no;
                    $jdl->turn_around = $turnAround;
                    $jdl->t_fte = $request->t_fte;
                    $jdl->updated_fte = $request->updated_fte;
                    $jdl->edu_attainment = $request->edu_attainment;
                    $jdl->jd = $request->jd;
                    $jdl->location = $request->location;
                    $jdl->w_schedule = $request->work_schedule;
                    $jdl->budget = $request->budget;
                    $jdl->poc = $request->poc;
                    $jdl->note = $request->note;
                    $jdl->start_date = $request->start_date;
                    $jdl->keyword = $request->keyword;
                    $jdl->recruiter = $recruiters;
                    $jdl->req_id = $request->requisitionID;
                    $jdl->classification = $request->classification;
                    $jdl->assignment = $request->assignment;
                    $jdl->req_classification = $request->req_classification;
                    $jdl->client_spiel = $request->client_spiel;
                    $jdl->client_classification = $request->client_classification;
                    $jdl->save();
                    //save COMAPNY addeed log to table starts
                    Helper::save_log('NEW_JDL_Entry');
                    // save COMAPNY added to log table ends
                    return response()->json(['success' => true, 'message' => 'Job Has Been Posted Successfully']);
                }
            }
        }
    }

    // close
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
        // $location = DB::table('jdl')->select("location")->groupby("location")->get();
        $client = DB::table('jdl')->select("client")->groupby("client")->get();

        $location = Helper::get_dropdown('location');
        $keyword = Helper::get_dropdown('keyword');
        $priority = Helper::get_dropdown('priority');
        $assignment = Helper::get_dropdown('assignment');
        $wschedule = Helper::get_dropdown('work_schedule');
        return response()->json([
            'keyword' => $keyword,
            'priority' => $priority,
            'assignment' => $assignment,
            'wschedule' => $wschedule,
            'domains' => $domains,
            'segment' => $segment,
            'subSegment' => $subSegment,
            'position_title' => $position_title,
            'career_level' => $career_level,
            'location' => $location,
            'client' => $client,
        ]);
    }
    public function bulkUpdateRecords(Request $request)
    {

        try {
            JDL::whereIn('id', $request->idArray)->update([
                'location' => $request->location,
            ]);
            return response()->json(['type' => 'success', 'message' => 'Bulk Update has been Done!']);

        } catch (Exception $e) {
            return response()->json(['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    //get data ajax agsint position title
    public function getDataAgainstPTitle(Request $request)
    {
        // return $request->all();
        // return PositionData::where('position', $request->position)->exists();
        if (PositionData::where('position', $request->position)->exists() == false) {
            try {
                $data = [];
                $dropdown = PositionData::where('position', $request->p_title)->first();
                if ($dropdown) {

                    $recruiter = Endorsement::where([
                        'client' => $request->client,
                        'position_title' => $dropdown->position,
                        'domain_endo' => $dropdown->domain,
                        'segment_endo' => $dropdown->segment,
                        'sub_segment_endo' => $dropdown->subSegment,
                    ])->count();

                    if ($recruiter > 0) {
                        $recruiter = Endorsement::where([
                            'client' => $request->client,
                            'position_title' => $dropdown->position,
                            'domain_endo' => $dropdown->domain,
                            'segment_endo' => $dropdown->segment,
                            'sub_segment_endo' => $dropdown->subSegment,
                        ])->get();
                        $arr = [];
                        foreach ($recruiter as $value) {
                            array_push($arr, $value->origionalRecruiterName);
                        }
                        $data['recruiter'] = $arr;

                    }
                    $data['dropdown'] = $dropdown;
                    return response()->json(['success' => true, 'data' => $data]);
                } else {
                    return response()->json(['success' => false]);

                }
            } catch (Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        } else {
            return response()->json(['success' => false]);
        }

    }
}
