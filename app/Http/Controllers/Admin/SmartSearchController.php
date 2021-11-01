<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Domain;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;
use Str;

class SmartSearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-smart-search', ['only' => ['index']]);
    }
    // index view of finance page starts
    public function index(Request $request)
    {
        $Userdata = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.id as C_id', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*');
        $domain = Domain::all();
        $user = User::where('type', 3)->get();
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $user = $Userdata->offset($page)
            ->limit($limit)
            ->paginate();
        // qurries for summary section start
        $sifted = count($user);
        $onBoarded = count($Userdata->where('endorsements.remarks_for_finance', 'Onboarded')->get());
        $failed = count($Userdata->where('endorsements.remarks_for_finance', 'like', '%Fail%')->get());
        $withdrawn = count($Userdata->where('endorsements.remarks_for_finance', 'like', '%Withdraw%')->get());
        $rejected = count($Userdata->where('endorsements.remarks_for_finance', 'like', '%reject%')->get());
        $accepted = count($Userdata->where('endorsements.remarks_for_finance', 'Offer accepted')->get());
        $spr = count($Userdata->whereNotNull('finance.srp')->get());
        $endo = count($Userdata->where('endorsements.app_status', 'To Be Endorsed')->get());
        $active = count($Userdata->where('endorsements.app_status', 'Active File')->get());
        // close
        $data = [
            'Userdata' => $user,
            'domain' => $domain,
            'user' => $user,
            'sifted' => $sifted,
            'endo' => $endo,
            'active' => $active,
            'onBoarded' => $onBoarded,
            'spr' => $spr,
            'accepted' => $accepted,
            'failed' => $failed,
            'withdrawn' => $withdrawn,
            'rejected' => $rejected,
        ];
        return view('smartSearch.smart_search', $data);
    }
    // close

    // filter record on basis on coming selected options starts
    public function filterSearch(Request $request)
    {
        $data = [];
        // return $request->all();
        $Userdata = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.id as C_id', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*');
        //    check null values coming form selected options
        if (isset($request->domain)) {
            $Userdata->whereIn('candidate_domains.domain', $request->domain);
        }
        if (isset($request->recruiter)) {
            $Userdata->whereIn('candidate_informations.saved_by', $request->recruiter);
        }
        if (isset($request->client)) {
            $Userdata->whereIn('endorsements.client', $request->client);
        }
        if ($request->cip == 1) {
            $stageArray = ['Scheduled for Skills Interview',
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
            $Userdata->whereIn('endorsements.remarks_for_finance', $stageArray);
        }
        if (isset($request->residence)) {
            $Userdata->whereIn('candidate_informations.address', $request->residence);
        }
        if (isset($request->career_level)) {
            $newarr = array();
            foreach ($request->career_level as $career) {
                //$strc =
                array_push($newarr, "'$career'");
            }

            $Userdata->whereIn('endorsements.career_endo', $request->career_level);
        }
        if (isset($request->category)) {
            $Userdata->whereIn('endorsements.remarks_for_finance', $request->category);
        }
        if (isset($request->search)) {
            $arr = ['candidate_informations.gender', 'candidate_informations.first_name'];
            $Userdata->where('candidate_informations.first_name', 'like', '%' . $request->search . '%');
        }
        if (isset($request->status)) {
            $Userdata->whereIn('endorsements.app_status', $request->status);
        }
        if (isset($request->remarks)) {
            $Userdata->whereIn('endorsements.remarks', $request->remarks);
        }
        if (isset($request->sift_start) && !(isset($request->sift_end))) {
            $time = strtotime($request->sift_start);
            $newformat = date('Y-m-d', $time);
            // $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('candidate_domains.date_shifted', '>', $newformat);
        }
        if (isset($request->endo_start) && !(isset($request->endo_end))) {
            $time = strtotime($request->endo_start);
            $newformat = date('Y-m-d', $time);
            // $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('endorsements.endi_date', '>', $newformat);
        }
        if (isset($request->ob_start) && !(isset($request->ob_end))) {
            $time = strtotime($request->ob_start);
            $newformat = date('Y-m-d', $time);
            // $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('finance.onboardnig_date', '>', $newformat);
        }
        if (isset($request->sift_end) && !(isset($request->sift_start))) {
            $time = strtotime($request->sift_end);
            $newformat = date('Y-m-d', $time);
            // $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('candidate_domains.date_shifted', '<', $newformat);
        }
        if (isset($request->ob_end) && !(isset($request->ob_start))) {
            $time = strtotime($request->ob_end);
            $newformat = date('Y-m-d', $time);
            // $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('finance.onboardnig_date', '<', $newformat);
        }
        if (isset($request->endo_end) && !(isset($request->endo_start))) {
            $time = strtotime($request->endo_end);
            $newformat = date('Y-m-d', $time);
            // $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('endorsements.endi_date', '<', $newformat);
        }
        if (isset($request->sift_start) && (isset($request->sift_end))) {
            $time = strtotime($request->sift_start);
            $time1 = strtotime($request->sift_end);
            $newformat = date('Y-m-d', $time);
            $newformat1 = date('Y-m-d', $time1);
            // $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('candidate_domains.date_shifted', '>', $newformat);
            $Userdata->whereDate('candidate_domains.date_shifted', '<', $newformat1);
        }
        if (isset($request->ob_start) && (isset($request->ob_end))) {
            $time = strtotime($request->ob_start);
            $time1 = strtotime($request->ob_end);
            $newformat = date('Y-m-d', $time);
            $newformat1 = date('Y-m-d', $time1);
            // $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('finance.onboardnig_date', '>', $newformat);
            $Userdata->whereDate('finance.onboardnig_date', '<', $newformat1);
        }
        if (isset($request->endo_start) && (isset($request->endo_end))) {
            $time = strtotime($request->endo_start);
            $time1 = strtotime($request->endo_end);
            $newformat = date('Y-m-d', $time);
            $newformat1 = date('Y-m-d', $time1);
            // $nowdate = Carbon\Carbon::now()->format('Y-m-d');
            $Userdata->whereDate('endorsements.endi_date', '>', $newformat);
            $Userdata->whereDate('endorsements.endi_date', '<', $newformat1);
        }

        // binding replaced
        //$sql = str_replace_array('?', $query->getBindings(), $query->toSql());

        $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql());
        if (isset($request->career_level)) {
            # code...
            foreach ($request->career_level as $career) {
                $sql = str_replace($career, "'$career'", $sql);
            }
        }
        // foreach ($request->remarks as $career) {
        //     $sql = str_replace($career, "'$career'", $sql);
        // }
        $user = $Userdata->get();
        // return $user;
        $data = [
            'sifted' => count($Userdata->get()),
            'Userdata' => $user,
            // 'endo' => count(DB::select($sql_enors)),
            // 'active' => count(DB::select($sql_active)),
            // 'onBoarded' => count(DB::select($sql_onboarded)),
            'spr' => $this->getRecordSummary($Userdata, 'endorsements.remarks_for_finance', 'Onboarded'),
            'accepted' => $this->getRecordSummary($Userdata, 'endorsements.remarks_for_finance', 'Offer accepted'),
            'failed' => $this->getRecordSummary($Userdata, 'endorsements.remarks_for_finance', 'Onboarded'),
            'withdrawn' => $this->getRecordSummary($Userdata, 'endorsements.remarks_for_finance', 'Onboarded'),
            'rejected' => $this->getRecordSummary($Userdata, 'endorsements.remarks_for_finance', 'Onboarded'),
        ];
        if ($request->cip == 1) {
            $data['endo'] = 0;
            $data['active'] = 0;
            $data['onBoarded'] = 0;
        } else {

            if (strpos($sql, 'where') !== false) {
                $sql_enors = $sql . "and endorsements.app_status='To Be Endorsed'";
                $sql_active = $sql . "and endorsements.app_status='Active File'";
                $sql_onboarded = $sql . "and endorsements.remarks_for_finance='Onboarded'";
                $data['endo'] = count(DB::select($sql_enors));
                $data['active'] = count(DB::select($sql_active));
                $data['onBoarded'] = count(DB::select($sql_onboarded));
            } else {
                $sql_enors = $sql . "where endorsements.app_status='To Be Endorsed'";
                $sql_active = $sql . "where endorsements.app_status='Active File'";
                $sql_onboarded = $sql . "where endorsements.remarks_for_finance='Onboarded'";
                $data['endo'] = count(DB::select($sql_enors));
                $data['active'] = count(DB::select($sql_active));
                $data['onBoarded'] = count(DB::select($sql_onboarded));
            }
        }
        // dd($user);

        // append data array with view

        // return $data;
        return view('smartSearch.filter_result', $data);

        // $user = $Userdata->get();
        // print_r($user);
        // die();

        $onBoarded = $Userdata->where('endorsements.app_status', 'To Be Endorsed')->count();
        return $onBoarded;
        $active = $Userdata->where('endorsements.app_status', 'Active File')->count();
        // return $Userdata;
        // selected option if close
        // $user = $Userdata;
        // return $this->test($Userdata, 'endorsements.remarks_for_finance', 'Onboarded')['data'];
        // return $this->test($Userdata, 'endorsements.remarks_for_finance', 'Onboarded');
        // return $this->test($Userdata, 'endorsements.remarks_for_finance', 'Onboarded')['count'];
        // $failed = count($faileds->where('endorsements.remarks_for_finance', 'like', '%Fail%')->get());
        // $active = count($Userdata->where('endorsements.app_status', 'Active File')->get());
        // return $active;
        // $onBoarded = count($Userdata->where('endorsements.app_status', 'To Be Endorsed')->get());
        // $withdrawn = count($withdrawns->where('endorsements.remarks_for_finance', 'like', '%Withdraw%')->get());
        // $rejected = count($Userdata->where('endorsements.remarks_for_finance', 'like', '%reject%')->get());
        // $accepted = count($Userdata->where('endorsements.remarks_for_finance', 'Offer accepted')->get());
        // $spr = count($Userdata->whereNotNull('finance.srp')->get());
        // $endo = count($Userdata->where('endorsements.app_status', 'To Be Endorsed')->get());
        // $active = count($Userdata->where('endorsements.app_status', 'Active File')->get());
        // close

    }
    // close
    private function getRecordSummary($mainObject, $target, $condition)
    {
        return count($mainObject->where($target, $condition)->get());
    }
}
