<?php

namespace App\Http\Controllers;

class ErrorController extends Controller
{
    public function pageNotFound()
    {
        return view('404.404');
    }
}
