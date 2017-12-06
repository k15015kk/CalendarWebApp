@extends ('layouts.app')

@section ('content')

    <div class="container">
            <div class="chooseArea">
                <div class="backButton">
                    <a href="/home/week/{{$backDay -> year}}/{{str_pad($backDay -> month, 2, 0, STR_PAD_LEFT)}}/{{str_pad($backDay -> day, 2, 0, STR_PAD_LEFT)}}" class="backText">Back</a>
                </div>
                <div class="nowMonth">
                    <h1 class="nowMonthText">{{$start_date -> year}}/{{$start_date -> month}}</h1>
                </div>
                <div class="nextButton">
                    <a href="/home/week/{{$nextDay -> year}}/{{str_pad($nextDay -> month, 2, 0, STR_PAD_LEFT)}}/{{str_pad($nextDay -> day, 2, 0, STR_PAD_LEFT)}}" class="nextText">Next</a>
                </div>
            </div>

        <div class="weekDisplay">
            <div class="weeklyDateArea">
                <div class="weekDate monday" id="{{str_pad($displayDateList[0] -> year ,4, 0, STR_PAD_LEFT) . str_pad($displayDateList[0] -> month, 2, 0, STR_PAD_LEFT) . str_pad($displayDateList[0] -> day, 2, 0, STR_PAD_LEFT)}}">
                    <p class="date">{{$displayDateList[0] -> day}}</p>
                    <p>Mon</p>
                </div>
                <div class="weekDate tuesday" id="{{str_pad($displayDateList[1] -> year ,4, 0, STR_PAD_LEFT) . str_pad($displayDateList[1] -> month, 2, 0, STR_PAD_LEFT) . str_pad($displayDateList[1] -> day, 2, 0, STR_PAD_LEFT)}}">
                    <p class="date">{{$displayDateList[1] -> day}}</p>
                    <p>Tue</p>
                </div>
                <div class="weekDate wednesday" id="{{str_pad($displayDateList[2] -> year ,4, 0, STR_PAD_LEFT) . str_pad($displayDateList[2] -> month, 2, 0, STR_PAD_LEFT) . str_pad($displayDateList[2] -> day, 2, 0, STR_PAD_LEFT)}}">
                    <p class="date">{{$displayDateList[2] -> day}}</p>
                    <p>Wed</p>
                </div>
                <div class="weekDate thursday" id="{{str_pad($displayDateList[3] -> year ,4, 0, STR_PAD_LEFT) . str_pad($displayDateList[3] -> month, 2, 0, STR_PAD_LEFT) . str_pad($displayDateList[3] -> day, 2, 0, STR_PAD_LEFT)}}">
                    <p class="date">{{$displayDateList[3] -> day}}</p>
                    <p>Thu</p>
                </div>
                <div class="weekDate friday" id="{{str_pad($displayDateList[4] -> year ,4, 0, STR_PAD_LEFT) . str_pad($displayDateList[4] -> month, 2, 0, STR_PAD_LEFT) . str_pad($displayDateList[4] -> day, 2, 0, STR_PAD_LEFT)}}">
                    <p class="date">{{$displayDateList[4] -> day}}</p>
                    <p>Fri</p>
                </div>
                <div class="weekDate saturday" id="{{str_pad($displayDateList[5] -> year ,4, 0, STR_PAD_LEFT) . str_pad($displayDateList[5] -> month, 2, 0, STR_PAD_LEFT) . str_pad($displayDateList[5] -> day, 2, 0, STR_PAD_LEFT)}}">
                    <p class="date">{{$displayDateList[5] -> day}}</p>
                    <p>Sat</p>
                </div>
                <div class="weekDate sunday" id="{{str_pad($displayDateList[6] -> year ,4, 0, STR_PAD_LEFT) . str_pad($displayDateList[6] -> month, 2, 0, STR_PAD_LEFT) . str_pad($displayDateList[6] -> day, 2, 0, STR_PAD_LEFT)}}">
                    <p class="date">{{$displayDateList[6] -> day}}</p>
                    <p>Sun</p>
                </div>
            </div>

            <div class="weeklyPlansArea">
                <div class="weekPlan mondayPlan">
                    @foreach ($database[0] as $data)
                        <p class="weekPlanStick" id="{{$data->id}}">{{$data -> plan}}</p>
                    @endforeach
                </div>

                <div class="weekPlan tuesdayPlan">
                    @foreach ($database[1] as $data)
                        <p class="weekPlanStick" id="{{$data->id}}">{{$data -> plan}}</p>
                    @endforeach
                </div>

                <div class="weekPlan wednesdayPlan">
                     @foreach ($database[2] as $data)
                        <p class="weekPlanStick" id="{{$data->id}}">{{$data -> plan}}</p>
                    @endforeach
                </div>

                <div class="weekPlan thursdayPlan">
                    @foreach ($database[3] as $data)
                        <p class="weekPlanStick" id="{{$data->id}}">{{$data -> plan}}</p>
                    @endforeach
                </div>

                <div class="weekPlan fridayPlan">
                    @foreach ($database[4] as $data)
                        <p class="weekPlanStick" id="{{$data->id}}">{{$data -> plan}}</p>
                    @endforeach
                </div>

                <div class="weekPlan saturdayPlan">
                    @foreach ($database[5] as $data)
                        <p class="weekPlanStick" id="{{$data->id}}">{{$data -> plan}}</p>
                    @endforeach
                </div>

                <div class="weekPlan sundayPlan">
                    @foreach ($database[6] as $data)
                        <p class="weekPlanStick" id="{{$data->id}}">{{$data -> plan}}</p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="addButtonArea">
            <button class="addButton" onclick="location.href = '/home/add'">
                <p>+</p>
            </button>
        </div>
    </div>

@endsection