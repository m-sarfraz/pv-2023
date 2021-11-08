<?php

namespace App\Http\Controllers\Admin;

use App\CandidateInformation;
use App\Domain;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;

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
        $user_recruiter = User::where('type', 3)->get();

        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $user = $Userdata->offset($page)
            ->limit($limit)
            ->paginate();
        $count = $Userdata->count();
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
        $address = DB::Select("select address from candidate_informations where  address!='' group by address");
        // close
        $data = [
            'Userdata' => $user,
            'domain' => $domain,
            'user_recruiter' => $user_recruiter,
            'sifted' => $sifted,
            'endo' => $endo,
            'active' => $active,
            'onBoarded' => $onBoarded,
            'count' => $count,
            'spr' => $spr,
            'accepted' => $accepted,
            'failed' => $failed,
            'withdrawn' => $withdrawn,
            'rejected' => $rejected,
            'address' => $address,
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
            return $request->recruiter;
            $Userdata->whereIn('six_table_view.saved_by', $request->recruiter);
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
        //start search
        if (isset($request->searchKeyword)) {
            $searchCheck = true;
            $perfect_match = DB::table("six_table_view")->get();

            foreach ($perfect_match as $match) {
                if (strpos(strtolower($match->domain), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.domain', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.last_name', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->saved_by), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.saved_by', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->client), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.client', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->remarks_for_finance), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.remarks_for_finance', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->address), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.address', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->career_endo), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.career_endo', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->remarks), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.remarks', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->onboardnig_date), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.onboardnig_date', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->date_shifted), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.date_shifted', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->endi_date), strtolower($request->searchKeyword)) !== false) {
                    $check = true;
                    $Userdata->where('six_table_view.endi_date', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->gender), strtolower($request->searchKeyword)) !== false) {

                    $check = true;
                    $Userdata->where('six_table_view.gender', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->candidate_profile), strtolower($request->searchKeyword)) !== false) {

                    $check = true;
                    $Userdata->where('six_table_view.candidate_profile', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->educational_attain), strtolower($request->searchKeyword)) !== false) {

                    $check = true;
                    $Userdata->where('six_table_view.educational_attain', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->app_status), strtolower($request->searchKeyword)) !== false) {

                    $check = true;
                    $Userdata->where('six_table_view.app_status', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->first_name), strtolower($request->searchKeyword)) !== false) {

                    $check = true;
                    $Userdata->where('six_table_view.first_name', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->last_name), strtolower($request->searchKeyword)) !== false) {

                    $check = true;
                    $Userdata->where('six_table_view.last_name', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->curr_salary), strtolower($request->searchKeyword)) !== false) {

                    $check = true;
                    $Userdata->where('six_table_view.curr_salary', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->placement_fee), strtolower($request->searchKeyword)) !== false) {

                    $check = true;
                    $Userdata->where('six_table_view.placement_fee', 'like', '%' . $request->searchKeyword . '%');
                }
                if (strpos(strtolower($match->srp), strtolower($request->searchKeyword)) !== false) {

                    $check = true;
                    $Userdata->where('six_table_view.srp', 'like', '%' . $request->searchKeyword . '%');
                }
            }
        }
        if ($check) {

            $user = $Userdata->get();
        } else {
            if (!$check && !$searchCheck) {
                $user = $Userdata->get();
            } else {
                $user = [];
            }
        }

        $onBoarded = count($Userdata->get());

        $data = [

            'Userdata' => $user,
            'onBoarded' => $onBoarded,
        ];
        return view('smartSearch.filter_result', $data);

        // close

    }
    // close
    private function getRecordSummary($mainObject, $target, $condition)
    {
        return count($mainObject->where($target, $condition)->get());
    }
}
