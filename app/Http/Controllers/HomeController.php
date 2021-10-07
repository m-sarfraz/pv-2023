<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Cipprogress;
use App\User;
use App\Role;
use App\SpatieRole;
use Google\Service\Directory\Resource\Roles;
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
            'borderColor' => ['red','green','yellow'],
            'backgroundColor' => ['red','green','yellow'],
        ]);
        $Admin_team = Cipprogress::where("team", "Admin")->orderBy('id', 'ASC')->get();

        $Current_date = date('Y-m-d');
        $weekly = date('Y-m-d', strtotime($Current_date . ' - 7 days'));
        $Quarterly = date('Y-m-d', strtotime($Current_date . ' - 3 months'));
        $Mounthly = date('Y-m-d', strtotime($Current_date . ' - 1 months'));
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
            $count_user_pie_[$i] = new SampleChart();
            $count_user_pie_[$i]->labels(['Actual', 'Cip-Taget']);
            $count_user_pie_[$i]->dataset('my chart', 'pie', [count($weekly_data_[$i]) + count($Mounthly_data_[$i]) + count($Quarterly_data_[$i]), (400000 + 1200000 + 342857)])
                ->options(
                    [
                        'fill' => 'true',
                        'borderColor' => ['green','yellow'],
                        'backgroundColor' => ['green',"orange"],
                    ]
                );
            $data_loop = [
                "weekly_data_" . $i => $weekly_data_[$i],
                "Mounthly_data_" . $i => $Mounthly_data_[$i],
                "Quarterly_data_" . $i => $Quarterly_data_[$i],
                "count_final_stage_" . $i => $count_final_stage_[$i],
                "count_mid_stage_" . $i => $count_mid_stage_[$i],
                "count_user_pie_" . $i => $count_user_pie_[$i],
            ];

            array_push($append, $data_loop);
        }
        $data = [

            "Admin_team" => $Admin_team,
            "chart" => $chart,
            "count_user_pie" => $count_user_pie,
            "append" => $append,
            "del"=>$del,
        ];
        return view('home', $data);
    }
}
