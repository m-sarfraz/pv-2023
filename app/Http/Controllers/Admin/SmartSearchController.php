<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;
use Str;
use Yajra\DataTables\DataTables;

class SmartSearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-smart-search', ['only' => ['index']]);
    }
    // index view of finance page starts
    public function index(Request $request)
    {
        // $Userdata = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
        //     ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
        //     ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
        //     ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
        //     ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
        //     ->select('candidate_educations.*', 'candidate_informations.id as C_id', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*');
        $domain = Domain::all();
        $user_recruiter = User::where('type', 3)->get();

        // $page = $request->has('page') ? $request->get('page') : 1;
        // $limit = $request->has('limit') ? $request->get('limit') : 10;
        // $user = $Userdata->offset($page)
        // ->limit($limit)
        // ->paginate();
        // $count = $Userdata->count();
        // qurries for summary section start
        // $sifted = count($user);
        // $onBoarded = count($Userdata->where('endorsements.remarks_for_finance', 'Onboarded')->get());
        // $failed = count($Userdata->where('endorsements.remarks_for_finance', 'like', '%Fail%')->get());
        // $withdrawn = count($Userdata->where('endorsements.remarks_for_finance', 'like', '%Withdraw%')->get());
        // $rejected = count($Userdata->where('endorsements.remarks_for_finance', 'like', '%reject%')->get());
        // $accepted = count($Userdata->where('endorsements.remarks_for_finance', 'Offer accepted')->get());
        // $spr = count($Userdata->whereNotNull('finance.srp')->get());
        // $endo = count($Userdata->where('endorsements.app_status', 'To Be Endorsed')->get());
        // $active = count($Userdata->where('endorsements.app_status', 'Active File')->get());
        $address = DB::Select("select address from candidate_informations where  address!='' group by address");
        $status = DB::Select("select status from endorsements group by status");
        // close
        $data = [
            'domain' => $domain,
            // 'Userdata' => $user,
            'user_recruiter' => $user_recruiter,
            // 'sifted' => $sifted,
            // 'endo' => $endo,
            // 'active' => $active,
            // 'onBoarded' => $onBoarded,
            // 'count' => $count,
            // 'spr' => $spr,
            // 'accepted' => $accepted,
            // 'failed' => $failed,
            // 'withdrawn' => $withdrawn,
            // 'rejected' => $rejected,
            'address' => $address,
            'status' => $status,
        ];

        return view('smartSearch.smart_search', $data);
    }
    // close

    // filter record on basis on coming selected options starts
    public function filterSearch(Request $request)
    {
        $data = [];
        $check = $searchCheck = false;
        // return $request->all();
        $Userdata = DB::table('six_table_view');
        //    check null values coming form selected options
        if (isset($request->domain)) {
            $Userdata->whereIn('six_table_view.domain', $request->domain);
        }
        if (isset($request->recruiter)) {

            $Userdata->whereIn('six_table_view.saved_by', $request->recruiter);
        }
        if (isset($request->status)) {

            $Userdata->whereIn('six_table_view.endostatus', array($request->status));
        }
        if (isset($request->client)) {
            // return $request->client;
            $Userdata->whereIn('six_table_view.client', $request->client);
        }

        if ($request->cip == 1) {
            $stageArray = [
                'Scheduled for Skills Interview',
                'Scheduled for Technical Interview',
                'Scheduled for Technical exam',
                'Sheduled for Behavioral Interview',
                'Scheduled for account validation',
                'Done Skills interview/ Awaiting Feedback',
                ' Done Techincal Interview /Awaiting Feedback',
                'Done Technical exam /Awaiting Feedback',
                ' Done Behavioral /Awaiting Feedback',
                ' Failed Skills interview',
                ' Failed Techincal Interview',
                'Failed Technical exam',
                'Failed Behavioral Interview',
                'Pending Country Head Interview',
                'Pending Final Interview',
                ' Pending Hiring Managers Interview',
                ' Withdraw / CNI - Mid',
                '   Position Closed (Mid Stage)',
                ' Done Skills/Technical Interview / Awaiting Feedback',
                ' Failed Skills/Technical Interview',
                '  Position On Hold (Mid Stage)',
                ' Scheduled for Behavioral Interview',
                '  Scheduled for Skills/Technical Interview',
                '  Fallout/Reneged',
                'Scheduled for Country Head Interview',
                'Scheduled for Final Interview',
                'Scheduled for Hiring Managers Interview',
                'Done Behavioral Interview / Awaiting Feedback',
                'Done Final Interview / Awaiting Feedback',
                'Done Hiring Managers Interview / Awaiting Feedback',
                'Failed Country Head Interview',
                'Failed Final Interview',
                'Failed Hiring Managers Interview',
                'Scheduled for Job Offer',
                'Shortlisted/For Comparison',
                'Onboarded',
                'Offer accepted',
                'Offer Rejected',
                'Position Closed (Final Stage)',
                'Withdraw / CNI - Final',
                'Done Country Head Interview / Awaiting Feedback',
                'Pending Offer Approval',
                'Pending Offer Schedule',
                'Position On Hold (Final Stage)',
                'Shortlisted',
            ];
            $Userdata->whereIn('six_table_view.remarks_for_finance', $stageArray);
        }
        if (isset($request->residence)) {
            $Userdata->whereIn('six_table_view.address', $request->residence);
        }
        if (isset($request->career_level)) {

            $Userdata->whereIn('six_table_view.career_endo', $request->career_level);
        }
        if (isset($request->category)) {
            $Userdata->whereIn('six_table_view.remarks_for_finance', $request->category);
        }
        if (isset($request->remarks)) {
            $Userdata->whereIn('six_table_view.remarks', $request->remarks);
        }
        if (isset($request->ob_start)) {
            $Userdata->whereDate('six_table_view.onboardnig_date', '>=', $request->ob_start);
        }
        if (isset($request->ob_end)) {
            $Userdata->whereDate('six_table_view.onboardnig_date', '<=', $request->ob_end);
        }
        if (isset($request->sift_start)) {
            $Userdata->whereDate('six_table_view.date_shifted', '>=', $request->sift_start);
        }
        if (isset($request->sift_end)) {
            $Userdata->whereDate('six_table_view.date_shifted', '<=', $request->sift_end);
        }
        if (isset($request->endo_start)) {
            $Userdata->whereDate('six_table_view.endi_date', '>=', $request->endo_start);
        }
        if (isset($request->endo_end)) {
            $Userdata->whereDate('six_table_view.endi_date', '<=', $request->endo_end);
        }
        //start search
        // if (isset($request->searchKeyword)) {
        //     $searchCheck = true;
        //     $perfect_match = DB::table("six_table_view")->get();

        //     foreach ($perfect_match as $match) {
        //         if (strpos(strtolower($match->domain), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.domain', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.last_name', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->saved_by), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.saved_by', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->client), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.client', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->remarks_for_finance), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.remarks_for_finance', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->address), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.address', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->career_endo), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.career_endo', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->remarks), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.remarks', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->onboardnig_date), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.onboardnig_date', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->date_shifted), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.date_shifted', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->endi_date), strtolower($request->searchKeyword)) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.endi_date', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->gender), strtolower($request->searchKeyword)) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.gender', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->candidate_profile), strtolower($request->searchKeyword)) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.candidate_profile', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->educational_attain), strtolower($request->searchKeyword)) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.educational_attain', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->status), strtolower($request->searchKeyword)) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.endostatus', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->first_name), strtolower($request->searchKeyword)) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.first_name', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.last_name', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->curr_salary), strtolower($request->searchKeyword)) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.curr_salary', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->placement_fee), strtolower($request->searchKeyword)) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.placement_fee', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos(strtolower($match->srp), strtolower($request->searchKeyword)) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.srp', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //     }
        // }
        // if ($check) {

        //     $user = $Userdata->get();
        // } else {
        //     if (!$check && !$searchCheck) {
        //         $user = $Userdata->get();
        //     } else {
        //         $user = [];
        //     }
        // }
        $user = $Userdata->get();

        $onBoarded = count($Userdata->get());
        return Datatables::of($user)
            ->addIndexColumn()
            ->addColumn('recruiter', function ($Userdata) {
                // $name = DB::select('select last_name from  candidate_informations where id=' . $Userdata->id);
                return $Userdata->recruiter;
            })
            ->addColumn('candidate', function ($Userdata) {
                // $name = DB::select('select last_name from  candidate_informations where id=' . $Userdata->id);
                return $Userdata->last_name;
            })
            ->addColumn('client', function ($user) {
                return $user->client;
            })
            ->addColumn('gender', function ($user) {
                return $user->gender;
            })
            ->addColumn('domain', function ($user) {
                return $user->domain;
            })
            ->addColumn('candidate_profile', function ($user) {
                return $user->candidate_profile;
            })
            ->addColumn('educational_attain', function ($user) {
                return $user->educational_attain;
            })
            ->addColumn('curr_salary', function ($user) {
                return $user->curr_salary;
            })
            ->addColumn('portal', function ($user) {
                return "N/A";
            })
            ->addColumn('date_shifted', function ($user) {
                if (!empty($user->date_shifted && $user->date_shifted != '0000-00-00')) {
                    $date_shifted = date_format(date_create($user->date_shifted), "m-d-Y");
                    return $date_shifted;
                } else {
                    $user->date_shifted = '';
                }
            })
            ->addColumn('career_endo', function ($user) {
                return $user->career_endo;
            })
            ->addColumn('endostatus', function ($user) {
                return $user->endostatus;
            })
            ->addColumn('endi_date', function ($user) {
                if (!empty($user->endi_date && $user->endi_date != '0000-00-00')) {
                    $endi_date = date_format(date_create($user->endi_date), "m-d-Y");
                    return $endi_date;
                } else {
                    $user->endi_date = '';
                }
            })
            ->addColumn('remarks_for_finance', function ($user) {
                return $user->remarks_for_finance;
            })
            ->addColumn('category', function ($user) {
                return "N/A";
            })
            ->addColumn('srp', function ($user) {
                return $user->srp;
            })
            ->addColumn('onboardnig_date', function ($user) {
                if (!empty($user->onboardnig_date && $user->onboardnig_date != '0000-00-00')) {
                    $onboardnig_date = date_format(date_create($user->onboardnig_date), "m-d-Y");
                    return $onboardnig_date;
                } else {
                    $user->onboardnig_date = '';
                }

            })
            ->addColumn('placement_fee', function ($user) {
                return $user->placement_fee;
            })
            ->addColumn('address', function ($user) {
                return $user->address;
            })
            ->addColumn('saved_by', function ($user) {
                $name = DB::select('select name from  users where id=' . $user->saved_by);
                return $name[0]->name;
            })

            ->rawColumns(['id', 'client', 'gender', 'domain', 'candidate_profile', 'educational_attain',
                'curr_salary', 'portal', 'date_shifted', 'career_endo', 'endostatus', 'endi_date', 'remarks_for_finance', 'category',
                'srp', 'onboardnig_date', 'placement_fee', 'address'])
            ->make(true);

        // close

    }
    // close
    private function getRecordSummary($mainObject, $target, $condition)
    {
        return count($mainObject->where($target, $condition)->get());
    }
    public function smartTOYajra()
    {

        $Userdata = DB::table('six_table_view')->get();
        return Datatables::of($Userdata)
        // ->addIndexColumn()
            ->addColumn('recruiter', function ($Userdata) {
                // $name = DB::select('select last_name from  candidate_informations where id=' . $Userdata->id);
                return $Userdata->recruiter;
            })
            ->addColumn('candidate', function ($Userdata) {
                // $name = DB::select('select last_name from  candidate_informations where id=' . $Userdata->id);
                return $Userdata->last_name;
            })
            ->addColumn('client', function ($Userdata) {
                return $Userdata->client;
            })
            ->addColumn('gender', function ($Userdata) {
                return $Userdata->gender;
            })
            ->addColumn('domain', function ($Userdata) {
                return $Userdata->domain;
            })
            ->addColumn('candidate_profile', function ($Userdata) {
                return $Userdata->candidate_profile;
            })
            ->addColumn('educational_attain', function ($Userdata) {
                return $Userdata->educational_attain;
            })
            ->addColumn('curr_salary', function ($Userdata) {
                return $Userdata->curr_salary;
            })
            ->addColumn('portal', function ($Userdata) {
                return "N/A";
            })
            ->addColumn('date_shifted', function ($Userdata) {
                if (!empty($Userdata->date_shifted && $Userdata->date_shifted != '0000-00-00')) {
                    $date_shifted = date_format(date_create($Userdata->date_shifted), "m-d-Y");
                    return $date_shifted;
                } else {
                    $Userdata->date_shifted = '';
                }

            })
            ->addColumn('career_endo', function ($Userdata) {
                return $Userdata->career_endo;
            })
            ->addColumn('endostatus', function ($Userdata) {
                return $Userdata->endostatus;
            })
            ->addColumn('endi_date', function ($Userdata) {
                if (!empty($Userdata->endi_date && $Userdata->endi_date != '0000-00-00')) {
                    $endi_date = date_format(date_create($Userdata->endi_date), "m-d-Y");
                    return $endi_date;
                } else {
                    $Userdata->endi_date = '';
                }

            })
            ->addColumn('remarks_for_finance', function ($Userdata) {
                return $Userdata->remarks_for_finance;
            })
            ->addColumn('category', function ($Userdata) {
                return "N/A";
            })
            ->addColumn('srp', function ($Userdata) {
                return $Userdata->srp;
            })
            ->addColumn('onboardnig_date', function ($Userdata) {
                if (!empty($Userdata->onboardnig_date && $Userdata->onboardnig_date != '0000-00-00')) {
                    $onboardnig_date = date_format(date_create($Userdata->onboardnig_date), "m-d-Y");
                    return $onboardnig_date;
                } else {
                    $Userdata->onboardnig_date = '';
                }
            })
            ->addColumn('placement_fee', function ($Userdata) {
                return $Userdata->placement_fee;
            })
            ->addColumn('address', function ($Userdata) {
                return $Userdata->address;
            })

            ->rawColumns(['id', 'client', 'gender', 'domain', 'candidate_profile', 'educational_attain',
                'curr_salary', 'portal', 'date_shifted', 'career_endo', 'endostatus', 'endi_date', 'remarks_for_finance', 'category',
                'srp', 'onboardnig_date', 'placement_fee', 'address'])
            ->make(true);
    }
    public function summaryAppend(Request $request)
    {
        // return $request->all();
        $data = [];
        $check = $searchCheck = false;
        // return $request->all();
        $Userdata = DB::table('six_table_view');
        // ->SELECT('six_table_view.*', DB::raw('SUM(six_table_view.srp) as TotalSPR'), DB::raw('SUM(six_table_view.placement_fee) as TotalRevenue'));
        //    check null values coming form selected options
        if (isset($request->domain)) {
            $Userdata->whereIn('six_table_view.domain', $request->domain);
        }
        if (isset($request->recruiter)) {
            $Userdata->whereIn('six_table_view.saved_by', $request->recruiter);
        }
        if (isset($request->client)) {
            // return $request->client;
            $newarr = array();
            foreach ($request->client as $client) {
                //$strc =
                array_push($newarr, "'$client'");
            }
            $Userdata->whereIn('six_table_view.client', $request->client);
        }
        if ($request->cip == 1) {
            $stageArray = [
                'Scheduled for Skills Interview',
                'Scheduled for Technical Interview',
                'Scheduled for Technical exam',
                'Sheduled for Behavioral Interview',
                'Scheduled for account validation',
                'Done Skills interview/ Awaiting Feedback',
                ' Done Techincal Interview /Awaiting Feedback',
                'Done Technical exam /Awaiting Feedback',
                ' Done Behavioral /Awaiting Feedback',
                ' Failed Skills interview',
                ' Failed Techincal Interview',
                'Failed Technical exam',
                'Failed Behavioral Interview',
                'Pending Country Head Interview',
                'Pending Final Interview',
                ' Pending Hiring Managers Interview',
                ' Withdraw / CNI - Mid',
                '   Position Closed (Mid Stage)',
                ' Done Skills/Technical Interview / Awaiting Feedback',
                ' Failed Skills/Technical Interview',
                '  Position On Hold (Mid Stage)',
                ' Scheduled for Behavioral Interview',
                '  Scheduled for Skills/Technical Interview',
                '  Fallout/Reneged',
                'Scheduled for Country Head Interview',
                'Scheduled for Final Interview',
                'Scheduled for Hiring Managers Interview',
                'Done Behavioral Interview / Awaiting Feedback',
                'Done Final Interview / Awaiting Feedback',
                'Done Hiring Managers Interview / Awaiting Feedback',
                'Failed Country Head Interview',
                'Failed Final Interview',
                'Failed Hiring Managers Interview',
                'Scheduled for Job Offer',
                'Shortlisted/For Comparison',
                'Onboarded',
                'Offer accepted',
                'Offer Rejected',
                'Position Closed (Final Stage)',
                'Withdraw / CNI - Final',
                'Done Country Head Interview / Awaiting Feedback',
                'Pending Offer Approval',
                'Pending Offer Schedule',
                'Position On Hold (Final Stage)',
                'Shortlisted',
            ];
            $Userdata->whereIn('six_table_view.remarks_for_finance', $stageArray);
        }
        if (isset($request->residence)) {
            $Userdata->whereIn('six_table_view.address', $request->residence);
        }
        if (isset($request->career_level)) {

            $Userdata->whereIn('six_table_view.career_endo', $request->career_level);
        }
        if (isset($request->category)) {
            $Userdata->whereIn('six_table_view.remarks_for_finance', $request->category);
        }
        if (isset($request->remarks)) {
            $Userdata->whereIn('six_table_view.remarks', $request->remarks);
        }
        if (isset($request->ob_start)) {
            $Userdata->where('six_table_view.onboardnig_date', '>=', $request->ob_start);
        }
        if (isset($request->ob_end)) {
            $Userdata->where('six_table_view.onboardnig_date', '<=', $request->ob_end);
        }
        if (isset($request->sift_start)) {
            $Userdata->where('six_table_view.date_shifted', '>=', $request->sift_start);
        }
        if (isset($request->sift_end)) {
            $Userdata->where('six_table_view.date_shifted', '<=', $request->sift_end);
        }
        if (isset($request->endo_start)) {
            $Userdata->where('six_table_view.endi_date', '>=', $request->endo_start);
        }
        if (isset($request->endo_end)) {
            $Userdata->where('six_table_view.endi_date', '<=', $request->endo_end);
        }
        // //start search
        // if (isset($request->searchKeyword)) {
        //     $searchCheck = true;
        //     $perfect_match = DB::table("six_table_view")->get();

        //     foreach ($perfect_match as $match) {

        //         if (strpos($match->domain, $request->searchKeyword) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.domain', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->saved_by, $request->searchKeyword) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.saved_by', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->client, $request->searchKeyword) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.client', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->remarks_for_finance, $request->searchKeyword) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.remarks_for_finance', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->address, $request->searchKeyword) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.address', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->career_endo, $request->searchKeyword) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.career_endo', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->remarks, $request->searchKeyword) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.remarks', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->onboardnig_date, $request->searchKeyword) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.onboardnig_date', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->date_shifted, $request->searchKeyword) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.date_shifted', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->endi_date, $request->searchKeyword) !== false) {
        //             $check = true;
        //             $Userdata->where('six_table_view.endi_date', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->gender, $request->searchKeyword) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.gender', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->candidate_profile, $request->searchKeyword) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.candidate_profile', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->educational_attain, $request->searchKeyword) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.educational_attain', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->app_status, $request->searchKeyword) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.app_status', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->first_name, $request->searchKeyword) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.first_name', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->last_name, $request->searchKeyword) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.last_name', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->curr_salary, $request->searchKeyword) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.curr_salary', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->placement_fee, $request->searchKeyword) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.placement_fee', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //         if (strpos($match->srp, $request->searchKeyword) !== false) {

        //             $check = true;
        //             $Userdata->where('six_table_view.srp', 'like', '%' . $request->searchKeyword . '%');
        //         }
        //     }
        // }
        // if ($check) {

        //     $user = $Userdata->get();
        // } else {
        //     if (!$check && !$searchCheck) {
        //         $user = $Userdata->get();
        //     } else {
        //         $user = [];
        //     }
        // }
        $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql());
        // $sql = str_replace('*', "*,sum(srp) as TotalSPR,sum(placement_fee) as TotalRevenue", $sql1);
        // return $sql;
        if (isset($request->client)) {
            # code...
            foreach ($request->client as $client) {
                $sql = str_replace($client, "'$client'", $sql);
            }
        }
        // foreach ($request->remarks as $career) {
        //     $sql = str_replace($career, "'$career'", $sql);
        // }
        // $user = $Userdata->get();
        if (strpos($sql, 'where') !== false) {
            $sql_enors = $sql . " and six_table_view.app_status='To Be Endorsed'";
            $sql_active = $sql . " and app_status='Active File'";
            $sql_onboarded = $sql . " and remarks_for_finance='Onboarded'";
            $sql_failed = $sql . " and remarks_for_finance like %fail%'";
            $sql_accepted = $sql . " and remarks_for_finance like %accept%'";
            $sql_withdrawn = $sql . " and remarks_for_finance like %withdraw%'";
            $sql_reject = $sql . " and remarks_for_finance like %reject%'";
            $sql_final = $sql . " and remarks_for_finance like %final%'";
            $sql_mid = $sql . " and remarks_for_finance like %mid%'";
            $sql_initial = $sql . " and remarks_for_finance like %initial%'";
            $sql_fallout = $sql . " and remarks_for_finance LIKE '%fallout%' OR remarks_for_finance LIKE '%replacement%' ";
            $sql_revenue = $sql;

        } else {
            $sql_enors = $sql . "where six_table_view.app_status='To Be Endorsed'";
            $sql_active = $sql . "where app_status='Active File'";
            $sql_onboarded = $sql . "where remarks_for_finance='Onboarded'";
            $sql_failed = $sql . "where remarks_for_finance LIKE '%fail%' ";
            $sql_accepted = $sql . "where remarks_for_finance LIKE '%accept%' ";
            $sql_withdrawn = $sql . "where remarks_for_finance LIKE '%withdraw%' ";
            $sql_reject = $sql . "where remarks_for_finance LIKE '%reject%' ";
            $sql_final = $sql . "where remarks_for_finance LIKE '%final%' ";
            $sql_mid = $sql . "where remarks_for_finance LIKE '%mid%' ";
            $sql_initial = $sql . "where remarks_for_finance LIKE '%initial%' ";
            $sql_fallout = $sql . " where remarks_for_finance LIKE '%fallout%' OR remarks_for_finance LIKE '%replacement%'  ";
            $sql_revenue = $sql;
        }
        // $sifted = 2345;
        // dd($sifted);
        // return $sql_revenue->TotalSPR;
        $sql_spr = 12;
        $sql_revenue = 12;
        $data = [
            // 'Userdata' => $user,
            // 'sifted' => $sifted,
            'endo' => count(DB::select($sql_enors)),
            'active' => count(DB::select($sql_active)),
            'onBoarded' => count(DB::select($sql_onboarded)),
            'failed' => count(DB::select($sql_failed)),
            'accepted' => count(DB::select($sql_accepted)),
            'rejected' => count(DB::select($sql_reject)),
            'final' => count(DB::select($sql_final)),
            'mid' => count(DB::select($sql_mid)),
            'initial' => count(DB::select($sql_initial)),
            'withdrawn' => count(DB::select($sql_withdrawn)),
            'fallout' => count(DB::select($sql_fallout)),
            'revenue' => $sql_revenue,
            'spr' => $sql_spr,
        ];
        return view('smartSearch.summary', $data);
    }
}
