<?php

namespace App\Jobs;

use App\Exports\DataExport;
use App\JDLReportB;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use Str; 
class JDLExtractDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $data;
    private $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $id)
    {
        $this->data = $data;
        $this->id = $id;  
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //  cron job path
        // /usr/local/bin/php /home/vcclink/public_html/artisan schedule:run
        ini_set('max_execution_time', -1); //-1 seconds = infinite
        ini_set('memory_limit', -1); //1000M  = 1 GB

        $Userdata = DB::table('jdl_extract_view');
        //    check null values coming form selected options
        if (isset($this->data['client'])) {
            $Userdata->whereIn('jdl_extract_view.CLIENT', $this->data['client']);
        }
        if (isset($this->data['domain'])) {
            $Userdata->whereIn('jdl_extract_view.DOMAIN', $this->data['domain']);
        }
        if (isset($this->data['segment'])) {
            $Userdata->whereIn('jdl_extract_view.SEGMENT',    $this->data['segment']);
        }
        if (isset($this->data['subSegment'])) {
            $Userdata->whereIn('jdl_extract_view.SUBSEGMENT',    $this->data['subSegment']);
        }
        if (isset($this->data['position_title'])) {
            $Userdata->whereIn('jdl_extract_view.POSITION TITLE',    $this->data['position_title']);
        } 
        if (isset($this->data['career_level'])) {
            $Userdata->whereIn('jdl_extract_view.CAREER LEVEL', $this->data['career_level']);
        } 
        if (isset($this->data['status'])) {
            $Userdata->whereIn('jdl_extract_view.STATUS', $this->data['status']);
        }
        if (isset($this->data['location'])) {
            $Userdata->whereIn('jdl_extract_view.LOCATION', $this->data['location']);
        }
        if (isset($this->data['keyword'])) {
            $Userdata->whereIn('jdl_extract_view.KEYWORD(overlapping)', $this->data['keyword']);
        }
        if (isset($this->data['priority'])) {
            $Userdata->where('jdl_extract_view.PRIORITY', $this->data['priority']);
        }
        if (isset($this->data['assignment'])) {
            $Userdata->where('jdl_extract_view.ASSIGNMENT',  $this->data['assignment']);
        }
        if (isset($this->data['wschedule'])) {
            $Userdata->whereDate('jdl_extract_view.WORK SCHEDULE', $this->data['wschedule']);
        }
 
    //    dd( $sql = Str::replaceArray('?', $Userdata->getBindings(), $Userdata->toSql()));
    //     dd($Userdata->get());
        $header_style = (new StyleBuilder())
            ->setFontSize(12)
            ->setShouldWrapText(false)
            ->setBackgroundColor("EDEDED")
            ->setFontBold()
            ->build();
        $row_style = (new StyleBuilder())
            ->setFontSize(10)
            ->setShouldWrapText(false)
            ->setBackgroundColor("FFFFFF")
            ->build();

        if ($Userdata) { 
            $fileName = time();
            $report = new JDLReportB();
            $report->type = 'CSV';
            $report->user_id = $this->id;
            $report->export_date = now()->addMinute(60);
            $report->status = 'Processing';
            $report->save();
            try {
                // Or save the file to disk
                $headers = DB::getSchemaBuilder()->getColumnListing('jdl_extract_view');

                $collection = $Userdata->get();
                $dataExport = new DataExport($collection, $headers);
                Storage::put('public/data.txt', $dataExport);
                if (Excel::store($dataExport,'JDL-'. $fileName . '.csv', 'excel_uploads')) {
                    JDLReportB::where('id', $report->id)->update([
                        'download_link' =>'JDL-'. $fileName . '.csv',
                        'status' => 'Exported',
                    ]);
                }
                // if ((new FastExcel($this->usersGenerator($Userdata)))->headerStyle($header_style)
                //     ->rowsStyle($row_style)->export(public_path('storage/reports/' . $fileName . '.xlsx'))) {
                //     Report::where('id', $report->id)->update([
                //         'download_link' =>$fileName . '.xlsx',
                //         'status' => 'Exported',
                //     ]);  
                // }

            } catch (\Exception$e) {
                dd($e->getMessage());
            }

        }

    }
}
