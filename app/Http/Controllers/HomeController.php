<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Cipprogress;
use App\traverse2;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $date = date_format(date_create(date('Y-m-d')), "m-d-Y");
        $data = explode("-", $date);
        // find quarter number of date and also the start and ending date of that quarter
        if (($data[0] >= "01") && ($data[0] <= "03")) {
            $Quartile = 1;
            $dateOfQuraterStart = '' . $data[2] . '-01-01';
            $dateOfQuraterEnd = '' . $data[2] . '-03-31';
        }
        if (($data[0] >= "04") && ($data[0] <= "06")) {
            $Quartile = 2;
            $dateOfQuraterStart = '' . $data[2] . '-04-01';
            $dateOfQuraterEnd = '' . $data[2] . '-06-30';
        }
        if (($data[0] >= "07") && ($data[0] <= "09")) {
            $Quartile = 3;
            $dateOfQuraterStart = '' . $data[2] . '-07-01';
            $dateOfQuraterEnd = '' . $data[2] . '-09-30';
        }
        if (($data[0] >= "10") && ($data[0] <= "12")) {
            $Quartile = 4;
            $dateOfQuraterStart = '' . $data[2] . '-10-01';
            $dateOfQuraterEnd = '' . $data[2] . '-12-31';
        }
        $dateOfMonthStart = '' . $data[2] . '-' . $data[0] . '-01';
        $dateOfMonthEnd = '' . $data[2] . '-' . $data[0] . '-30';
        $dateOfMonthStart = date('Y-m-d', strtotime($dateOfMonthStart));
        $dateOfMonthEnd = date('Y-m-d', strtotime($dateOfMonthEnd));
        $size_of_Traget = \DB::select('select SUM(team_revenue.q' . $Quartile . '_target) as total_target from `team_revenue`');
        // return Auth::user()->roles->pluck('id');
        // echo sys_get_temp_dir() . "\n";
        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');

        $Admin_team = Cipprogress::where("team", "Admin")->orderBy('id', 'ASC')->get();

        $Current_date = date('Y-m-d');
        $weekstartDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $weekendDate = Carbon::now()->endOfWeek()->format('Y-m-d');
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
        $bod_share = DB::select('select SUM(finance_detail.vcc_amount) as bod_share from `finance_detail`
        inner join `cip_progress` on `cip_progress`.`finance_id` = `finance_detail`.`finance_id`
        where `finance_detail`.`t_id` = 6
        and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
        and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
        $c_share = DB::select('select SUM(finance_detail.vcc_amount) as c_share from `finance_detail`
        inner join `cip_progress` on `cip_progress`.`finance_id` = `finance_detail`.`finance_id`
        where `finance_detail`.`t_id` = 3
        and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
        and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
        $arrr = [];
        for ($i = 0; $i < count($check); $i++) {
            $vcc_share_[$i] = DB::select('select SUM(finance_detail.vcc_amount) as vcc_share from `finance_detail`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance_detail`.`finance_id`
            where `finance_detail`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            // return $vcc_share_[$i];
            array_push($arrr, $vcc_share_[$i][0]);
            $weekly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` BETWEEN "' . $weekstartDate . '" AND "' . $weekendDate . '"
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');

            $Mounthly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfMonthStart . '" AND "' . $dateOfMonthEnd . '"
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            // die();
            $Quarterly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');

            $count_final_stage_[$i] = Cipprogress::where("t_id", $check[$i])->where("final_stage", 1)->get();
            $count_mid_stage_[$i] = Cipprogress::where("t_id", $check[$i])->where("mid_stage", 1)->get();
            $count_onboarded_[$i] = Cipprogress::where("t_id", $check[$i])->where("onboarded", 1)->get();
            $count_offere_[$i] = Cipprogress::where("t_id", $check[$i])->where("offered", 1)->get();
            //last column //
            $failed_mid_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            inner join `endorsements` on `endorsements`.`id` = `finance`.`endorsement_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`mid_stage` = 1
            and `endorsements`.`remarks_for_finance`="FAILED"');

            $failed_final_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            inner join `endorsements` on `endorsements`.`id` = `finance`.`endorsement_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `endorsements`.`remarks_for_finance`like "%AILED%"');
            $onborded_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            inner join `endorsements` on `endorsements`.`id` = `finance`.`endorsement_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `endorsements`.`remarks_for_finance` like "%nboar%"');
            $offer_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            inner join `endorsements` on `endorsements`.`id` = `finance`.`endorsement_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `endorsements`.`remarks_for_finance`="Offer Accepted"');
            //last column //

            $target = DB::table('team_revenue')->where('team_id', $check[$i])->first();
            $count_user_pie_[$i] = new SampleChart();

            $count_user_pie_[$i]->labels(['Actual', 'CIP-Target']);
            if ($Quartile == 1) {
                $count_user_pie_[$i]->dataset('my chart', 'pie', [isset($Quarterly_data_[$i][0]) ? $Quarterly_data_[$i][0]->f_srp : 0, $target != null ? $target->q1_target : '0'])
                    ->options(
                        [
                            'fill' => 'true',
                            'borderColor' => ['#4285f4', '#ff9900'],
                            'backgroundColor' => ['#4285f4', "#ff9900"],
                        ]
                    );
            } else if ($Quartile == 2) {
                $count_user_pie_[$i]->dataset('my chart', 'pie', [isset($Quarterly_data_[$i][0]) ? $Quarterly_data_[$i][0]->f_srp : 0, $target != null ? $target->q2_target : '0'])
                    ->options(
                        [
                            'fill' => 'true',
                            'borderColor' => ['#4285f4', '#ff9900'],
                            'backgroundColor' => ['#4285f4', "#ff9900"],
                        ]
                    );
            } else if ($Quartile == 3) {
                $count_user_pie_[$i]->dataset('my chart', 'pie', [isset($Quarterly_data_[$i][0]) ? $Quarterly_data_[$i][0]->f_srp : 0, $target != null ? $target->q3_target : '0'])
                    ->options(
                        [
                            'fill' => 'true',
                            'borderColor' => ['#4285f4', '#ff9900'],
                            'backgroundColor' => ['#4285f4', "#ff9900"],
                        ]
                    );
            } else {

                $count_user_pie_[$i]->dataset('my chart', 'pie', [isset($Quarterly_data_[$i][0]) ? $Quarterly_data_[$i][0]->f_srp : 0, $target != null ? $target->q1_target : '0'])
                    ->options(
                        [
                            'fill' => 'true',
                            'borderColor' => ['#4285f4', '#ff9900'],
                            'backgroundColor' => ['#4285f4', "#ff9900"],
                        ]
                    );

            }

            // $no_of_ongoing
            $total_ogoing_final = DB::select('SELECT SUM(`final_stage`) as `sumfinal` FROM `cip_progress` WHERE `t_id`="' . $check[$i] . '" AND (`mid_stage`=1 OR `final_stage`=1);');
            $total_ogoing_mid = DB::select('SELECT SUM(`mid_stage`) as `summid` FROM `cip_progress` WHERE `t_id`="' . $check[$i] . '"  AND (`mid_stage`=1 OR `final_stage`=1);');

            // $no_of_ongoing
            $sum_ongoing_[$i] = 0 + 0;
            $sum_ongoing_[$i] = number_format($total_ogoing_final[0]->sumfinal) + number_format($total_ogoing_mid[0]->summid);
            $total_ogoing_Last_column[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            $incentive_base_revenue_[$i] = DB::select('select sum(`finance_detail`.`vcc_amount`) as Sume FROM `finance_detail`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance_detail`.`finance_id`
            where `cip_progress`.`t_id`=' . $check[$i] . '');
            $PDM_LessShare_[$i] = DB::select('select sum(`finance_detail`.`c_take`) as Sume FROM `finance_detail`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance_detail`.`finance_id`
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
                "PDM_LessShare_" . $i => $PDM_LessShare_[$i],

            ];

            array_push($append, $data_loop);
        }
        // return $arrr;
        // total nio of ongoin
        $sum_incentive_of_revenue_team = 0;
        foreach ($arrr as $key => $value) {
            $sum_incentive_of_revenue_team = $sum_incentive_of_revenue_team + $value->vcc_share;
        }
        // return $sum_incentive_of_revenue_team;
        $f = [];
        $sume = 0;
        $checkarray = [];
        $single_sume = [];
        foreach ($append as $key => $value) {
            $sum_incentive_of_revenue_team = $value['incentive_base_revenue_' . $key];

            array_push($f, $sum_incentive_of_revenue_team[0]);
        }
        foreach ($f as $key => $valueinner) {

            if (isset($valueinner->Sume)) {
                $sume += round($valueinner->Sume);
                array_push($checkarray, $valueinner->Sume);
            } else {
                array_push($checkarray, 0);
            }
        }
        foreach ($checkarray as $values) {

            $key = isset($values) ? $values : 0;
            array_push($single_sume, round($key));

        }
        $targetTotal = $size_of_Traget[0]->total_target;
        $total_incentive_base_revenue = $targetTotal;
        $del = new SampleChart();
        $del->labels(['Incentive Based Revenue', 'Actual Target']);
        $del->dataset('my chart', 'pie', [$sume, $total_incentive_base_revenue])->options([
            'fill' => 'true',
            'borderColor' => ['#4285f4', '#ff9900'],
            'backgroundColor' => ['#4285f4', '#ff9900'],
        ]);

        //close del
        ///first graph
        $labels = [];
        $sum_incentive_of_revenue_team = '';
        $h = [];
        $tagetperTeams = [];
        $pluck_name = '';
        $data_for_team_revenue = DB::table('roles')->where('team_revenue', 1)->get();
        foreach ($data_for_team_revenue as $value) {

            $sum_incentive_of_revenue_team = $value->name;
            $Team = DB::table('team_revenue')->where('team_id', $value->id)->first();
            $target = $Team != null ? $Team->q1_target : '0';
            array_push($labels, $sum_incentive_of_revenue_team);
            array_push($tagetperTeams, $target);
        }
        // return $tagetperTeams;
        $charts = new SampleChart();

        $charts->labels($labels);
        $charts->dataset('Actual Target', 'bar', $tagetperTeams)->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(253, 152, 0)',
            'backgroundColor' => 'rgb(253, 152, 0)',

        ]);
        $charts->dataset('Incentive Based Revenue Achieved', 'bar', $single_sume)->options([
            // 'fill' => 'false',
            'borderColor' => '#4285f4',
            'backgroundColor' => '#4285f4',
        ]);
        // dd( $charts);
        //first graph
        //second graph
        $count_user_pie = new SampleChart();
        $count_user_pie->labels(['Incentive Based Revenue', 'Actual Target']);
        $count_user_pie->dataset('my chart', 'pie', [$sume, $total_incentive_base_revenue])->options([
            'fill' => 'true',
            'borderColor' => ['#4285f4', '#ff9900'],
            'backgroundColor' => ['#4285f4', '#ff9900'],
        ]);
        // dd ($charts) ;
        //second graph
        $data = [
            "Admin_team" => $Admin_team,
            "chart" => $charts,
            "count_user_pie" => $count_user_pie,
            "append" => $append,
            "del" => $del,
            "Quarterly" => $Quarterly,
            "TAT" => $this->size_of_Traget,
            "Quartile" => $Quartile,
        ];
        // return $data;
        return view('home', $data);
    }
    public function filterByDate(Request $request)
    {

        // make quarter
        $date = date_format(date_create($request->date), "m-d-Y");
        $data = explode("-", $date);

        // find quarter number of date and also the start and ending date of that quarter
        if (($data[0] >= "01") && ($data[0] <= "03")) {
            $Quartile = "Quarter 1";
            $quartr = 1;
            $dateOfQuraterStart = '' . $data[2] . '-01-01';
            $dateOfQuraterEnd = '' . $data[2] . '-03-31';
        }
        if (($data[0] >= "04") && ($data[0] <= "06")) {
            $Quartile = "Quarter 2";
            $quartr = 2;
            $dateOfQuraterStart = '' . $data[2] . '-04-01';
            $dateOfQuraterEnd = '' . $data[2] . '-06-30';
        }
        if (($data[0] >= "07") && ($data[0] <= "09")) {
            $Quartile = "Quarter 3";
            $quartr = 3;
            $dateOfQuraterStart = '' . $data[2] . '-07-01';
            $dateOfQuraterEnd = '' . $data[2] . '-09-30';
        }
        if (($data[0] >= "10") && ($data[0] <= "12")) {
            $Quartile = "Quarter 4";
            $quartr = 4;
            $dateOfQuraterStart = '' . $data[2] . '-10-01';
            $dateOfQuraterEnd = '' . $data[2] . '-12-31';
        }
        $size_of_Traget = \DB::select('select SUM(team_revenue.q' . $quartr . '_target) as total_target from `team_revenue`');

        // find month start and ending date of selected month
        $dateOfMonthStart = '' . $data[2] . '-' . $data[0] . '-01';
        $dateOfMonthEnd = '' . $data[2] . '-' . $data[0] . '-30';

        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $dateTime = date($request->date);
        $weekstartDate = Carbon::createFromFormat('Y-m-d', $dateTime)->startOfWeek()->format('Y-m-d');
        $weekendDate = Carbon::createFromFormat('Y-m-d', $dateTime)->endOfWeek()->format('Y-m-d');
        $Admin_team = Cipprogress::where("team", "Admin")->orderBy('id', 'ASC')->get();
        $Current_date = date($request->date);
        $weekly = date('Y-m-d', strtotime($Current_date . ' - 7 days'));
        $Mounthly = date('Y-m-d', strtotime($Current_date . ' - 1 months'));
        $Quarterly = date('Y-m-d', strtotime($Current_date . ' - 3 months'));
        $data = DB::table('roles')->where('team_revenue', 1)->get('id');

        // formate quarterly start and end date
        $dateOfQuraterStart = date('Y-m-d', strtotime($dateOfQuraterStart));
        $dateOfQuraterEnd = date('Y-m-d', strtotime($dateOfQuraterEnd));

        // formate monthly start and ending date
        $dateOfMonthStart = date('Y-m-d', strtotime($dateOfMonthStart));
        $dateOfMonthEnd = date('Y-m-d', strtotime($dateOfMonthEnd));

        // initilaizng arrays
        $check = [];
        $append = [];
        $sum_ongoing_ = [];
        foreach ($data as $render) {
            array_push($check, $render->id);
        }
        $bod_share = DB::select('select SUM(finance_detail.vcc_amount) as bod_share from `finance_detail`
        inner join `cip_progress` on `cip_progress`.`finance_id` = `finance_detail`.`finance_id`
        where `finance_detail`.`t_id` = 6
        and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
        and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
        $c_share = DB::select('select SUM(finance_detail.vcc_amount) as c_share from `finance_detail`
        inner join `cip_progress` on `cip_progress`.`finance_id` = `finance_detail`.`finance_id`
        where `finance_detail`.`t_id` = 3
        and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
        and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
        $arrr = [];

        // loop through teams to calculate the monthly/quarterly/weekly data
        for ($i = 0; $i < count($check); $i++) {

            // calculate vcc share of current team
            $vcc_share_[$i] = DB::select('select SUM(finance_detail.vcc_amount) as vcc_share from `finance_detail`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance_detail`.`finance_id`
            where `finance_detail`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');

            // push in array for sum
            array_push($arrr, $vcc_share_[$i][0]);

            // find weekly data of each team
            $weekly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` BETWEEN "' . $weekstartDate . '" AND "' . $weekendDate . '"
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');

            // find monthly data of each team
            $Mounthly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfMonthStart . '" AND "' . $dateOfMonthEnd . '"
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            // return $dateOfQuraterStart;
            // return $dateOfQuraterEnd;
            // return $check[$i] ;

            // find quarterly data of each team
            $Quarterly_data_[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');

            // and `cip_progress`.`created_at` >= '.$dateOfQuraterStart .'
            // and `cip_progress`.`created_at` <= '.$dateOfQuraterEnd .'

            //count final amount of all stages
            $count_final_stage_[$i] = Cipprogress::where("t_id", $check[$i])->where("final_stage", 1)
                ->whereDate('created_at', '>=', $dateOfQuraterStart)->whereDate('created_at', '<=', $dateOfQuraterEnd)
                ->get();
            $count_mid_stage_[$i] = Cipprogress::where("t_id", $check[$i])->where("mid_stage", 1)
                ->whereDate('created_at', '>=', $dateOfQuraterStart)->whereDate('created_at', '<=', $dateOfQuraterEnd)
                ->get();
            $count_onboarded_[$i] = Cipprogress::where("t_id", $check[$i])->where("onboarded", 1)
                ->whereDate('created_at', '>=', $dateOfQuraterStart)->whereDate('created_at', '<=', $dateOfQuraterEnd)
                ->get();
            $count_offere_[$i] = Cipprogress::where("t_id", $check[$i])->where("offered", 1)
                ->whereDate('created_at', '>=', $dateOfQuraterStart)->whereDate('created_at', '<=', $dateOfQuraterEnd)
                ->get();

            //last column count for mid stages/final stages and intital stages srp//
            $failed_mid_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            inner join `endorsements` on `endorsements`.`id` = `finance`.`endorsement_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`mid_stage` = 1
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
            and `endorsements`.`remarks_for_finance`="FAILED"');

            $failed_final_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            inner join `endorsements` on `endorsements`.`id` = `finance`.`endorsement_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
            and `endorsements`.`remarks_for_finance`like "%AILED%"');
            $onborded_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            inner join `endorsements` on `endorsements`.`id` = `finance`.`endorsement_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
            and `endorsements`.`remarks_for_finance` like "%nboar%"');
            $offer_stage_[$i] = DB::select('select   sum(finance.srp) as f_m_stage from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            inner join `endorsements` on `endorsements`.`id` = `finance`.`endorsement_id`
            where `finance`.`t_id` =' . $check[$i] . ' and `cip_progress`.`final_stage` = 1
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
            and `endorsements`.`remarks_for_finance`="Offer Accepted"');
            // ends //

            $target = DB::table('team_revenue')->where('team_id', $check[$i])->first();
            $count_user_pie_[$i] = new SampleChart();

            $count_user_pie_[$i]->labels(['Actual', 'CIP-Target']);
            $count_user_pie_[$i]->dataset('my chart', 'pie', [isset($Quarterly_data_[$i][0]) ? $Quarterly_data_[$i][0]->f_srp : 0, $target != null ? $target->q1_target : '0'])
                ->options(
                    [
                        'fill' => 'true',
                        'borderColor' => ['#4285f4', '#ff9900'],
                        'backgroundColor' => ['#4285f4', "#ff9900"],
                    ]
                );

            // $no_of_ongoing
            $total_ogoing_final = DB::select('SELECT SUM(`final_stage`) as `sumfinal` FROM `cip_progress` WHERE `t_id`="' . $check[$i] . '" AND (`mid_stage`=1 OR `final_stage`=1)  and `created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '";');
            $total_ogoing_mid = DB::select('SELECT SUM(`mid_stage`) as `summid` FROM `cip_progress` WHERE `t_id`="' . $check[$i] . '"  AND (`mid_stage`=1 OR `final_stage`=1)  and `created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '";');

            // $no_of_ongoing
            $sum_ongoing_[$i] = 0 + 0;
            $sum_ongoing_[$i] = number_format($total_ogoing_final[0]->sumfinal) + number_format($total_ogoing_mid[0]->summid);
            $total_ogoing_Last_column[$i] = DB::select('select SUM(finance.srp) as f_srp from `finance`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance`.`id`
            where `finance`.`t_id` = ' . $check[$i] . '
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
            and (`cip_progress`.`final_stage` = 1 OR `cip_progress`.`mid_stage` = 1)');
            $incentive_base_revenue_[$i] = DB::select('select sum(`finance_detail`.`vcc_amount`) as Sume FROM `finance_detail`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance_detail`.`finance_id`
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
            where `cip_progress`.`t_id`=' . $check[$i] . '');
            $PDM_LessShare_[$i] = DB::select('select sum(`finance_detail`.`c_take`) as Sume FROM `finance_detail`
            inner join `cip_progress` on `cip_progress`.`finance_id` = `finance_detail`.`finance_id`
            and `cip_progress`.`created_at` BETWEEN "' . $dateOfQuraterStart . '" AND "' . $dateOfQuraterEnd . '"
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
                "PDM_LessShare_" . $i => $PDM_LessShare_[$i],

            ];

            array_push($append, $data_loop);
        }
        // total nio of ongoin
        $sum_incentive_of_revenue_team = 0;
        foreach ($arrr as $key => $value) {
            $sum_incentive_of_revenue_team = $sum_incentive_of_revenue_team + $value->vcc_share;
        }
        // return $sum_incentive_of_revenue_team;
        $f = [];
        $sume = 0;
        $checkarray = [];
        $single_sume = [];
        foreach ($append as $key => $value) {
            $sum_incentive_of_revenue_team = $value['incentive_base_revenue_' . $key];

            array_push($f, $sum_incentive_of_revenue_team[0]);
        }
        foreach ($f as $key => $valueinner) {

            if (isset($valueinner->Sume)) {
                $sume += round($valueinner->Sume);
                array_push($checkarray, $valueinner->Sume);
            } else {
                array_push($checkarray, 0);
            }
        }
        foreach ($checkarray as $values) {

            $key = isset($values) ? $values : 0;
            array_push($single_sume, round($key));

        }
        $targetTotal = $size_of_Traget[0]->total_target;
        $total_incentive_base_revenue = $targetTotal;
        $del = new SampleChart();
        $del->labels(['Incentive Based Revenue', 'Actual Target']);
        $del->dataset('my chart', 'pie', [$sume, $total_incentive_base_revenue])->options([
            'fill' => 'true',
            'borderColor' => ['#4285f4', '#ff9900'],
            'backgroundColor' => ['#4285f4', '#ff9900'],
        ]);

        //close del
        ///first graph
        $labels = [];
        $sum_incentive_of_revenue_team = '';
        $h = [];
        $tagetperTeams = [];
        $pluck_name = '';
        $data_for_team_revenue = DB::table('roles')->where('team_revenue', 1)->get();
        foreach ($data_for_team_revenue as $value) {

            $sum_incentive_of_revenue_team = $value->name;
            $Team = DB::table('team_revenue')->where('team_id', $value->id)->first();

            $target = $Team != null ? $Team->q1_target : '0';
            array_push($labels, $sum_incentive_of_revenue_team);
            array_push($tagetperTeams, $target);
        }
        // return $tagetperTeams;
        $charts = new SampleChart();

        $charts->labels($labels);
        $charts->dataset('Actual Target', 'bar', $tagetperTeams)->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(253, 152, 0)',
            'backgroundColor' => 'rgb(253, 152, 0)',

        ]);
        $charts->dataset('Incentive Based Revenue Achieved', 'bar', $single_sume)->options([
            // 'fill' => 'false',
            'borderColor' => '#4285f4',
            'backgroundColor' => '#4285f4',
        ]);
        // dd( $charts);
        //first graph
        //second graph
        $count_user_pie = new SampleChart();
        $count_user_pie->labels(['Incentive Based Revenue', 'Actual Target']);
        $count_user_pie->dataset('my chart', 'pie', [$sume, $total_incentive_base_revenue])->options([
            'fill' => 'true',
            'borderColor' => ['#4285f4', '#ff9900'],
            'backgroundColor' => ['#4285f4', '#ff9900'],
        ]);
        //second graph
        $data =
            [
            "Admin_team" => $Admin_team,
            "chart" => $charts,
            "count_user_pie" => $count_user_pie,
            "append" => $append,
            "del" => $del,
            "Quarterly" => $Quarterly,
            "TAT" => $this->size_of_Traget,
            "Quater" => $Quartile,
            "date" => $date,
            "Quartile" => $quartr,

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
    public function uploadSegments(){
        $data = DB::table('gettravesels')->select('segment')->distinct()->get();
        $arr = [];
        foreach($data as $key=>$value){
            array_push($arr , $value->segment);
        }
        return $arr;
    }
}
