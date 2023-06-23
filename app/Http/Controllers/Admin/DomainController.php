<?php

namespace App\Http\Controllers\Admin;

use App\clientManagement;
use App\Domain;
use App\DropDown;
use App\DropDownOption;
use App\Http\Controllers\Controller;
use App\JDL;
use App\PositionData;
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

    //show client, classificaton and spiel table
    public function view_client_table(Request $request)
    {
        $data = clientManagement::all();
        return Datatables::of($data)
            ->addColumn('client', function ($data) {
                return $data->client;
            })
            ->addColumn('ClientClassification', function ($data) {
                return $data->ClientClassification;
            })
            ->addColumn('ClientSpiel', function ($data) {
                return $data->ClientSpiel;
            })
            ->addColumn('action', function ($data) {
                $route = Route("delete-client-spiel");
                $function = 'delete_client_spiel(this,"' . $route . '")';
                $b = "<button onclick='" . $function . "' data-id='" . $data->id . "' class='btn btn-sm btn-danger mr-3  border-0' >Delete</button>";

                $route = Route("edit-client-spiel");
                $function = 'edit_client_spiel(this,"' . $route . '")';
                $b .= "<button onclick='" . $function . "' data-id='" . $data->id . "' class=' btn btn-sm btn-primary mr-3 border-0' data-objct = '" . json_encode($data) . "'>Edit</button>";

                return $b;
            })
            ->rawColumns(['sub_segment_name', 'action'])
            ->make(true);
    }
    // ends

    // function for deleting the client spiel
    public function deleteClientSpiel(Request $request)
    {
        try {
            clientManagement::where('id', $request->id)->delete();
            return response()->json(['success' => true, 'message' => 'Dropdown Deleted Successfully']);

        } catch (\Exception $e) {
            return response()->json(['success' => true, 'message' => $e->getMessage()]);
        }

    }
    // ends
    // function for updating the data
    public function editClientSpiel(Request $request)
    {

        $arrayCheck = [
            "modalClient" => "required",

        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => 'error', 'message' => $validator->errors()]);
        } else {
            $bol = clientManagement::where([
                'client' => $request->modalClient,
                'ClientClassification' => $request->clientClassificationModal,
            ])->where('id', '!=', $request->id)->exists();
            if ($bol) {
                return response()->json(['success' => 'duplicate', 'message' => 'Duplicate Entry Deducted']);

            }
            clientManagement::where('id', $request->id)
                ->update([
                    'client' => $request->modalClient,
                    'ClientClassification' => $request->clientClassificationModal,
                    'ClientSpiel' => $request->clientSpielModal,
                ]);
            return response()->json(['success' => true, 'message' => 'Update Successfully']);

        }
    }
    // ends
    // function for saving client, spi el and classification
    public function saveClientSpiel(Request $request)
    {
        $arrayCheck = [
            "clients" => "required",

        ];
        $validator = Validator::make($request->all(), $arrayCheck);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            $exists = clientManagement::where([
                'client' => $request->clients, 'clientClassification' => $request->clientClassification])->exists();
            if ($exists) {
                return response()->json(['success' => 'duplicate', 'message' => $validator->errors()->first()]);
            } else {
                $data = new clientManagement();
                $data->client = $request->clients;
                $data->clientClassification = $request->clientClassification;
                $data->clientSpiel = $request->clientSpiel;
                $data->save();
                return response()->json(['success' => true, 'message' => 'Data Inserted Successfully']);

            }
        }

    }
    // ends

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
    // ends

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
    // ends
    public function add_classification(Request $request)
    {
        $arrayCheck = [
            "optionClient" => "required|string|min:1|unique:drop_down_options,option_name",
        ];
        $message = [
            'option.required' => 'Enter an Option value',
        ];
        $validator = Validator::make($request->all(), $arrayCheck, $message);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'status' => 'error', 'message' => $validator->errors()->first()]);
        }
        $optionID = DropDown::where('type', 'clientClassification')->first('id');
        // return  ($oprionID);
        $arr = [
            'option_name' => $request->optionClient,
            'drop_down_id' => $optionID->id,
        ];
        $insertData = DropDownOption::insert($arr);
        if ($insertData) {
            Helper::save_log('CLIENT_CLASSIFICATION_CREATED');
            return response()->json(['success' => true, 'message' => 'Data inserted Successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Some Error Occured']);

        }

    }
    // ends
    public function add_client(Request $request)
    {
        $arrayCheck = [
            "optionClient" => "required|string|min:1|unique:drop_down_options,option_name",
        ];
        $message = [
            'option.required' => 'Enter an Option Value',
        ];
        $validator = Validator::make($request->all(), $arrayCheck, $message);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'status' => 'error', 'message' => $validator->errors()->first()]);
        } else {
            $clientID = DropDown::where('type', 'clients')->first('id');
            // return  ($clientID);
            $arr = [
                'option_name' => $request->optionClient,
                'drop_down_id' => $clientID->id,
            ];
            $insertData = DropDownOption::insert($arr);
            if ($insertData) {
                Helper::save_log('CLIENT_CREATED');
                $client = Helper::get_dropdown('clients');
                return response()->json(['success' => true, 'message' => 'Data inserted Successfully', 'client' => $client]);
            } else {
                return response()->json(['success' => false, 'message' => 'Some Error Occured']);

            }
        }

    }
    // ends

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
    // ends

    //append filter options
    public function appendFilters()
    {
        $getDomains = Domain::all();
        $getSegments = Segment::all();
        $profile = DB::table('gettravesels')->select('c_profile')->get();
        $subsegment = SubSegment::all();
        $cprofile = DB::table('candidate_profile')->get();
        $client = Helper::get_dropdown('clients');
        $clientClassification = Helper::get_dropdown('clientClassification');

        return response()->json(
            [
                'clientClassification' => $clientClassification,
                'client' => $client,
                'domains' => $getDomains,
                'segments' => $getSegments,
                'profile' => $profile,
                'subsegment' => $subsegment,
                'cprofile' => $cprofile,
            ]
        );
    }
    // ends

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
    // ends

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
    // ends

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
    // ends

    public function deleteOption(Request $request)
    {

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

            case 'clients':
                // $option = (Profile::where('id', $request->optionValue)->first())->c_profile_name;
                $check = JDL::where('client', $request->optionValue)->exists();
                if ($check == false) {
                    $Profile = DropDownOption::where('option_name', $request->optionValue)->delete(); // Use Laravel's ORM to delete the Profile, which triggers the `deleting` event
                    return response()->json(['success' => true, 'message' => 'Client has been Deleted Successfully']);
                } else {
                    $useCount = DB::table('jdl')->where('client', $request->optionValue)->count();
                    return response()->json(['success' => false, 'message' => 'Client Option Already in Use for ' . $useCount . ' candidate(s)']);
                }
                break;
            case 'clientClassification':
                // $option = (Profile::where('id', $request->optionValue)->first())->c_profile_name;
                $check = JDL::where('client_classification', $request->optionValue)->exists();
                if ($check == false) {
                    $Profile = DropDownOption::where('option_name', $request->optionValue)->delete(); // Use Laravel's ORM to delete the Profile, which triggers the `deleting` event
                    return response()->json(['success' => true, 'message' => 'Client Classification has been Deleted Successfully']);
                } else {
                    $useCount = DB::table('jdl')->where('client_classification', $request->optionValue)->count();
                    return response()->json(['success' => false, 'message' => 'Client Classification Option Already in Use for ' . $useCount . ' candidate(s)']);
                }
                break;
        }
    }
    // ends
    public function addPositionTitle(Request $request)
    {
        // return $request->all();
        $arrayCheck = [
            "domain" => "required|min:1",
            "position" => "required|min:1",
            "segment2" => "required|min:1",
            "subsegment2" => "required|min:1",
        ];
        $message = [
            'domain.required' => 'Enter an Option value',
            'position.required' => 'Enter an Option value',
            'segment2.required' => 'Enter an Option value',
            'subsegment2.required' => 'Enter an Option value',
        ];
        $validator = Validator::make($request->all(), $arrayCheck, $message);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } else {
            try {
                $positionData = new PositionData();
                $domain = (Domain::where('id', $request->domain)->first())->domain_name;
                $segment =( Segment::where('id', $request->segment2)->first())->segment_name;
                $subSegment = (SubSegment::where('id', $request->subsegment2)->first())->sub_segment_name ; 
                $positionData->domain =  $domain;
                $positionData->position = $request->position;
                $positionData->segment =  $segment;
                $positionData->subSegment =  $subSegment;
                $positionData->save();
                return response()->json(['success' => true, 'message' => 'New Record has been Inserted']);

            } catch (Exception $e) {

                return response()->json(['success' => false, 'message' => 'Error Has Occured!']);
            }

        }
    }
}
