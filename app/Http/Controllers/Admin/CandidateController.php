<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function data_entry(){
        return view ('data_entry.add');
    }
    public function save_data_entry(Request $request){
      dd($request->all());
    }
}
