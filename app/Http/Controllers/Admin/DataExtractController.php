<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $Userdata = DB::table('data_extract_view');
        //    check null values coming form selected options
        if (isset($request->domain)) {
            $Userdata->whereIn('data_extract_view.domain', $request->domain);
        }
        if (isset($request->client)) {
            $Userdata->whereIn('data_extract_view.client', $request->client);
        }

        if (isset($request->career_level)) {
            $Userdata->whereIn('data_extract_view.career_endo', $request->career_level);
        }
        // if (isset($request->category)) {
        //     $Userdata->whereIn('data_extract_view.category', $request->category);
        // }
        if (isset($request->remarks)) {
            $Userdata->whereIn('data_extract_view.remarks_for_finance', $request->remarks);
        }
        if (isset($request->sift_start)) {
            $Userdata->whereDate('data_extract_view.date_shifted', '>=', $request->sift_start);
        }
        if (isset($request->sift_end)) {
            $Userdata->whereDate('data_extract_view.date_shifted', '<=', $request->sift_end);
        }
        if (isset($request->endo_start)) {
            $Userdata->whereDate('data_extract_view.endi_date', '>=', $request->endo_start);
        }
        if (isset($request->endo_end)) {
            $Userdata->whereDate('data_extract_view.endi_date', '<=', $request->endo_end);
        }
        $user = $Userdata->get();
        return $user;
    }
    // close

}
