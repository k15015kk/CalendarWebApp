<?php

namespace Calendar\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 現在の日付
        $dt = new Carbon();

        // 月始まりの日
        $month_first_day = new Carbon($dt->year . '-' . $dt->month . '-01');

        // 月始まりの曜日
        $month_first_dayofweek = (int)($month_first_day -> dayOfWeek - 1);

        if($month_first_dayofweek == -1) {
            $month_first_dayofweek = 6;
        }

        // １日週の月曜日を求める
        $calendar_day = $month_first_day -> subDay($month_first_dayofweek);

        // 日付格納
        $date = [];

        for($i = 0; $i < 42; $i++) {
            $date[$i] = $calendar_day -> day;
            $calendar_day -> addDay();
        }

        // 表示月を格納
        $dm = $dt -> month;

        return view('home',compact('date','dm'));
    }
}
