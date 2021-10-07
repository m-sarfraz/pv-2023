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
        $count_user_pie = new SampleChart();
        $count_user_pie->labels(['First', 'Second', 'Third']);
        $count_user_pie->dataset('my chart', 'pie', [3, 3, 3])->options([
            'fill' => 'true',
            'borderColor' => 'yellow',
            'backgroundColor' => 'orange',
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

            $data_loop = [
                "weekly_data_".$i=>$weekly_data_[$i],
                "Mounthly_data_".$i=>$Mounthly_data_[$i],
                "Quarterly_data_".$i=>$Quarterly_data_[$i],
                "count_final_stage_".$i=>$count_final_stage_[$i],
                "count_mid_stage_".$i=>$count_mid_stage_[$i],
            ];
        
            array_push($append,$data_loop);
        }



        // //consultant
        // $consultant_weekly_data = Cipprogress::where("team", "consultant")->whereDate("created_at", ">", $weekly)->get();
        // $consultant_Mounthly_data = Cipprogress::where("team", "consultant")->whereDate("created_at", ">", $Mounthly)->get();
        // $consultant_Quarterly_data = Cipprogress::where("team", "consultant")->whereDate("created_at", ">", $Quarterly)->get();
        // $consultant_count_final_stage = Cipprogress::where("team", "consultant")->where("final_stage", 1)->get();
        // $consultant_count_mid_stage = Cipprogress::where("team", "consultant")->where("mid_stage", 1)->get();
        // //Agend
        // $Agend_weekly_data = Cipprogress::where("team", "Agend")->whereDate("created_at", ">", $weekly)->get();
        // $Agend_Mounthly_data = Cipprogress::where("team", "Agend")->whereDate("created_at", ">", $Mounthly)->get();
        // $Agend_Quarterly_data = Cipprogress::where("team", "Agend")->whereDate("created_at", ">", $Quarterly)->get();
        // $Agend_count_final_stage = Cipprogress::where("team", "Agend")->where("final_stage", 1)->get();
        // $Agend_count_mid_stage = Cipprogress::where("team", "Agend")->where("mid_stage", 1)->get();
        $data = [

            "Admin_team" => $Admin_team,
            "chart" => $chart,
            "count_user_pie" => $count_user_pie,
            "append" => $append,
        ];
        return view('home', $data);
    }
}
