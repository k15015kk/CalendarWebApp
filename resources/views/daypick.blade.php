@extends('layouts.app')

@section('content')
<div class="container">
    <div class="chooseArea">
        <div class="backButton">
            <a href="/home/day/{{$yesterday -> year}}/{{str_pad($yesterday -> month, 2, 0, STR_PAD_LEFT)}}/{{str_pad($yesterday -> day, 2, 0, STR_PAD_LEFT)}} " class="backText">Back</a>
        </div>
        <div class="nowDay">
            <h1 class="nowDayText"> {{$date->year}}/{{str_pad($date->month,2,0,STR_PAD_LEFT)}}/{{str_pad($date->day,2,0,STR_PAD_LEFT)}}/({{$weekdisplay}})</h1>
        </div>
        <div class="nextButton">
            <a href="/home/day/{{$tomorrow -> year}}/{{str_pad($tomorrow -> month, 2, 0, STR_PAD_LEFT)}}/{{str_pad($tomorrow -> day, 2, 0, STR_PAD_LEFT)}} " class="nextText">Next</a>
        </div>
    </div>

    <div class="scheduleDisplayArea">
        <div class="scheduleTime">
            @for ($i = 0; $i < 24; $i++)
                <p class="time">{{$i}}:00</p>
            @endfor

        </div>
        <div class="scheduleList">
            @foreach ($schedule_data as $data) 
                <div class="scheduleSTD" id="{{$data['id']}}" style="margin-top: {{$data['startPixel']}}px; height: {{$data['displayPixel']}}px;">
                    <p class="planTime" id="{{$data['id']}}Time">
                        {{$data['start'] -> format('y/m/d G:i').' ~ '.$data['end'] -> format('y/m/d G:i')}}
                    </p>
                    <p class="planText" id="{{$data['id']}}Text">
                        {{$data['plan']}}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="addButtonArea">
                <button class="addButton" onclick="location.href = '/home/add'"><p>+</p></button>
    </div>
</div>
@endsection