<?php

namespace Calendar\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 現在の日付
        $dt = Carbon::now();

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

        // 月始まりの日
        $month_first_day = new Carbon($dt->year . '-' . $dt->month . '-01');

        $back_month_dt = new Carbon($month_first_day -> subMonth());
        $next_month_dt = new Carbon($month_first_day -> addMonth(2));

        $month_first_day -> subMonth();
        return view('month',compact('date','dt','month_first_day','back_month_dt','next_month_dt'));
    }

    public function month(Request $request) {

        $todayDate = Carbon::now();

        if ($request -> year and $request -> month) {
            $year = $request -> year;
            $month = $request -> month;
        } else {
            $year = $todayDate -> year;
            $month = $todayDate -> month;
        }

       // 月始まりの日
        $month_first_day = new Carbon($year . '-' . $month . '-01');
        
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

        // 月始まりの日
        $month_first_day = new Carbon($year . '-' . $month . '-01');

        $back_month_dt = new Carbon($month_first_day -> subMonth());
        $next_month_dt = new Carbon($month_first_day -> addMonth(2));

        $month_first_day -> subMonth();
        return view('month',compact('date','todayDate','month_first_day','back_month_dt','next_month_dt'));
    }

    public function day(Request $request) {
       
        $todayDate = Carbon::now();

        if ($request -> date) {
            $year = substr($request->date,0,4);
            $month = substr($request->date,4,2);
            $day = substr($request->date,6,2);
        } else {
            $year = $todayDate -> year;
            $month = $todayDate -> month;
            $day = $todayDate -> day; 
        }

        $week = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

        $date = new Carbon($year.'-'.$month.'-'.$day);

        $dbname = "k15015kk";
        $dbname .= "Schedule";

        $database = DB::table($dbname)->select('plan','startTime',"endTime")
        ->whereBetween('startTime',[$year.'-'.$month.'-'.$day.' 00:00:00',$year.'-'.$month.'-'.$day.' 23:59:00'])
        ->orWhereBetween('endTime',[$year.'-'.$month.'-'.$day.' 00:00:00',$year.'-'.$month.'-'.$day.' 23:59:00'])
        ->get();

        $schedule_data = [];
        $count = 0;

        $startpixel = 0;
        $displaypixel = 0;
        foreach ($database as $data) {
            $start = new Carbon($data -> startTime);
            $end = new Carbon($data -> endTime);

            if($start -> day == $date -> day and $end -> day == $date -> day) {
                $startpixel = $date -> diffInSeconds($start) / 60;
                $displaypixel = $start -> diffInSeconds($end) / 60;
            } else if ($start -> day != $date -> day and $end -> day == $date -> day) {

                $startpixel = 0;
                $displaypixel = $date -> diffInSeconds($end) / 60;
                
            } else if ($start -> day == $date -> day and $end -> day != $date -> day) {
                $startpixel = $date -> diffInSeconds($start) / 60;
                $displaypixel = 1440 - $startpixel;
            } else {
                $startpixel = 0;
                $displaypixel = 1440;
            }

            $schedule_data[$count] = array('id' => $count,'plan' => $data->plan ,'start' => $start , 'end' => $end,'startPixel' => $startpixel,'displayPixel' => $displaypixel);

            $count = $count + 1;
        }

        $weekdisplay = $week[$date->dayOfWeek];

        return view('daypick',compact('date','weekdisplay','schedule_data'));
    }

    public function week (Request $request) {

        $todayDate = Carbon::now();

        if ($request -> year and $request -> month and $request -> day) {
            $year = $request -> year;
            $month = $request -> month;
            $day = $request -> day;
        } else {
            $year = $todayDate -> year;
            $month = $todayDate -> month;
            $day = $todayDate -> day; 
        }

        $date = new Carbon($year.'-'.$month.'-'.$day);

        $date_weekly = (int)($date -> dayOfWeek - 1);

        if($date_weekly == -1) {
            $date_weekly = 6;
        }

        $date -> subDay($date_weekly);

        $seven_days_after_date = $date -> copy() -> addDay(6);

        $dbname = "k15015kk";
        $dbname .= "Schedule";

        $database = DB::table($dbname)->select('plan','startTime',"endTime")
        ->whereBetween('startTime',[$date->year.'-'.$date->month.'-'.$date->day.' 00:00:00',$date->year.'-'.$date->month.'-'.$date->day.' 23:59:00'])
        ->orWhereBetween('endTime',[$seven_days_after_date -> year .'-'.$seven_days_after_date -> month.'-'.$seven_days_after_date -> day.' 00:00:00',$seven_days_after_date -> month.'-'.$seven_days_after_date -> day.' 23:59:00'])
        ->get();
        
        return view('week');
    }
}
