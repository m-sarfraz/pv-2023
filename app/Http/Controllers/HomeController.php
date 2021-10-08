<?php

namespace App\Http\Controllers;

use App\CandidateInformation;
use Illuminate\Http\Request;
use App\Charts\SampleChart;
use App\User;
use Illuminate\Support\Facades\DB;
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
        $Cip_getdata = Cipprogress::orderBy('id', 'ASC')->get();
        return view('home', compact("Cip_getdata", "chart", "count_user_pie"));
    }
}
