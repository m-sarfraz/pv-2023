<?php

namespace App\Http\Controllers\Admin;

use App\DropDown;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DropDownController extends Controller
{
    public function add_option(){

    }
    public function view_dropdown(){
        $dropdowns   =   DropDown::all();
        return view('dropdown.add_dropdown',compact('dropdowns'));
    }
}
