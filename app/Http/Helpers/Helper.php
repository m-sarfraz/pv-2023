<?php
namespace App\Http\Helpers;

use App\CandidateInformation;
use App\DropDown;
use App\Log;
use App\User;
use Auth;

class Helper
{
    public static function get_dropdown($type)
    {
        return $data = DropDown::with('options')->where('type', $type)->first();
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
    public static function user_data()
    {
        // join the tables to get ccandidate data
        $Userdata = CandidateInformation::
            join('candidate_educations', 'candidate_informations.id', 'candidate_educations.candidate_id')
            ->join('candidate_positions', 'candidate_informations.id', 'candidate_positions.candidate_id')
            ->join('candidate_domains', 'candidate_informations.id', 'candidate_domains.candidate_id')
            ->join('endorsements', 'candidate_informations.id', 'endorsements.candidate_id')
            ->join('finance', 'candidate_informations.id', 'finance.candidate_id')
            ->select('candidate_educations.*', 'candidate_informations.id as cid', 'candidate_informations.*', 'candidate_positions.*', 'candidate_domains.*', 'finance.*', 'endorsements.*')
            ->paginate(20);
        return $Userdata;
    }

}
