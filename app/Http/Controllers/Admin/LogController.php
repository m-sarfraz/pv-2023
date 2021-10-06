<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Log;

class LogController extends Controller
{
    //
    public function index()
    {
        $logs = Log::orderBy('id', 'DESC')->get();
       
        return view('logs.log', compact('logs'));
    }
}
