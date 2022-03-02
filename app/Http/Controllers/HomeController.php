<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Cipprogress;
use App\traverse2;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    public $size_of_Traget = 2000000;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // return Auth::user()->roles->pluck('id');
        // echo sys_get_temp_dir() . "\n";
        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');



        $Admin_team = Cipprogress::where("team", "Admin")->orderBy('id', 'ASC')->get();

        $Current_date = date('Y-m-d');
        $weekly = date('Y-m-d', strtotime($Current_date . ' - 7 days'));
        $Mounthly = date('Y-m-d', strtotime($Current_date . ' - 1 months'));
        $Quarterly = date('Y-m-d', strtotime($Current_date . ' - 3 months'));
        $data = DB::table('roles')->where('team_revenue', 1)->get('id');

        $check = [];
        $append = [];
        $sum_ongoing_ = [];
        foreach ($data as $render) {
            array_push($check, $render->id);
        }

        for ($i = 0; $i < count($check); $i++) {



            $weekly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance` 
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` = ' . $check[$i] . ' 
            and `cip_progress`.`created_at` > ' . $weekly . '
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');

            $Mounthly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance` 
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` = ' . $check[$i] . ' 
            and `cip_progress`.`created_at` > ' . $Mounthly . '
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            // die();
            $Quarterly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance` 
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` > ' .  $Quarterly . '
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');


            $count_final_stage_[$i] = Cipprogress::where("t_id", $check[$i])->where("final_stage", 1)->get();
            $count_mid_stage_[$i] = Cipprogress::where("t_id", $check[$i])->where("mid_stage", 1)->get();
            $count_onboarded_[$i] = Cipprogress::where("t_id", $check[$i])->where("onboarded", 1)->get();
            $count_offere_[$i] = Cipprogress::where("t_id", $check[$i])->where("offered", 1)->get();
            //last column //
            $failed_mid_stage_[$i]   = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            inner join `endorsements` on `endorsements`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`mid_stage` = 1
            and `endorsements`.`remarks_for_finance`="FAILED"');

            $failed_final_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            inner join `endorsements` on `endorsements`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `endorsements`.`remarks_for_finance`like "%AILED%"');
            $onborded_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            inner join `endorsements` on `endorsements`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `endorsements`.`remarks_for_finance` like "%nboar%"');
            $offer_stage_[$i]  = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            inner join `endorsements` on `endorsements`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `endorsements`.`remarks_for_finance`="Offer Accepted"');
            //last column //



            $count_user_pie_[$i] = new SampleChart();
            $count_user_pie_[$i]->labels(['Actual', 'CIP-Target']);
            $count_user_pie_[$i]->dataset('my chart', 'pie', [isset($Quarterly_data_[$i][0]) ? $Quarterly_data_[$i][0]->f_srp : 0, 400000])
                ->options(
                    [
                        'fill' => 'true',
                        'borderColor' => ['green', 'orange'],
                        'backgroundColor' => ['green', "orange"],
                    ]
                );

            // $no_of_ongoing
            $total_ogoing_final = DB::select('SELECT SUM(`final_stage`) as `sumfinal` FROM `cip_progress` WHERE `t_id`="' . $check[$i] . '" AND (`mid_stage`=1 OR `final_stage`=1);');
            $total_ogoing_mid = DB::select('SELECT SUM(`mid_stage`) as `summid` FROM `cip_progress` WHERE `t_id`="' . $check[$i] . '"  AND (`mid_stage`=1 OR `final_stage`=1);');

            // $no_of_ongoing
            $sum_ongoing_[$i] = 0 + 0;
            // $sum_ongoing_[$i] = number_format($total_ogoing_final[0]->sumfinal) + number_format($total_ogoing_mid[0]->summid);
            $total_ogoing_Last_column[$i] =  DB::select('select SUM(finance.srp) as f_srp from `finance` 
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            $incentive_base_revenue_[$i] = DB::select('select sum(`finance_detail`.`vcc_amount`) as Sume FROM `finance_detail`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance_detail`.`candidate_id`
            where `cip_progress`.`t_id`=' . $check[$i] . '');
            $PDM_LessShare_[$i] = DB::select('select sum(`finance_detail`.`c_take`) as Sume FROM `finance_detail`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance_detail`.`candidate_id`
            where `cip_progress`.`t_id`=' . $check[$i] . '');
            $data_loop = [
                "weekly_data_" . $i => $weekly_data_[$i],
                "Mounthly_data_" . $i => $Mounthly_data_[$i],
                "Quarterly_data_" . $i => $Quarterly_data_[$i],
                "count_final_stage_" . $i => $count_final_stage_[$i],
                "count_mid_stage_" . $i => $count_mid_stage_[$i],
                "count_user_pie_" . $i => $count_user_pie_[$i],
                "count_onboarded_" . $i => $count_onboarded_[$i],
                "count_offere_" . $i => $count_offere_[$i],
                "total_ogoing_" . $i => $sum_ongoing_[$i],
                "lastColumnsec_row_" . $i => $total_ogoing_Last_column[$i],
                "failed_mid_stage_" . $i => $failed_mid_stage_[$i],
                "failed_final_stage_" . $i => $failed_final_stage_[$i],
                "onborded_stage_" . $i => $onborded_stage_[$i],
                "offer_stage_" . $i => $offer_stage_[$i],
                "incentive_base_revenue_" . $i => $incentive_base_revenue_[$i],
                "PDM_LessShare_" . $i => $PDM_LessShare_[$i]

            ];

            array_push($append, $data_loop);
        }


        // total nio of ongoin
        $sum_incentive_of_revenue_team = 0;
        $f = [];
        $sume = 0;
        $single_sume = [];
        foreach ($append as $key => $value) {
            $sum_incentive_of_revenue_team = $value['incentive_base_revenue_' . $key];
            array_push($f, $sum_incentive_of_revenue_team);
        }
        foreach ($f as $key => $valueinner) {

            if (isset($valueinner[$key]->Sume)) {
                $sume += $valueinner[$key]->Sume;
            }
        }
        foreach ($f as $key => $valueinner) {

            if (isset($valueinner[$key]->Sume)) {
                $sume = $valueinner[$key]->Sume;
                array_push($single_sume, $sume);
            }
        }


        $total_incentive_base_revenue = count($check) * $this->size_of_Traget;
        $del = new SampleChart();
        $del->labels(['Inventice Based Revenue', 'TAT']);
        $del->dataset('my chart', 'pie', [$sume, $total_incentive_base_revenue])->options([
            'fill' => 'true',
            'borderColor' => ['green', 'orange'],
            'backgroundColor' => ['green', 'orange'],
        ]);


        //close del
        ///first graph
        $a = [];
        $sum_incentive_of_revenue_team = '';
        $h = [];
        $pluck_name = '';
        $data_for_team_revenue = DB::table('roles')->where('team_revenue', 1)->get();
        foreach ($data_for_team_revenue as  $value) {

            $sum_incentive_of_revenue_team = $value->name;

            array_push($a, $sum_incentive_of_revenue_team);
        }


        $chart = new SampleChart();

        $chart->labels($a);
        $chart->dataset('TAT ', 'bar', [$this->size_of_Traget, $this->size_of_Traget, $this->size_of_Traget, $this->size_of_Traget])->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(253, 152, 0)',
            'backgroundColor' => 'rgb(253, 152, 0)',

        ]);
        $chart->dataset('Incentive Based Revenue', 'bar', $single_sume)->options([
            // 'fill' => 'false',
            'borderColor' => 'green',
            'backgroundColor' => 'green',

        ]);
        //first graph
        //second graph
        $count_user_pie = new SampleChart();
        $count_user_pie->labels(['Inventice Based Revenue', 'TAT']);
        $count_user_pie->dataset('my chart', 'pie', [$sume, $total_incentive_base_revenue])->options([
            'fill' => 'true',
            'borderColor' => ['green', 'orange'],
            'backgroundColor' => ['green', 'orange'],
        ]);
        //second graph
        $data = [
            "Admin_team" => $Admin_team,
            "chart" => $chart,
            "count_user_pie" => $count_user_pie,
            "append" => $append,
            "del" => $del,
            "Quarterly" => $Quarterly,
            "TAT" => $this->size_of_Traget

        ];
        return view('home', $data);
    }
    public function filterByDate(Request $request)
    {

        // make quarter
        $date = date_format(date_create($request->date), "m-d-Y");
        $data = explode("-", $date);

        if (($data[0] >= "01") && ($data[0] <= "03")) {
            // dd("1");
            $Quartile = "Quarter 1";
        }
        if (($data[0] >= "04") && ($data[0] <= "06")) {
            // Quartile 1
            $Quartile = "Quarter 2";
        }
        if (($data[0] >= "07") && ($data[0] <= "09")) {
            // Quartile 1
            $Quartile = "Quarter 3";
        }
        if (($data[0] >= "10") && ($data[0] <= "12")) {
            // Quartile 1
            $Quartile = "Quarter 4";
        }
       
        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $Admin_team = Cipprogress::where("team", "Admin")->orderBy('id', 'ASC')->get();
        $Current_date = date('Y-m-d');
        $weekly = date('Y-m-d', strtotime($Current_date . ' - 7 days'));
        $Mounthly = date('Y-m-d', strtotime($Current_date . ' - 1 months'));
        $Quarterly = date('Y-m-d', strtotime($Current_date . ' - 3 months'));
        $data = DB::table('roles')->where('team_revenue', 1)->get('id');
        $check = [];
        $append = [];
        $sum_ongoing_ = [];
        foreach ($data as $render) {
            array_push($check, $render->id);
        }
        for ($i = 0; $i < count($check); $i++) {
            $weekly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance` 
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` = ' . $check[$i] . ' 
            and `cip_progress`.`created_at` > ' . $weekly . '
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            $Mounthly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance` 
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` = ' . $check[$i] . ' 
            and `cip_progress`.`created_at` > ' . $Mounthly . '
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            $Quarterly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance` 
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` > ' .  $Quarterly . '
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            $count_final_stage_[$i] = Cipprogress::where("t_id", $check[$i])->where("final_stage", 1)->get();
            $count_mid_stage_[$i] = Cipprogress::where("t_id", $check[$i])->where("mid_stage", 1)->get();
            $count_onboarded_[$i] = Cipprogress::where("t_id", $check[$i])->where("onboarded", 1)->get();
            $count_offere_[$i] = Cipprogress::where("t_id", $check[$i])->where("offered", 1)->get();
            //last column //
            $failed_mid_stage_[$i]   = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            inner join `endorsements` on `endorsements`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`mid_stage` = 1
            and `endorsements`.`remarks_for_finance`="FAILED"');

            $failed_final_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            inner join `endorsements` on `endorsements`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `endorsements`.`remarks_for_finance`like "%AILED%"');
            $onborded_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            inner join `endorsements` on `endorsements`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `endorsements`.`remarks_for_finance` like "%nboar%"');
            $offer_stage_[$i]  = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            inner join `endorsements` on `endorsements`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `endorsements`.`remarks_for_finance`="Offer Accepted"');
            //last column //



            $count_user_pie_[$i] = new SampleChart();
            $count_user_pie_[$i]->labels(['Actual', 'CIP-Target']);
            $count_user_pie_[$i]->dataset('my chart', 'pie', [isset($Quarterly_data_[$i][0]) ? $Quarterly_data_[$i][0]->f_srp : 0, 400000])
                ->options(
                    [
                        'fill' => 'true',
                        'borderColor' => ['green', 'orange'],
                        'backgroundColor' => ['green', "orange"],
                    ]
                );

            // $no_of_ongoing
            $total_ogoing_final = DB::select('SELECT SUM(`final_stage`) as `sumfinal` FROM `cip_progress` WHERE `t_id`="' . $check[$i] . '" AND (`mid_stage`=1 OR `final_stage`=1);');
            $total_ogoing_mid = DB::select('SELECT SUM(`mid_stage`) as `summid` FROM `cip_progress` WHERE `t_id`="' . $check[$i] . '"  AND (`mid_stage`=1 OR `final_stage`=1);');

            // $no_of_ongoing
            $sum_ongoing_[$i] = number_format($total_ogoing_final[0]->sumfinal) + number_format($total_ogoing_mid[0]->summid);
            $total_ogoing_Last_column[$i] =  DB::select('select SUM(finance.srp) as f_srp from `finance` 
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance`.`candidate_id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            $incentive_base_revenue_[$i] = DB::select('select sum(`finance_detail`.`vcc_amount`) as Sume FROM `finance_detail`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance_detail`.`candidate_id`
            where `cip_progress`.`t_id`=' . $check[$i] . '');
            $PDM_LessShare_[$i] = DB::select('select sum(`finance_detail`.`c_take`) as Sume FROM `finance_detail`
            inner join `cip_progress` on `cip_progress`.`candidate_id` = `finance_detail`.`candidate_id`
            where `cip_progress`.`t_id`=' . $check[$i] . '');
            $data_loop = [
                "weekly_data_" . $i => $weekly_data_[$i],
                "Mounthly_data_" . $i => $Mounthly_data_[$i],
                "Quarterly_data_" . $i => $Quarterly_data_[$i],
                "count_final_stage_" . $i => $count_final_stage_[$i],
                "count_mid_stage_" . $i => $count_mid_stage_[$i],
                "count_user_pie_" . $i => $count_user_pie_[$i],
                "count_onboarded_" . $i => $count_onboarded_[$i],
                "count_offere_" . $i => $count_offere_[$i],
                "total_ogoing_" . $i => $sum_ongoing_[$i],
                "lastColumnsec_row_" . $i => $total_ogoing_Last_column[$i],
                "failed_mid_stage_" . $i => $failed_mid_stage_[$i],
                "failed_final_stage_" . $i => $failed_final_stage_[$i],
                "onborded_stage_" . $i => $onborded_stage_[$i],
                "offer_stage_" . $i => $offer_stage_[$i],
                "incentive_base_revenue_" . $i => $incentive_base_revenue_[$i],
                "PDM_LessShare_" . $i => $PDM_LessShare_[$i]

            ];

            array_push($append, $data_loop);
        }


        // total nio of ongoin
        $sum_incentive_of_revenue_team = 0;
        $f = [];
        $sume = 0;
        $single_sume = [];
        foreach ($append as $key => $value) {
            $sum_incentive_of_revenue_team = $value['incentive_base_revenue_' . $key];
            array_push($f, $sum_incentive_of_revenue_team);
        }
        foreach ($f as $key => $valueinner) {

            if (isset($valueinner[$key]->Sume)) {
                $sume += $valueinner[$key]->Sume;
            }
        }
        foreach ($f as $key => $valueinner) {

            if (isset($valueinner[$key]->Sume)) {
                $sume = $valueinner[$key]->Sume;
                array_push($single_sume, $sume);
            }
        }


        $total_incentive_base_revenue = count($check) * $this->size_of_Traget;
        $del = new SampleChart();
        $del->labels(['Inventice Based Revenue', 'TAT']);
        $del->dataset('my chart', 'pie', [$sume, $total_incentive_base_revenue])->options([
            'fill' => 'true',
            'borderColor' => ['green', 'orange'],
            'backgroundColor' => ['green', 'orange'],
        ]);


        //close del
        ///first graph
        $a = [];
        $sum_incentive_of_revenue_team = '';
        $h = [];
        $pluck_name = '';
        $data_for_team_revenue = DB::table('roles')->where('team_revenue', 1)->get();
        foreach ($data_for_team_revenue as  $value) {

            $sum_incentive_of_revenue_team = $value->name;

            array_push($a, $sum_incentive_of_revenue_team);
        }


        $chart = new SampleChart();

        $chart->labels($a);
        $chart->dataset('TAT ', 'bar', [$this->size_of_Traget, $this->size_of_Traget, $this->size_of_Traget, $this->size_of_Traget])->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(253, 152, 0)',
            'backgroundColor' => 'rgb(253, 152, 0)',

        ]);
        $chart->dataset('Incentive Based Revenue', 'bar', $single_sume)->options([
            // 'fill' => 'false',
            'borderColor' => 'green',
            'backgroundColor' => 'green',

        ]);
        //first graph
        //second graph
        $count_user_pie = new SampleChart();
        $count_user_pie->labels(['Inventice Based Revenue', 'TAT']);
        $count_user_pie->dataset('my chart', 'pie', [$sume, $total_incentive_base_revenue])->options([
            'fill' => 'true',
            'borderColor' => ['green', 'orange'],
            'backgroundColor' => ['green', 'orange'],
        ]);
        //second graph
        $data =
            [
                "Admin_team" => $Admin_team,
                "chart" => $chart,
                "count_user_pie" => $count_user_pie,
                "append" => $append,
                "del" => $del,
                "Quarterly" => $Quarterly,
                "TAT" => $this->size_of_Traget,
                "Quater" => $Quartile,
                "date" => $date
            ];

        return view('Personal', $data);
    }
    public function addtest()
    {
        return view("test");
    }
    public function addtest_store(Request $request)
    {

        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        $filename = $_FILES["file"]["tmp_name"];
        if ($_FILES["file"]["size"] > 0) {
            $file = fopen($filename, "r");

            if (!$file) {
                die('Cannot open file for reading');
            }
            $row = 1;
            while (($render = fgetcsv($file, 1000, ",")) !== false) {
                $num = count($render);
                if ($row > 6002) {
                    return response()->json(['success' => false, 'message' => 'Number of rows exceeds than 6000']);
                }

                $store = new traverse2();
                $store->client = isset($render[0]) ? $render[0] : "N/A";
                $store->position = isset($render[1]) ? $render[1] : "N/A";
                $store->domain = isset($render[2]) ? $render[2] : "N/A";
                $store->segment = isset($render[3]) ? $render[3] : "N/A";
                $store->s_segment = isset($render[4]) ? $render[4] : "N/A";
                $store->save();
                $row++;
            }
        }
        return redirect()->back()->with('success', 'your data is save');
    }
}
