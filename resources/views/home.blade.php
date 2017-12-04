@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="monthChooseArea">
        <div class="backButton">
            <p class="backText">前月</p>
        </div>
        <div class="nowMonth">
            <h1 class="nowMonthText">2017/12</h1>
        </div>
        <div class="nextButton">
            <p class="nextText">次月</p>
        </div>
    </div>

       <div class="calendar-table">
           <div class="calendar-header">
               <div class="weekday-header-area">
                   <p class="weekday-header">Mon</p>
               </div>
               <div class="weekday-header-area">
                   <p class="weekday-header">Tue</p>
               </div>
               <div class="weekday-header-area">
                   <p class="weekday-header">Wed</p>
               </div>
               <div class="weekday-header-area">
                   <p class="weekday-header">Thu</p>
               </div>
               <div class="weekday-header-area">
                   <p class="weekday-header">Fri</p>
               </div>
               <div class="weekday-header-area">
                   <p class="weekday-header">Sat</p>
               </div>
               <div class="weekend-header-area">
                   <p class="weekend-header">Sun</p>
               </div>
           </div>
           <div class="calendar-table">
                @for ($i = 0; $i < 6; $i++)
                <div class="calendar-row">
                    @for ($j = 0; $j < 7; $j++)
                        <?php $day = $date[($i * 7) + $j];
                        ?>
                        @if (($i == 0 and $day > 8) or ($i >= 4 and $day < 8))
                        <div class="calendar-day-nothing"></div>
                        @elseif ($month_first_day -> year == $dt -> year and $month_first_day -> month == $dt -> month and $dt -> day == $day)
                        <div class="calendar-day calendar-day-today">
                            <p class="day today">{{$date[($i * 7) + $j]}}</p>
                        </div>
                        @else
                        <div class="calendar-day" id="{{ $month_first_day -> year . $month_first_day->month . $day }}">
                            <p class="day">{{$date[($i * 7) + $j]}}</p>
                        </div>
                        @endif
                    @endfor
                </div>
                @endfor
           </div>
       </div>
    </div>
</div>
@endsection
