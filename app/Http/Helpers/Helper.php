<?php

namespace App\Http\Helpers;

use App\CandidateInformation;
use App\DropDown;
use App\Log;
use App\User;
use Auth;
use DB;
use Str;

class Helper
{
    public static function get_dropdown($type)
    {
        return $data = DropDown::with([
            'options' => function ($q1) {
                return $q1->orderBy('option_name')->distinct('option_name');
            }])->where('type', $type)->first();

        // return $data = DropDown::with('options')->where('type', $type)->first();
    }
    public static function save_log($action)
    {
        $log = new Log();
        $log->action = $action;
        $id = Auth::user()->id;
        $log->action_by = $id;
        $log->save();
        return;
    }
    public static function updateTapRecord()
    {
        DB::Select('UPDATE endorsements SET origionalRecruiterName = (SELECT name FROM users WHERE users.id = endorsements.origionalRecruiter),
        tapName = (SELECT name FROM users WHERE users.id = endorsements.tap)');
    }
    public static function user_data()
    {
        // join the tables to get ccandidate data
        $Userdata = CandidateInformation::join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.id as cid', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->paginate(20);
        return $Userdata;
    }
    public static function get_permission($type)
    {
        return $permission = DB::table('permissions')->where('type', $type)->get();

    }
    // get category type of active-inactive of final/mid/initial stages
    public static function getCategory($array)
    {
        // save category of arrays for finance
        if ($array != '') {
            $array = Str::lower($array);
            if (str_contains($array, Str::lower("Scheduled for Country Head Interview")) ||
                str_contains($array, Str::lower("Scheduled for Final Interview")) ||
                str_contains($array, Str::lower("Scheduled for Hiring Manager's Interview")) ||
                str_contains($array, Str::lower("Done Behavioral Interview / Awaiting Feedback")) ||
                str_contains($array, Str::lower("Done Final Interview / Awaiting Feedback")) ||
                str_contains($array, Str::lower("Done Hiring Manager's Interview / Awaiting Feedback")) ||
                str_contains($array, Str::lower("Scheduled for Job Offer")) ||
                str_contains($array, Str::lower("Shortlisted/For Comparison")) ||
                str_contains($array, Str::lower("Offer accepted")) ||
                str_contains($array, Str::lower("Done Country Head Interview / Awaiting Feedback")) ||
                str_contains($array, Str::lower("Pending Offer Approval")) ||
                str_contains($array, Str::lower("Pending Offer Schedule")) ||
                str_contains($array, Str::lower("Shortlisted"))) {
                $category = 'Active - Final Stage';
                return $category;
            }
            if (str_contains($array, Str::lower("Failed Country Head Interview")) ||
                str_contains($array, Str::lower("Failed Final Interview")) ||
                str_contains($array, Str::lower("Failed Hiring Manager's Interview")) ||
                str_contains($array, Str::lower("Offer Rejected")) ||
                str_contains($array, Str::lower("Position Closed (Final Stage)")) ||
                str_contains($array, Str::lower("Withdraw / CNI - Final")) ||
                str_contains($array, Str::lower("Fallout")) ||
                str_contains($array, Str::lower("Reneged")) ||
                str_contains($array, Str::lower("Position On Hold (Final Stage)"))) {
                $category = 'Inactive - Final Stage';
                return $category;
            }
            if (str_contains($array, Str::lower("Onboarded"))) {
                $category = 'Converted - Final Stage';
                return $category;
            }
            if (str_contains($array, Str::lower("For Initial Paper Screening")) ||
                str_contains($array, Str::lower("Pending HRI")) ||
                str_contains($array, Str::lower("Pending Skills Interview")) ||
                str_contains($array, Str::lower("Pending for online exam")) ||
                str_contains($array, Str::lower("Pending Behavioral Interview"))
                || str_contains($array, Str::lower("Pending Call Simulation/mock call")) ||
                str_contains($array, Str::lower("Scheduled for HRI"))
                || str_contains($array, Str::lower("Scheduled for Online Exam"))
                || str_contains($array, Str::lower("Scheduled Call Simulation/mock call"))
                || str_contains($array, Str::lower("Done Initial Interview")) ||
                str_contains($array, Str::lower("Done Language Assessment Exam"))
                || str_contains($array, Str::lower("Done Online exam"))
                || str_contains($array, Str::lower("Done Hiring Manager's Interview / Awaiting Feedback")) ||
                str_contains($array, Str::lower("Pending CHR Approval")) ||
                str_contains($array, Str::lower("Pending Interview Process")) ||
                str_contains($array, Str::lower("Pending Skills/Technical Interview")) ||
                str_contains($array, Str::lower("Pending Skills Interview")) ||
                str_contains($array, Str::lower("Pending Validation"))) {
                $category = 'Active - Initial Stage';
                return $category;
            }
            if (str_contains($array, Str::lower("Pending DB Validation")) ||
                str_contains($array, Str::lower("In Client's DB/Portal")) ||
                str_contains($array, Str::lower("No show (initial)")) ||
                str_contains($array, Str::lower("Failed HRI")) ||
                str_contains($array, Str::lower("Failed Initial Paper Screening"))
                || str_contains($array, Str::lower("Failed Language Assessment exam"))
                || str_contains($array, Str::lower("Failed Call Simulation/Mock Call")) ||
                str_contains($array, Str::lower("Withdraw - CNI"))
                || str_contains($array, Str::lower("Withdraw / CNI - Initial"))
                || str_contains($array, Str::lower("Position On Hold (Initial)"))
                || str_contains($array, Str::lower("Failed HM Paperscreening")) ||
                str_contains($array, Str::lower("Failed Initial Interview"))
                || str_contains($array, Str::lower("Failed Online Assessment/Exam"))
                || str_contains($array, Str::lower("Position Closed (Initial)")) ||
                str_contains($array, Str::lower("Sourced by Other Vendor"))) {
                $category = 'Inactive - Initial Stage';
                return $category;
            }
            if (str_contains($array, Str::lower("Failed Skills interview")) ||
                str_contains($array, Str::lower("Failed Techincal Interview")) ||
                str_contains($array, Str::lower("Failed Technical exam")) ||
                str_contains($array, Str::lower("Failed Behavioral Interview")) ||
                str_contains($array, Str::lower("Withdraw / CNI - Mid"))
                || str_contains($array, Str::lower("Position Closed (Mid Stage)"))
                || str_contains($array, Str::lower("Failed Skills/Technical Interview")) ||
                str_contains($array, Str::lower("Position On Hold (Mid Stage)"))
                || str_contains($array, Str::lower("Failed Account Validation"))) {
                $category = 'Inactive - Mid Stage';
                return $category;
            }
            if (str_contains($array, Str::lower("Scheduled for Skills Interview")) ||
                str_contains($array, Str::lower("Scheduled for Technical Interview")) ||
                str_contains($array, Str::lower("Scheduled for Technical exam")) ||
                str_contains($array, Str::lower("Sheduled for Behavioral Interview")) ||
                str_contains($array, Str::lower("Scheduled for account validation"))
                || str_contains($array, Str::lower("Done Skills interview/ Awaiting Feedback"))
                || str_contains($array, Str::lower("Done Techincal Interview /Awaiting Feedback")) ||
                str_contains($array, Str::lower("Done Technical exam /Awaiting Feedback"))
                || str_contains($array, Str::lower("Done Behavioral /Awaiting Feedback"))
                || str_contains($array, Str::lower("Pending Country Head Interview"))
                || str_contains($array, Str::lower("Pending Final Interview")) ||
                str_contains($array, Str::lower("Pending Hiring Manager's Interview"))
                || str_contains($array, Str::lower("Done Skills/Technical Interview / Awaiting Feedback"))
                || str_contains($array, Str::lower("Scheduled for Behavioral Interview")) ||
                str_contains($array, Str::lower("Scheduled for Skills/Technical Interview"))) {
                $category = 'Active - Mid Stage';
                return $category;
            }
            $category = '';
            return $category;

            // close
        }
        return '';

    }
}
