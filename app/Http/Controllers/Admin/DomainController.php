<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\DropDownOption;
use App\Http\Controllers\Controller;
use App\Segment;
use App\SubSegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DomainController extends Controller
{
    public function __construct()
    {
        //$this->middleware('permission:add-domains', ['only' => ['add_domains']]);
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
