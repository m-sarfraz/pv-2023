<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\DropDownOption;
use App\Http\Controllers\Controller;
use App\Segment;
use App\SubSegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DomainController extends Controller
{
    public function __construct()
    {
        //$this->middleware('permission:add-domains', ['only' => ['add_domains']]);
    }

    public function view_sub_segments()
    {
        $subSegments    =   SubSegment::all();
        return Datatables::of($subSegments)
            ->addColumn('sub_segment_name', function ($subSegments) {
                return $subSegments->sub_segment_name;
            })
            ->addColumn('action', function ($subSegments){
                $route  =  Route("delete-sub-segment");
                $function   =   'delete_data(this,"'.$route.'")';
                $b = "<button onclick='".$function."' data-id='".$subSegments->id."' class='bg-transparent text-danger border-0'>Delete</button>";
                return $b;
            })
            ->rawColumns(['sub_segment_name','action'])
            ->make(true);
    }
    public function domain(){
        $getDomains     =   Domain::all();
        $getSegments    =   Segment::all();
        //$subSegments    =   SubSegment::all();
        $data['domains']    =   $getDomains;
        $data['segments']    =   $getSegments;
        //$data['sub_segments']    =   $subSegments;
        return view('domains.add_domain',compact('data'));
    }
    public function add_domains(Request  $request){
        $arrayCheck =  [
            "domain_name"    => "required|array|min:1",
            "domain_name.*"  => "required|string|min:1|unique:domains,domain_name",
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $domainNames    =   $request->domain_name;
            $addDomains =   [];
            $i = 0;
            foreach($domainNames as $domainName){
                $addDomains[$i]['domain_name']  =   $domainName;
                $i++;

            }
            $addOption = Domain::insert($addDomains);
            if($addOption){
                return response()->json(['success' => true, 'message' =>'Domains added successfully']);
            }else{
                return response()->json(['success' => false, 'message' =>'Error while adding Domains']);
            }

        }


    }
    public function add_segments(Request  $request){
        $arrayCheck =  [
            "segment_name"    => "required|array|min:1",
            "segment_name.*"  => "required|string|min:1|unique:segments,segment_name",
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $segmentNames    =   $request->segment_name;
            $addSegments =   [];
            $i = 0;
            foreach($segmentNames as $segmentName){
                $addSegments[$i]['segment_name']  =   $segmentName;
                $i++;

            }
            $addOption = Segment::insert($addSegments);
            if($addOption){
                return response()->json(['success' => true, 'message' =>'Segment added successfully']);
            }else{
                return response()->json(['success' => false, 'message' =>'Error while adding Segment']);
            }

        }


    }
    public function add_sub_segments(Request  $request){
        $arrayCheck =  [
            "sub_segment_name"    => "required|array|min:1",
            "sub_segment_name.*"  => "required|string|min:1|unique:sub_segments,sub_segment_name",
        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $SubsegmentNames    =   $request->sub_segment_name;
            $addSubSegments =   [];
            $i = 0;
            foreach($SubsegmentNames as $SubsegmentName){
                $addSubSegments[$i]['sub_segment_name']  =   $SubsegmentName;
                $i++;

            }
            $addSubSegment = SubSegment::insert($addSubSegments);
            if($addSubSegment){
                return response()->json(['success' => true, 'message' =>'Sub Segment added successfully']);
            }else{
                return response()->json(['success' => false, 'message' =>'Error while adding Sub Segment']);
            }

        }


    }

    public function delete_sub_segment(Request $request){
        $deleteOption   =   SubSegment::where('id',$request->id)->delete();
        if($deleteOption){
            return response()->json(['success' => true, 'message' =>'Sub Segment deleted successfully']);
        }else{
            return response()->json(['success' => false, 'message' =>'Error while deleting Sub Segment']);
        }
    }

    public function enter(Request $request){
        if ($request->isMethod('get')) {
            return view('enter');
        }
        if ($request->isMethod('post')) {
            $enter = new DropDownOption();
            $enter->option_name = $request->option;
            $enter->drop_down_id = '11';
            $enter->save();
            return redirect()->back()->with('message', 'added');
        }
    }
}
