<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Cipprogress;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller 
{
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
        // echo sys_get_temp_dir() . "\n";
        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $chart = new SampleChart();
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $chart->dataset('TAT ', 'bar', [200000])->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(64, 135, 242)',
            'backgroundColor' => 'rgb(64, 135, 242)',

        ]);
        $chart->dataset('Profile', 'bar', [500])->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(253, 152, 0)',
            'backgroundColor' => 'rgb(253, 152, 0)',

        ]);

        $count_user_pie = new SampleChart();
        $count_user_pie->labels(['First', 'Second', 'Third']);
        $count_user_pie->dataset('my chart', 'pie', [3, 3, 3])->options([
            'fill' => 'true',
            'borderColor' => ['red', 'green', 'yellow'],
            'backgroundColor' => ['red', 'green', 'yellow'],
        ]);
        $Admin_team = Cipprogress::where("team", "Admin")->orderBy('id', 'ASC')->get();

        $Current_date = date('Y-m-d');
        $weekly = date('Y-m-d', strtotime($Current_date . ' - 7 days'));
        $Mounthly = date('Y-m-d', strtotime($Current_date . ' - 1 months'));
        $Quarterly = date('Y-m-d', strtotime($Current_date . ' - 3 months'));
        $data = DB::table('roles')->get();
        $check = [];
        $append = [];
        $sum_ongoing_ = [];
        foreach ($data as $render) {
            array_push($check, $render->id);
        }

        for ($i = 0; $i < count($data); $i++) {

            $weekly_data_[$i] = Cipprogress::join("finance", "finance.candidate_id", "cip_progress.candidate_id")
                ->where("cip_progress.t_id", $check[$i])
                ->whereDate("cip_progress.created_at", ">", $weekly)
                ->where("cip_progress.final_stage", 1)
                ->orwhere("cip_progress.mid_stage", 1)
                ->groupBy("cip_progress.team")
                ->select(DB::raw("SUM(finance.srp) as f_srp"))->get();

            $Mounthly_data_[$i] = Cipprogress::join("finance", "finance.candidate_id", "cip_progress.candidate_id")
                ->where("cip_progress.t_id", $check[$i])
                ->whereDate("cip_progress.created_at", ">", $Mounthly)
                ->where("cip_progress.final_stage", 1)
                ->orwhere("cip_progress.mid_stage", 1)
                ->groupBy("cip_progress.team")
                ->select(DB::raw("SUM(finance.srp) as f_srp"))->get();
            $Quarterly_data_[$i] = Cipprogress::join("finance", "finance.candidate_id", "cip_progress.candidate_id")
                ->where("cip_progress.t_id", $check[$i])
                ->whereDate("cip_progress.created_at", ">", $Quarterly)
                ->where("cip_progress.final_stage", 1)
                ->orwhere("cip_progress.mid_stage", 1)
                ->groupBy("cip_progress.team")
                ->select(DB::raw("SUM(finance.srp) as f_srp"))->get();
            $count_final_stage_[$i] = Cipprogress::where("t_id", $check[$i])->where("final_stage", 1)->get();
            $count_mid_stage_[$i] = Cipprogress::where("t_id", $check[$i])->where("mid_stage", 1)->get();
            $count_onboarded_[$i] = Cipprogress::where("t_id", $check[$i])->where("onboarded", 1)->get();
            $count_offere_[$i] = Cipprogress::where("t_id", $check[$i])->where("offered", 1)->get();
            $count_user_pie_[$i] = new SampleChart();
            $count_user_pie_[$i]->labels(['Actual', 'Cip-Taget']);
            $count_user_pie_[$i]->dataset('my chart', 'pie', [count($Quarterly_data_[$i]), (400000)])
                ->options(
                    [
                        'fill' => 'true',
                        'borderColor' => ['green', 'yellow'],
                        'backgroundColor' => ['green', "orange"],
                    ]
                );
            // $no_of_ongoing
            $total_ogoing_final = DB::select('SELECT SUM(`final_stage`) as `sumfinal` FROM `cip_progress` WHERE `t_id`="' . $check[$i] . '" AND (`mid_stage`=1 OR `final_stage`=1);');
            $total_ogoing_mid = DB::select('SELECT SUM(`mid_stage`) as `summid` FROM `cip_progress` WHERE `t_id`="' . $check[$i] . '"  AND (`mid_stage`=1 OR `final_stage`=1);');

            $sum_ongoing_[$i] = number_format($total_ogoing_final[0]->sumfinal) + number_format($total_ogoing_mid[0]->summid);
            // $no_of_ongoing

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

            ];
            array_push($append, $data_loop);
        }
        // dd($append[0]['count_user_pie_0']);
        $revenue = DB::select('select `finance_detail`.`t_id` ,sum(`finance_detail`.`vcc_amount`) as Sume FROM `finance_detail` inner join `cip_progress` on `cip_progress`.`id` = `finance_detail`.`t_id` group by `finance_detail`.`t_id`');
        // total nio of ongoin
        $total_ogoing_Last_column = Cipprogress::join("finance", "finance.candidate_id", "cip_progress.candidate_id")

            ->where("cip_progress.final_stage", 1)
            ->orwhere("cip_progress.mid_stage", 1)
            ->groupby("cip_progress.team")
            ->orderby("cip_progress.id")
            ->select(DB::raw("SUM(finance.srp) as f_srp"), "finance.srp", "cip_progress.team", "cip_progress.candidate_id as c_c_id", "finance.candidate_id")->get();

        $del = new SampleChart();
        $del->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $del->dataset('TAT ', 'bar', [80000000])->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(64, 135, 242)',
            'backgroundColor' => 'rgb(64, 135, 242)',

        ]);
        $del->dataset('Incentive Base Revenue', 'bar', [500])->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(253, 152, 0)',
            'backgroundColor' => 'rgb(253, 152, 0)',

        ]);

        //close del

        $data = [
            "Admin_team" => $Admin_team,
            "chart" => $chart,
            "count_user_pie" => $count_user_pie,
            "append" => $append,
            "del" => $del,
            "Quarterly" => $Quarterly,
            "revenue" => $revenue,
        ];
        return view('home', $data, compact("total_ogoing_Last_column"));
    }
    public function filterByDate(Request $request)
    {
        // make quarter
        $data = explode("-", $request->date);
        if (($data[1] >= "01") && ($data[1] <= "03")) {
            // Quartile 1
            $Quartile = "Quartile 1";
        }
        if (($data[1] >= "04") && ($data[1] <= "06")) {
            // Quartile 1
            $Quartile = "Quartile 2";
        }
        if (($data[1] >= "07") && ($data[1] <= "09")) {
            // Quartile 1
            $Quartile = "Quartile 3";
        }
        if (($data[1] >= "10") && ($data[1] <= "12")) {
            // Quartile 1
            $Quartile = "Quartile 4";
        }

        $Current_date = $request->date;

        $revenue = DB::table('finance_detail')
            ->join('roles', 'roles.id', 'finance_detail.t_id')
            ->select('finance_detail.t_id', 'finance_detail.created_at', 'roles.name', DB::raw('sum(finance_detail.vcc_amount) as Sume'))
            ->groupBy('finance_detail.t_id')
            ->having('finance_detail.created_at', '>=', $Current_date)

            ->get();

        $roles = DB::table('roles')->get();
        $check = [];
        $append = [];
        $sum_ongoing_ = [];
        foreach ($roles as $render) {
            array_push($check, $render->name);
        }

        for ($i = 0; $i < count($data); $i++) {

            // $no_of_ongoing
            $total_ogoing_final = DB::select('SELECT SUM(`final_stage`) as `sumfinal` FROM `cip_progress` WHERE `team`="' . $check[$i] . '" and `created_at` >="' . $Current_date . '" AND (`mid_stage`=1 OR `final_stage`=1);');
            $total_ogoing_mid = DB::select('SELECT SUM(`mid_stage`) as `summid` FROM `cip_progress` WHERE `team`="' . $check[$i] . '"and `created_at` >="' . $Current_date . '"  AND (`mid_stage`=1 OR `final_stage`=1);');

            $sum_ongoing_[$i] = number_format($total_ogoing_final[0]->sumfinal) + number_format($total_ogoing_mid[0]->summid);
            // $no_of_ongoing

            $data_loop = [

                "total_ogoing_" . $i => $sum_ongoing_[$i],

            ];
            array_push($append, $data_loop);
        }
        // total nio of ongoin
        $total_ogoing_Last_column = Cipprogress::join("finance", "finance.candidate_id", "cip_progress.candidate_id")
            ->where("cip_progress.created_at", ">", $Current_date)
            ->where("cip_progress.final_stage", 1)
            ->orwhere("cip_progress.mid_stage", 1)
            ->groupby("cip_progress.team")
            ->orderby("cip_progress.id")
            ->select(DB::raw("SUM(finance.srp) as f_srp"), "finance.srp", "cip_progress.team", "cip_progress.candidate_id as c_c_id", "finance.candidate_id")->get();

        // total nio of ongoin

        $data = [
            "Quartile" => $Quartile,
            "Year" => $data[0],
            "revenue" => $revenue,
            "append" => $append,
            "total_ogoing_Last_column" => $total_ogoing_Last_column,
            "roles" => $roles,
        ];
        return response()->json(["data" => $data]);
    }
}
