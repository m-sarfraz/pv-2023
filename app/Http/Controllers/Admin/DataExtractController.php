<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ExtractDataJob;
use Auth;
use DB;
use File;
use Helper;
use Illuminate\Http\Request;

class DataExtractController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        if (Auth::user()->type != 1) {
            return redirect()->back();
        } else {
            return view('extract-data');
        }
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
        ini_set('max_execution_time', -1); //-1 seconds = infinite
        ini_set('memory_limit',  -1); //1000M  = 1 GB
        $data = $request->all(); 
        $id = Auth::user()->id;
        // dispatch ob for exporting the data
        ExtractDataJob::dispatch($data, $id)->delay(now());
        // return response()->json(['warning' => true, 'message' => 'Data Extraction has been Started!']);

    }
    // close

    public function getReportHistory()
    {
        return response()->view('report-history');
    }
    public function downloadReport(Request $request)
    {
        // return $request->all();
        // ini_set('memory_limit', '9072M');
        // ini_set('MAX_EXECUTION_TIME', '-1');
        // set_time_limit(10 * 60);

        // $fullFolderZipFile  = public_path().'/export/'.date('ym');
        // $filePath           = $fullFolderZipFile.'/'.$request->fileName;
        $filePath = storage_path('app/' . $request->file_name);
        $nameDownload = "test";
        if (file_exists($filePath)) {
            $byteS = filesize($filePath);
            $mb = number_format($byteS / 1048576, 2);
            // if ($mb > 10) {
            //     $filePathZip = ZipUtil::generateZipFromFile($filePath, $fullFolderZipFile, $request->file_name);
            //     $nameDownload .= ".zip";
            // } else {

            $filePathZip = $filePath;
            $nameDownload .= "." . pathinfo($request->file_name, PATHINFO_EXTENSION);
            // }

            $mimeType = File::mimeType($filePathZip);
            // dd ('mimetpe is'. $mimeType);
            return response()->download($filePathZip, $nameDownload, [
                'Content-Type' => $mimeType,
                'Content-Encoding' => 'Shift-JIS',
            ]);
            // ->deleteFileAfterSend(true);
        }
        // return '';
    }

}
