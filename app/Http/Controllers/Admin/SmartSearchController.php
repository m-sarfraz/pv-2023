<?php

namespace App\Http\Controllers\Admin;

use App\Domain;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Helper;
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
        return view('smartSearch.smart_search');
    }
    // close

    // filter record on basis on coming selected options starts
    public function filterSearch(Request $request)
    {
        $data = [];
        $check = $searchCheck = false;
        // return $request->all();
        $Userdata =  DB::table('smart_view');
        //    check null values coming form selected options
        if (isset($request->domain)) {
            $Userdata->whereIn('smart_view.domain', $request->domain);
        }
        if (isset($request->recruiter)) {
            $Userdata->whereIn('smart_view.saved_by', $request->recruiter);
        }
        if (isset($request->status)) {
            $Userdata->whereIn('smart_view.status', array($request->status));
        }
        if (isset($request->client)) {
            // return $request->client;
            $Userdata->whereIn('smart_view.client', $request->client);
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
            $Userdata->whereIn('smart_view.remarks_for_finance', $stageArray);
        }
        if (isset($request->residence)) {
            $Userdata->whereIn('smart_view.address', $request->residence);
        }
        if (isset($request->career_level)) {

            $Userdata->whereIn('smart_view.career_endo', $request->career_level);
        }
        if (isset($request->category)) {
            $Userdata->whereIn('smart_view.remarks_for_finance', $request->category);
        }
        if (isset($request->remarks)) {
            $Userdata->whereIn('smart_view.remarks', $request->remarks);
        }
        if (isset($request->ob_start)) {
            $Userdata->whereDate('smart_view.onboardnig_date', '>=', $request->ob_start);
        }
        if (isset($request->ob_end)) {
            $Userdata->whereDate('smart_view.onboardnig_date', '<=', $request->ob_end);
        }
        if (isset($request->sift_start)) {
            $Userdata->whereDate('smart_view.date_shifted', '>=', $request->sift_start);
        }
        if (isset($request->sift_end)) {
            $Userdata->whereDate('smart_view.date_shifted', '<=', $request->sift_end);
        }
        if (isset($request->endo_start)) {
            $Userdata->whereDate('smart_view.endi_date', '>=', $request->endo_start);
        }
        if (isset($request->endo_end)) {
            $Userdata->whereDate('smart_view.endi_date', '<=', $request->endo_end);
        }
        $user = $Userdata->get();
        return Datatables::of($user)
            ->addColumn('recruiter', function ($Userdata) {
                return $Userdata->recruiter;
            })
            ->addColumn('candidate', function ($Userdata) {
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
            ->addColumn('app_status', function ($user) {
                return $user->status;
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
                'curr_salary', 'portal', 'date_shifted', 'career_endo', 'app_status', 'endi_date', 'remarks_for_finance', 'category',
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

        $allData = DB::table('smart_view');
        return Datatables::of($allData)
        // ->addIndexColumn()
            ->addColumn('recruiter', function ($allData) {
                // $name = DB::select('select last_name from  candidate_informations where id=' . $allData->id);
                return $allData->recruiter;
            })
            ->addColumn('candidate', function ($allData) {
                // $name = DB::select('select last_name from  candidate_informations where id=' . $allData->id);
                return $allData->last_name;
            })
            ->addColumn('client', function ($allData) {
                return $allData->client;
            })
            ->addColumn('gender', function ($allData) {
                return $allData->gender;
            })
            ->addColumn('domain', function ($allData) {
                return $allData->domain;
            })
            ->addColumn('candidate_profile', function ($allData) {
                return $allData->candidate_profile;
            })
            ->addColumn('educational_attain', function ($allData) {
                return $allData->educational_attain;
            })
            ->addColumn('curr_salary', function ($allData) {
                return $allData->curr_salary;
            })
            ->addColumn('portal', function ($allData) {
                return "N/A";
            })
            ->addColumn('date_shifted', function ($allData) {
                if (!empty($allData->date_shifted && $allData->date_shifted != '0000-00-00')) {
                    $date_shifted = date_format(date_create($allData->date_shifted), "m-d-Y");
                    return $date_shifted;
                } else {
                    $allData->date_shifted = '';
                }

            })
            ->addColumn('career_endo', function ($allData) {
                return $allData->career_endo;
            })
            ->addColumn('app_status', function ($allData) {
                return $allData->status;
            })
            ->addColumn('endi_date', function ($allData) {
                if (!empty($allData->endi_date && $allData->endi_date != '0000-00-00')) {
                    $endi_date = date_format(date_create($allData->endi_date), "m-d-Y");
                    return $endi_date;
                } else {
                    $allData->endi_date = '';
                }

            })
            ->addColumn('remarks_for_finance', function ($allData) {
                return $allData->remarks_for_finance;
            })
            ->addColumn('category', function ($allData) {
                return "N/A";
            })
            ->addColumn('srp', function ($allData) {
                return $allData->srp;
            })
            ->addColumn('onboardnig_date', function ($allData) {
                if (!empty($allData->onboardnig_date && $allData->onboardnig_date != '0000-00-00')) {
                    $onboardnig_date = date_format(date_create($allData->onboardnig_date), "m-d-Y");
                    return $onboardnig_date;
                } else {
                    $allData->onboardnig_date = '';
                }
            })
            ->addColumn('placement_fee', function ($allData) {
                return $allData->placement_fee;
            })
            ->addColumn('address', function ($allData) {
                return $allData->address;
            })

            ->rawColumns(['id', 'client', 'gender', 'domain', 'candidate_profile', 'educational_attain',
                'curr_salary', 'portal', 'date_shifted', 'career_endo', 'app_status', 'endi_date', 'remarks_for_finance', 'category',
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
    public function appendSmartFilters()
    {
        $domain = Domain::all();
        $user_recruiter = User::where('type', 3)->get();
        $client = Helper::get_dropdown('clients');
        $address = DB::Select("select address from candidate_informations where  address!='' group by address");
        $remarks = Helper::get_dropdown('remarks_for_finance');
        $status = Helper::get_dropdown('data_entry_status');

        // close
        return response()->json(
            [
                'domain' => $domain,
                'user_recruiter' => $user_recruiter,
                'client' => $client,
                'address' => $address,
                'status' => $status,
                'remarks' => $remarks,
            ]);
    }
}
