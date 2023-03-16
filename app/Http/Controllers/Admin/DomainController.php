<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\Http\Controllers\Controller;
use App\Profile;
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
        // return Domain::with([
        //     'segments' => function ($q1) {
        //         return $q1->with([
        //             'sub_segments' => function ($q2) {
        //                 return $q2->with('profile');
        //             }]);
        //     }])->get();
        $getDomains = Domain::all();
        $getSegments = Segment::all();
        $profile = DB::table('gettravesels')->select('c_profile')->get();
        $subsegment = SubSegment::all();
        $data['domains'] = $getDomains;
        $data['segments'] = $getSegments;
        $data = [
            'domains' => $getDomains,
            'segments' => $getSegments,
            'profile' => $profile,
            'subsegment' => $subsegment,
        ];
        //$data['sub_segments']    =   $subSegments;
        return view('domains.add_domain_updated', $data);
    }
    public function add_domains(Request $request)
    {
        $arrayCheck = [
            "option" => "required|string|min:1|unique:domains,domain_name",
        ];
        $message = [
            'option.required' => 'Enter an Option value',
        ];
        $validator = Validator::make($request->all(), $arrayCheck, $message);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'status' => 'error', 'message' => $validator->errors()->first()]);
        }
        $arr = [
            'domain_name' => $request->option,
        ];
        $insertData = Domain::insert($arr);
        if ($insertData) {
            Helper::save_log('SEGMENT_CREATED');
            return response()->json(['success' => true, 'message' => 'Data inserted Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Some Error Occured']);

        }

    }
    public function add_segments(Request $request)
    {
        $arrayCheck = [
            "domain_id" => "required",
            "option" => "required|string|min:1|unique:segments,segment_name",
        ];
        $message = [
            'domain_id.required' => 'Select a Domain First',
            'option.required' => 'Enter an Option value',
        ];
        $validator = Validator::make($request->all(), $arrayCheck, $message);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'status' => 'error', 'message' => $validator->errors()->first()]);
        } else {
            $addSegments = [
                'segment_name' => $request->option,
                'domain_id' => $request->domain_id,
            ];

            $insertData = Segment::insert($addSegments);
            if ($insertData) {
                Helper::save_log('SEGMENT_CREATED');

                return response()->json(['success' => true, 'message' => 'Data inserted Successfully']);

            } else {
                return response()->json(['success' => false, 'message' => 'Some Error Occured']);

            }

        }
    }
    //append filter options
    public function appendFilters()
    {
        $getDomains = Domain::all();
        $getSegments = Segment::all();
        $profile = DB::table('gettravesels')->select('c_profile')->get();
        $subsegment = SubSegment::all();
        $cprofile = DB::table('candidate_profile')->get();

        return response()->json(
            [
                'domains' => $getDomains,
                'segments' => $getSegments,
                'profile' => $profile,
                'subsegment' => $subsegment,
                'cprofile' => $cprofile,
            ]
        );
    }

    public function add_profile(Request $request)
    {
        $arrayCheck = [
            "sub_segment_id" => "required",
            "option" => "required|string|min:1|unique:candidate_profile,c_profile_name",
        ];
        $message = [
            'sub_segment_id.required' => 'Select a Sub Segment First',
            'option.required' => 'Enter an Option value',
        ];
        $validator = Validator::make($request->all(), $arrayCheck, $message);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $insertData = DB::table('candidate_profile')->insert([
                'c_profile_name' => $request->option,
                'sub_segment_id' => $request->sub_segment_id,
            ]);
            if ($insertData) {
                return response()->json(['success' => true, 'message' => 'Data inserted Successfully']);

            } else {
                return response()->json(['success' => false, 'message' => 'Some Error Occured']);

            }
        }

    }
    public function add_sub_segments(Request $request)
    {
        $arrayCheck = [
            "segment_id" => "required|min:1",
            "option" => "required|string|min:1|unique:sub_segments,sub_segment_name",
        ];
        $message = [
            'segment_id.required' => 'Select a Segment First',
            'option.required' => 'Enter an Option value',
        ];
        $validator = Validator::make($request->all(), $arrayCheck, $message);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $addSubSegments = [
                'sub_segment_name' => $request->option,
                'segment_id' => $request->segment_id,
            ];

            $insertData = SubSegment::insert($addSubSegments);
            if ($insertData) {
                Helper::save_log('SUBSEGMENT_CREATED');

                return response()->json(['success' => true, 'message' => 'Data inserted Successfully']);

            } else {
                return response()->json(['success' => false, 'message' => 'Some Error Occured']);

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

    public function deleteOption(Request $request)
    {
        // return $request->all();
        switch ($request->optionToDelete) {
            case 'domains':
                $option = (Domain::where('id', $request->optionValue)->first())->domain_name;
                $check = DB::table('candidate_domains')->where('domain', $option)->exists();
                if ($check == false) {
                    $domain = Domain::findOrFail($request->optionValue); // Find the domain using Laravel's ORM
                    $domain->delete(); // Use Laravel's ORM to delete the domain, which triggers the `deleting` event
                    return response()->json(['success' => true, 'message' => 'Domain Deleted Successfully']);
                } else {
                    $useCount = DB::table('candidate_domains')->where('domain', $option)->count();
                    return response()->json(['success' => false, 'message' => 'Domain Already in Use for ' . $useCount . ' candidate(s)']);
                }
                break;
            case 'segment':
                $option = (Segment::where('id', $request->optionValue)->first())->segment_name;
                $check = DB::table('candidate_domains')->where('segment', $option)->exists();
                if ($check == false) {
                    $Segment = Segment::findOrFail($request->optionValue); // Find the Segment using Laravel's ORM
                    $Segment->delete(); // Use Laravel's ORM to delete the Segment, which triggers the `deleting` event
                    return response()->json(['success' => true, 'message' => 'Segment Deleted Successfully']);
                } else {
                    $useCount = DB::table('candidate_domains')->where('segment', $option)->count();
                    return response()->json(['success' => false, 'message' => 'Segment Already in Use for ' . $useCount . ' candidate(s)']);
                }
                break;
            case 'subSegments':
                $option = (SubSegment::where('id', $request->optionValue)->first())->sub_segment_name;
                $check = DB::table('candidate_domains')->where('sub_segment', $option)->exists();
                if ($check == false) {
                    $SubSegment = SubSegment::findOrFail($request->optionValue); // Find the SubSegment using Laravel's ORM
                    $SubSegment->delete(); // Use Laravel's ORM to delete the SubSegment, which triggers the `deleting` event
                    return response()->json(['success' => true, 'message' => 'Sub Segment Deleted Successfully']);
                } else {
                    $useCount = DB::table('candidate_domains')->where('sub_segment', $option)->count();
                    return response()->json(['success' => false, 'message' => 'Sub Segments Already in Use for ' . $useCount . ' candidate(s)']);
                }
                break;

            case 'profile':
                $option = (Profile::where('id', $request->optionValue)->first())->c_profile_name;
                $check = DB::table('candidate_positions')->where('candidate_profile', $option)->exists();
                if ($check == false) {
                    $Profile = Profile::findOrFail($request->optionValue); // Find the Profile using Laravel's ORM
                    $Profile->delete(); // Use Laravel's ORM to delete the Profile, which triggers the `deleting` event
                    return response()->json(['success' => true, 'message' => 'Candidate Profile Deleted Successfully']);
                } else {
                    $useCount = DB::table('candidate_positions')->where('candidate_profile', $option)->count();
                    return response()->json(['success' => false, 'message' => 'Candidate Profile Already in Use for ' . $useCount . ' candidate(s)']);
                }
                break;

                //
        }
    }
}
