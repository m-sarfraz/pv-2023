<?php

namespace App\Http\Controllers;

use App\CandidateInformation;
use App\Charts\SampleChart;
use App\Cipprogress;
use App\Finance_detail;
use App\User;
use App\Role;
use App\SpatieRole;
use Auth;
use Google\Service\Directory\Resource\Roles;
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
        $users = User::select(DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count');
        $chart = new SampleChart();
        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $chart->dataset('TAT ', 'bar', $users)->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(64, 135, 242)',
            'backgroundColor' => 'rgb(64, 135, 242)',

        ]);
        $chart->dataset('Profile', 'bar', [2])->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(253, 152, 0)',
            'backgroundColor' => 'rgb(253, 152, 0)',

        ]);
        //text butt del
        $del = new SampleChart();
        $del->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $del->dataset('TAT ', 'bar', $users)->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(64, 135, 242)',
            'backgroundColor' => 'rgb(64, 135, 242)',

        ]);
        $del->dataset('Profile', 'bar', [2])->options([
            // 'fill' => 'false',
            'borderColor' => 'rgb(253, 152, 0)',
            'backgroundColor' => 'rgb(253, 152, 0)',

        ]);
        //close del
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
        foreach ($data as $render) {
            array_push($check, $render->name);
        }

        for ($i = 0; $i < count($data); $i++) {

            $weekly_data_[$i] = Cipprogress::where("team", $check[$i])->whereDate("created_at", ">", $weekly)->get();
            $Mounthly_data_[$i] = Cipprogress::where("team", $check[$i])->whereDate("created_at", ">", $Mounthly)->get();
            $Quarterly_data_[$i] = Cipprogress::where("team", $check[$i])->whereDate("created_at", ">", $Quarterly)->get();
            $count_final_stage_[$i] = Cipprogress::where("team", $check[$i])->where("final_stage", 1)->get();
            $count_mid_stage_[$i] = Cipprogress::where("team", $check[$i])->where("mid_stage", 1)->get();
            $count_onboarded_[$i] = Cipprogress::where("team", $check[$i])->where("onboarded", 1)->get();
            $count_offere_[$i] = Cipprogress::where("team", $check[$i])->where("offered", 1)->get();
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
            $data_loop = [
                "weekly_data_" . $i => $weekly_data_[$i],
                "Mounthly_data_" . $i => $Mounthly_data_[$i],
                "Quarterly_data_" . $i => $Quarterly_data_[$i],
                "count_final_stage_" . $i => $count_final_stage_[$i],
                "count_mid_stage_" . $i => $count_mid_stage_[$i],
                "count_user_pie_" . $i => $count_user_pie_[$i],
                "count_onboarded_" . $i => $count_onboarded_[$i],
                "count_offere_" . $i => $count_offere_[$i],
            ];

            array_push($append, $data_loop);
        }
        $revenue = DB::select('select `finance_detail`.`t_id` ,sum(`finance_detail`.`vcc_amount`) as Sume FROM `finance_detail` inner join `cip_progress` on `cip_progress`.`id` = `finance_detail`.`t_id` group by `finance_detail`.`t_id`');
        
        $data = [

            "Admin_team" => $Admin_team,
            "chart" => $chart,
            "count_user_pie" => $count_user_pie,
            "append" => $append,
            "del" => $del,
            "Quarterly" => $Quarterly,
            "revenue" => $revenue,
        ];
        return view('home', $data);
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
        // $weekly = date('Y-m-d', strtotime($Current_date . ' - 7 days'));
        // $Mounthly = date('Y-m-d', strtotime($Current_date . ' - 1 months'));
        // $Quarterly = date('Y-m-d', strtotime($Current_date . ' - 3 months'));
        //start team revenue 



        $data = [
            "Quartile" => $Quartile,
            "Year" => $data[0],

        ];
        return response()->json(["data" => $data]);
    }
}
