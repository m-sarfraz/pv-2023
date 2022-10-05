<?php

namespace App\Jobs;

use App\Report;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Rap2hpoutre\FastExcel\FastExcel;

class ExtractDataJob implements ShouldQueue
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
        $Userdata = DB::table('data_extract_view');
        //    check null values coming form selected options
        if (isset($this->data['domain'])) {
            $Userdata->whereIn('data_extract_view.DOMAIN ENDORSEMENT', $this->data['domain']);
        }
        if (isset($this->data['client'])) {
            $Userdata->whereIn('data_extract_view.CLIENT', $this->data['client']);
        }

        if (isset($this->data['career_level'])) {
            $Userdata->whereIn('data_extract_view.CAREER LEVEL', $this->data['career_level']);
        }
        if (isset($this->data['category'])) {
            $Userdata->whereIn('data_extract_view.CATEGORY', $this->data['category']);
        }
        if (isset($this->data['remarks'])) {
            $Userdata->whereIn('data_extract_view.REMARKS (For Finance)', $this->data['remarks']);
        }
        if (isset($this->data['sift_start'])) {
            $Userdata->whereDate('data_extract_view.DATE SIFTED', '>=', $this->data['sift_start']);
        }
        if (isset($this->data['sift_end'])) {
            $Userdata->whereDate('data_extract_view.DATE SIFTED', '<=', $this->data['sift_end']);
        }
        if (isset($this->data['endo_start'])) {
            $Userdata->whereDate('data_extract_view.DATE ENDORSED', '>=', $this->data['endo_start']);
        }
        if (isset($this->data['endo_end'])) {
            $Userdata->whereDate('data_extract_view.DATE ENDORSED', '<=', $this->data['endo_end']);
        }
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
            $report = new Report();
            $report->type = 'excel';
            $report->user_id = $this->id;
            $report->export_date = now()->addMinute(60);
            $report->status = 'Processing';
            $report->save();
            try {
                if ((new FastExcel($this->usersGenerator($Userdata)))->headerStyle($header_style)
                    ->rowsStyle($row_style)->export(public_path('storage/reports/' . $fileName . '.xlsx'))) {
                    Report::where('id', $report->id)->update([
                        'download_link' =>$fileName . '.xlsx',
                        'status' => 'Exported',
                    ]);
                }

            } catch (\Exception$e) {
                dd ($e->getMessage());
            }

        }

    }
    public function usersGenerator($Userdata)
    {
        foreach ($Userdata->cursor() as $user) {
            yield $user;
        }
    }
}
