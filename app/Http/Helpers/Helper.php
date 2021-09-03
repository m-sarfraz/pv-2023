<?php
namespace  App\Http\Helpers;
use App\DropDown;
class Helper {
    public  static function get_dropdown($type){
        return $data   =   DropDown::with('options')->where('type',$type)->first();
    }

}
