<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataExtractController extends Controller
{
    public function index()
    {
        return view('extract-data');
    }
    public function appendFilterOptions(Request $request)
    {
        $domain = Domain::all();
        $user_recruiter = User::where('type', 3)->get();
        $client = jdl::get('clients');
        $address = DB::Select("select address from candidate_informations where  address!='' group by address");
        $remarks = Helper::get_dropdown('remarks_for_finance');
        $status = Helper::get_dropdown('data_entry_status');

        // close
        return response()->json(
            [
                'domain' => $domain,
                'user_recruiter' => $user_recruiter,
                'client' => $client,
                'address' => $address,
                'status' => $status,
                'remarks' => $remarks,
            ]
        );
    }
}
