<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ExtractDataJob;
use DB;
use Helper;
use Illuminate\Http\Request;

class DataExtractController extends Controller
{
    public function index()
    {
        return view('extract-data');
    }

    // append filter options on page load
    public function appendFilterOptions(Request $request)
    {
        $domain = DB::table('domains')->get();
        $client = DB::table('jdl')->select('client')->groupBy('client')->get();
        $career = Helper::get_dropdown('career_level');
        $remarks = Helper::get_dropdown('remarks_for_finance');
        $status = Helper::get_dropdown('application_status');

        // close
        return response()->json(
            [
                'domain' => $domain,
                'client' => $client,
                'career' => $career,
                'remarks' => $remarks,
                'status' => $status,
            ]
        );
    }
    // close

    // extract data function
    public function extractData(Request $request)
    {
        ini_set('max_execution_time', 30000); //30000 seconds = 500 minutes
        ini_set('memory_limit', '1000M');  //1000M  = 1 GB
        $data = $request->all();
        // dispatch ob for exporting the data
        ExtractDataJob::dispatch($data)->delay(now());
    }
    // close

}
