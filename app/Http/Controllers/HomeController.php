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
        return redirect('/home/month');
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
        $date_calendar = [];

        for($i = 0; $i < 42; $i++) {
            $date[$i] = $calendar_day -> day;
            $date_calendar[$i] = $calendar_day -> copy();
            $calendar_day -> addDay();
        }

        $dbname = "k15015kk";
        $dbname .= "Schedule";

        $date_count = [];
        for ($i = 0; $i < 42; $i++) {
            $date_count[$i] =(int)DB::table($dbname)->select('id')
            ->whereBetween('startTime',[$date_calendar[$i]->year.'-'.$date_calendar[$i]->month.'-'.$date_calendar[$i]->day.' 00:00:00',$date_calendar[$i]->year.'-'.$date_calendar[$i]->month.'-'.$date_calendar[$i]->day.' 23:59:00'])
            ->orWhereBetween('endTime',[$date_calendar[$i] -> year .'-'.$date_calendar[$i] -> month.'-'.$date_calendar[$i] -> day.' 00:00:00',$date_calendar[$i] -> month.'-'.$date_calendar[$i] -> day.' 23:59:00'])
            ->count();
        }

        // 月始まりの日
        $month_first_day = new Carbon($year . '-' . $month . '-01');

        $back_month_dt = new Carbon($month_first_day -> subMonth());
        $next_month_dt = new Carbon($month_first_day -> addMonth(2));

        $month_first_day -> subMonth();
        return view('month',compact('date','todayDate','month_first_day','back_month_dt','next_month_dt','date_count'));
    }

    public function day(Request $request) {
       
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

        $week = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

        $date = new Carbon($year.'-'.$month.'-'.$day);

        $dbname = "k15015kk";
        $dbname .= "Schedule";

        $database = DB::table($dbname)->select('id','plan','startTime',"endTime")
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

            $dataid = $data -> id;

            $schedule_data[$count] = array('id' => $dataid , 'plan' => $data->plan ,'start' => $start , 'end' => $end,'startPixel' => $startpixel,'displayPixel' => $displaypixel);

            $count = $count + 1;
        }

        $weekdisplay = $week[$date->dayOfWeek];

        $yesterday = $date -> copy() -> subDay();
        $tomorrow = $date-> copy() -> addDay();

        return view('daypick',compact('date','weekdisplay','schedule_data','yesterday','tomorrow'));
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

        $start_date = $date -> copy() -> subDay($date_weekly);

        $dbname = "k15015kk";
        $dbname .= "Schedule";

        $database = [];
        $loop_date = $start_date -> copy();

        for ($i = 0; $i < 7; $i++) {
            $database[$i] = DB::table($dbname)->select('plan','startTime','endTime','id')
            ->whereBetween('startTime',[$loop_date->year.'-'.$loop_date->month.'-'.$loop_date->day.' 00:00:00',$loop_date->year.'-'.$loop_date->month.'-'.$loop_date->day.' 23:59:00'])
            ->orWhereBetween('endTime',[$loop_date -> year .'-'.$loop_date -> month.'-'.$loop_date -> day.' 00:00:00',$loop_date -> month.'-'.$loop_date -> day.' 23:59:00'])
            ->get();
            $loop_date = $loop_date -> addDay();
        }
        
        $displayDateList = [];
        $loop_date = $start_date -> copy();
        
        for ($i = 0; $i < 7; $i++) {
            $displayDateList[$i] = $loop_date -> copy();
            $loop_date = $loop_date -> addDay();
        }

        $backDay = $start_date -> copy() -> subDay(7);
        $nextDay = $start_date -> copy() -> addDay(7);

        return view('week',compact('displayDateList','data','database','start_date','backDay','nextDay'));
    }

    public function add() {
        $flag = false;
        $todayDate = Carbon::now();
        $year = $todayDate -> year;
        $month = $todayDate -> month;
        $day = $todayDate -> day;
        return view('add',compact('flag','year','month','day'));
    }

    public function addSchedule(Request $request) {
        $plan = $request -> input('plan');
        $start = $request -> input('start');
        $end = $request -> input('end');

        $flag = false;

        if($plan and $start and $end) {

            $dbname = "k15015kk";
            $dbname .= "Schedule";
            DB::table($dbname) -> insert([
                'plan' => $plan,
                'startTime' => $start,
                'endTime' => $end
            ]);

            $startDate = new Carbon($start);
            $redirect_directory = str_pad($startDate -> year ,4, 0, STR_PAD_LEFT) . '/' . str_pad($startDate -> month, 2, 0, STR_PAD_LEFT) . '/' . str_pad($startDate -> day, 2, 0, STR_PAD_LEFT);

            return redirect('/home/day/'.$redirect_directory);

        } else {
            $flag = true;
            $date = Carbon::now();

            $year = $date -> year;
            $month = $date -> month;
            $day = $date -> day;
            return view('add',compact('flag','year','month','day'));
        } 
    }

    public function changeSchedule(Request $request) {
        $plan = $request -> input('plan');
        $start = $request -> input('start');
        $end = $request -> input('end');

        $flag = false;

        if($plan and $start and $end) {

            $dbname = "k15015kk";
            $dbname .= "Schedule";
            DB::table($dbname) 
            -> where('id','=',$request -> id)
            -> update([
                'plan' => $plan,
                'startTime' => $start,
                'endTime' => $end
            ]);

            $startDate = new Carbon($start);
            $redirect_directory = str_pad($startDate -> year ,4, 0, STR_PAD_LEFT) . '/' . str_pad($startDate -> month, 2, 0, STR_PAD_LEFT) . '/' . str_pad($startDate -> day, 2, 0, STR_PAD_LEFT);

            return redirect('/home/day/'.$redirect_directory);

        } else {
            $flag = true;
            $date = Carbon::now();

            $year = $date -> year;
            $month = $date -> month;
            $day = $date -> day;
            return view('change',compact('flag','year','month','day'));
        } 
    }

    public function change(Request $request) {

        $flag = false;
        $id = $request -> id;

        $dbname = "k15015kk";
        $dbname .= "Schedule";

        $database = DB::table($dbname) -> select('plan','startTime','endTime')
        -> where('id','=',$id)
        -> get();

        $plan = $database[0] -> plan;

        $start = new Carbon($database[0] -> startTime);
        $end = new Carbon ($database[0] -> endTime);

        $start = $start -> format('Y-m-d'.'\T'.'G:i');
        $end = $end -> format('Y-m-d'.'\T'.'G:i');

        return view('change',compact('flag','plan','start','end','id'));
    }

    public function delete(Request $request) {
        $flag = false;
        $id = $request -> id;

        $dbname = "k15015kk";
        $dbname .= "Schedule";

        $database = DB::table($dbname) -> select('plan','startTime','endTime')
        -> where('id','=',$id)
        -> get();

        DB::table($dbname) -> where('id','=',$id) -> delete();

        $start = new Carbon($database[0] -> startTime);
        $redirect_directory = str_pad($start -> year ,4, 0, STR_PAD_LEFT) .'/'. str_pad($start -> month, 2, 0, STR_PAD_LEFT) . '/' . str_pad($start -> day, 2, 0, STR_PAD_LEFT);

        return redirect('/home/day/'.$redirect_directory);
    }

    public function threedays(Request $request) {
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

        $dbname = "k15015kk";
        $dbname .= "Schedule";

        $database = [];
        $loop_date = $date -> copy();

        for ($i = 0; $i < 3; $i++) {
            $database[$i] = DB::table($dbname)->select('plan','startTime','endTime','id')
            ->whereBetween('startTime',[$loop_date->year.'-'.$loop_date->month.'-'.$loop_date->day.' 00:00:00',$loop_date->year.'-'.$loop_date->month.'-'.$loop_date->day.' 23:59:00'])
            ->orWhereBetween('endTime',[$loop_date -> year .'-'.$loop_date -> month.'-'.$loop_date -> day.' 00:00:00',$loop_date -> month.'-'.$loop_date -> day.' 23:59:00'])
            ->get();
            
            $loop_date = $loop_date -> addDay();
        }
        
        $displayDateList = [];
        $displayWeekList = [];
        $loop_date = $date -> copy();
        $week = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
        
        for ($i = 0; $i < 3; $i++) {
            $displayDateList[$i] = $loop_date -> copy();

            $displayWeekList[$i] = $week[$loop_date -> dayOfWeek];
            $loop_date = $loop_date -> addDay();
        }

        $backDay = $date -> copy() -> subDay(3);
        $nextDay = $date -> copy() -> addDay(3);

        return view('3day',compact('displayDateList','displayWeekList','data','database','date','backDay','nextDay'));
    }
}
