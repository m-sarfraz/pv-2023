<?php

namespace App\Http\Controllers\Admin;

use App\CandidateTraversal;
use App\Domain;
use App\DropDownOption;
use App\Http\Controllers\Controller;
use App\Segment;
use App\SubSegment;
use DB;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-domain-list', ['only' => ['domain']]);
        $this->middleware('permission:add-domain', ['only' => ['add_domains']]);
        $this->middleware('permission:delete-domain', ['only' => ['delete_sub_segment']]);
    }
    public function testinglink()
    {
        echo 'This is a Testing Link...';
        die();
        // $segments = DB::table('taverse2')->get('position')->unique();
        // // return $segments;
        // foreach ($segments as $value) {

        //     $d = new DropDownOption();
        //     $d->drop_down_id = 12;
        //     $d->option_name = $value->position;
        //     $d->save();
        // }

    }
    public function view_sub_segments()
    {
        $subSegments = SubSegment::all();
        return Datatables::of($subSegments)
            ->addColumn('sub_segment_name', function ($subSegments) {
                return $subSegments->sub_segment_name;
            })
            ->addColumn('action', function ($subSegments) {
                $route = Route("delete-sub-segment");
                $function = 'delete_data(this,"' . $route . '")';
                $b = "<button onclick='" . $function . "' data-id='" . $subSegments->id . "' class='bg-transparent text-danger border-0'>Delete</button>";
                return $b;
            })
            ->rawColumns(['sub_segment_name', 'action'])
            ->make(true);
    }
    public function domain()
    {
        $getDomains = Domain::all();
        $getSegments = Segment::all();
        $profile = DB::table('gettravesels')->select('c_profile')->get();
        $subsegment = DB::table('gettravesels')->select('s_segment')->get();
        $data['domains'] = $getDomains;
        $data['segments'] = $getSegments;
        $data = [
            'domains' => $getDomains,
            'segments' => $getSegments,
            'profile' => $profile,
            'subsegment' => $subsegment,
        ];
        //$data['sub_segments']    =   $subSegments;
        return view('domains.add_domain', $data);
    }
    public function add_domains(Request $request)
    {
        // $arrayCheck = [
        //     "domain_name" => "required|array|min:1",
        //     "domain_name.*" => "required|string|min:1|unique:domains,domain_name",
        // ];
        // $validator = Validator::make($request->all(), $arrayCheck);
        // if ($validator->fails()) {
        //     return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        // }
        if (isset($request->domain_name)) {
            $domainNames = $request->domain_name;
            $addDomains = [];
            $i = 0;
            foreach ($domainNames as $domainName) {
                $addDomains[$i]['domain_name'] = $domainName;
                $i++;
            }
            $addOption = Domain::insert($addDomains);
            if ($addOption) {
                //save domain addeed log to table starts
                Helper::save_log('DOMAIN_CREATED');
                // save domain added to log table ends
                return response()->json(['success' => true, 'message' => 'Domains added successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error while adding Domains']);
            }
        }
        if (isset($request->c_profile)) {
            // return $request->all();
            foreach ($request->c_profile as $key => $profile) {
                $traverse = new CandidateTraversal();
                $traverse->c_profile = $request->c_profile[$key];
                $segment = CandidateTraversal::where('s_segment', $request->s_segment[$key])->first();
                $traverse->s_segment = $request->s_segment[$key];
                $traverse->domain = $segment->domain;
                $traverse->segment = $segment->segment;
                $traverse->save();
            }

        }
    }
    public function add_segments(Request $request)
    {
        $arrayCheck = [
            "segment_name" => "required|array|min:1",
            "segment_name.*" => "required|string|min:1|unique:segments,segment_name",
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $segmentNames = $request->segment_name;
            $domain = $request->domain;
            $addSegments = [];
            $i = 0;
            foreach ($segmentNames as $segmentName) {
                $addSegments[$i]['segment_name'] = $segmentName;
                $addSegments[$i]['domain_id'] = $domain;
                $i++;
            }
            $addOption = Segment::insert($addSegments);
            if ($addOption) {
                //save domain addeed log to table starts
                Helper::save_log('SEGMENT_CREATED');
                // save domain added to log table ends
                return response()->json(['success' => true, 'message' => 'Segment added successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error while adding Segment']);
            }
        }
    }
    public function add_sub_segments(Request $request)
    {
        $arrayCheck = [
            "sub_segment_name" => "required|array|min:1",
            "sub_segment_name.*" => "required|string|min:1|unique:sub_segments,sub_segment_name",
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $SubsegmentNames = $request->sub_segment_name;
            $domain = $request->domain;
            $addSubSegments = [];
            $i = 0;
            foreach ($SubsegmentNames as $SubsegmentName) {
                $addSubSegments[$i]['sub_segment_name'] = $SubsegmentName;
                $addSubSegments[$i]['segment_id'] = $domain;
                $i++;
            }
            $addSubSegment = SubSegment::insert($addSubSegments);
            if ($addSubSegment) {
                //save domain addeed log to table starts
                Helper::save_log('SUBSEGMENT_CREATED');
                // save domain added to log table ends
                return response()->json(['success' => true, 'message' => 'Sub Segment added successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Error while adding Sub Segment']);
            }
        }
    }

    public function delete_sub_segment(Request $request)
    {
        $deleteOption = SubSegment::where('id', $request->id)->delete();
        if ($deleteOption) {
            //save domain addeed log to table starts
            Helper::save_log('SUBSEGMENT_DELETED');
            // save domain added to log table ends
            return response()->json(['success' => true, 'message' => 'Sub Segment deleted successfully']);
        } else {

            return response()->json(['success' => false, 'message' => 'Error while deleting Sub Segment']);
        }
    }
}
