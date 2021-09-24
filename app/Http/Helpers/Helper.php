<?php
namespace App\Http\Helpers;

use App\DropDown;
use App\log;
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

}
