@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    

    <div class="row">
       <div class="col-md-9 calendar-table">
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
                        <div class="calendar-day">
                            <p class="day">{{$date[($i * 7) + $j]}}</p>
                        </div>
                    @endfor
                </div>
                @endfor
           </div>
       </div>

       <div class="col-md-3 calendar-pickday">
       </div>
    </div>
</div>
@endsection
