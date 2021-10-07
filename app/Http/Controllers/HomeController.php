<?php

namespace App\Http\Controllers;

use App\CandidateInformation;
use Illuminate\Http\Request;
use App\Charts\SampleChart;
use Illuminate\Support\Facades\DB;
use App\User;
use Google\Service\AndroidEnterprise\Resource\Users;
use Auth;
use App\Cipprogress;
use App\Endorsement;
use Spatie\Permission\Models\Role;

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
        //Admin 
        $Admin_weekly_data = Cipprogress::where("team", "Admin")->whereDate("created_at", ">", $weekly)->get();
        $Admin_Mounthly_data = Cipprogress::where("team", "Admin")->whereDate("created_at", ">", $Mounthly)->get();
        $Admin_Quarterly_data = Cipprogress::where("team", "Admin")->whereDate("created_at", ">", $Quarterly)->get();
        $Admin_count_final_stage = Cipprogress::where("team", "Admin")->where("final_stage", 1)->get();
        $Admin_count_mid_stage = Cipprogress::where("team", "Admin")->where("mid_stage", 1)->get();
        //consultant
        $consultant_weekly_data = Cipprogress::where("team", "consultant")->whereDate("created_at", ">", $weekly)->get();
        $consultant_Mounthly_data = Cipprogress::where("team", "consultant")->whereDate("created_at", ">", $Mounthly)->get();
        $consultant_Quarterly_data = Cipprogress::where("team", "consultant")->whereDate("created_at", ">", $Quarterly)->get();
        $consultant_count_final_stage = Cipprogress::where("team", "consultant")->where("final_stage", 1)->get();
        $consultant_count_mid_stage = Cipprogress::where("team", "consultant")->where("mid_stage", 1)->get();
       //Agend
       $Agend_weekly_data = Cipprogress::where("team", "Agend")->whereDate("created_at", ">", $weekly)->get();
       $Agend_Mounthly_data = Cipprogress::where("team", "Agend")->whereDate("created_at", ">", $Mounthly)->get();
       $Agend_Quarterly_data = Cipprogress::where("team", "Agend")->whereDate("created_at", ">", $Quarterly)->get();
       $Agend_count_final_stage = Cipprogress::where("team", "Agend")->where("final_stage", 1)->get();
       $Agend_count_mid_stage = Cipprogress::where("team", "Agend")->where("mid_stage", 1)->get();
        $data = [
            "Admin_count_final_stage" => $Admin_count_final_stage,
            "Admin_count_mid_stage" => $Admin_count_mid_stage,
            "Admin_weekly_data" => $Admin_weekly_data,
            "Admin_Mounthly_data" => $Admin_Mounthly_data,
            "Admin_Quarterly_data" => $Admin_Quarterly_data,
            "Admin_team" => $Admin_team,
            "chart" => $chart,
            "count_user_pie" => $count_user_pie,
            "consultant_weekly_data" => $consultant_weekly_data,
            "consultant_Mounthly_data" => $consultant_Mounthly_data,
            "consultant_Quarterly_data" => $consultant_Quarterly_data,
            "consultant_count_final_stage" => $consultant_count_final_stage,
            "consultant_count_mid_stage" => $consultant_count_mid_stage,
            "Agend_weekly_data" => $Agend_weekly_data,
            "Agend_Mounthly_data" => $Agend_Mounthly_data,
            "Agend_Quarterly_data" => $Agend_Quarterly_data,
            "Agend_count_final_stage" => $Agend_count_final_stage,
            "Agend_count_mid_stage" => $Agend_count_mid_stage,
        ];
        return view('home', $data);
    }
}
