@extends('layouts.app')

@section('content')
<div class="container">
    <div class="dateDisplayArea">
        <h1 class="date"> {{$date->year}}/{{str_pad($date->month,2,0,STR_PAD_LEFT)}}/{{str_pad($date->day,2,0,STR_PAD_LEFT)}}/({{$weekdisplay}})</h1>
    </div>

    <div class="scheduleDisplayArea">
        <div class="scheduleTime">
            @for ($i = 0; $i < 24; $i++)
                <p class="time">{{$i}}:00</p>
            @endfor

        </div>
        <div class="scheduleList">
            @foreach ($schedule_data as $data) 
                <div class="scheduleSTD" id="{{$data['id']}}">
                    <p class="planText" id="{{$data['id']}}Text">
                        {{$data['plan']}}
                    </p>

                    <script type="text/javascript">
                        displaySetting({{$data['id']}},{{$data['startPixel']}},{{$data['displayPixel']}});
                    </script>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection