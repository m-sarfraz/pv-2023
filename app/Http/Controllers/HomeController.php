<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SampleChart;
use Illuminate\Support\Facades\DB;
Use App\User;
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
        $chart->dataset('New User Register Chart', 'line', $users)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0',
            
        ]);
        $count_user_pie=new SampleChart();
        $count_user_pie->labels(['First', 'Second', 'Third']);
        $count_user_pie->dataset('my chart', 'pie', [3,3,3])->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0',
            'background'=>"#51C1C0",
            
        ]);;
        return view('home',compact("chart","count_user_pie"));
    }
  
}
