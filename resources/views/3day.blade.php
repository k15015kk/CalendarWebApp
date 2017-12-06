@extends ('layouts.app')

@section ('content')
<div class="container">
            <div class="chooseArea">
                <div class="backButton">
                    <a href="/home/3days/{{$backDay -> year}}/{{str_pad($backDay -> month, 2, 0, STR_PAD_LEFT)}}/{{str_pad($backDay -> day, 2, 0, STR_PAD_LEFT)}}" class="backText">Back</a>
                </div>
                <div class="nowMonth">
                    <h1 class="nowMonthText">{{$date -> year}}/{{$date -> month}}</h1>
                </div>
                <div class="nextButton">
                    <a href="/home/3days/{{$nextDay -> year}}/{{str_pad($nextDay -> month, 2, 0, STR_PAD_LEFT)}}/{{str_pad($nextDay -> day, 2, 0, STR_PAD_LEFT)}}" class="nextText">Next</a>
                </div>
            </div>

            <div class="threeDaysDisplay">
                <div class="threeDaysdisplayContent">
                    <div class="threeDaysDate" id="{{str_pad($displayDateList[0] -> year ,4, 0, STR_PAD_LEFT) . str_pad($displayDateList[0] -> month, 2, 0, STR_PAD_LEFT) . str_pad($displayDateList[0] -> day, 2, 0, STR_PAD_LEFT)}}">
                        <p class="dateText">{{$displayDateList[0] -> day}}</p>
                        <p class="dateText">{{$displayWeekList[0]}}</p>
                    </div>
                    
                    <div class="planArea">
                        @foreach ($database[0] as $data)
                        <div class="threeDaysPlanStick" id="{{$data -> id}}">
                            <p class="planTime">
                                {{date('y/m/d H:i',strtotime ($data -> startTime))}} ~ {{date('y/m/d H:i',strtotime ($data -> endTime))}}
                            </p>
                            <p class="planContent" id="{{$data->id}}">{{$data -> plan}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="threeDaysdisplayContent">
                    <div class="threeDaysDate" id="{{str_pad($displayDateList[1] -> year ,4, 0, STR_PAD_LEFT) . str_pad($displayDateList[1] -> month, 2, 0, STR_PAD_LEFT) . str_pad($displayDateList[1] -> day, 2, 0, STR_PAD_LEFT)}}">
                        <p class="dateText">{{$displayDateList[1] -> day}}</p>
                        <p class="dateText">{{$displayWeekList[1]}}</p>
                    </div>
                
                    <div class="planArea">
                        @foreach ($database[1] as $data)
                        <div class="threeDaysPlanStick" id="{{$data->id}}">
                            <p class="planTime" id="{{$data -> id}}">
                                {{date('y/m/d H:i',strtotime ($data -> startTime))}} ~ {{date('y/m/d H:i',strtotime ($data -> endTime))}}
                            </p>
                            <p class="planContent" id="{{$data->id}}">{{$data -> plan}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="threeDaysdisplayContent">
                    <div class="threeDaysDate" id="{{str_pad($displayDateList[2] -> year ,4, 0, STR_PAD_LEFT) . str_pad($displayDateList[2] -> month, 2, 0, STR_PAD_LEFT) . str_pad($displayDateList[2] -> day, 2, 0, STR_PAD_LEFT)}}">
                        <p class="dateText">{{$displayDateList[2] -> day}}</p>
                        <p class="dateText">{{$displayWeekList[2]}}</p>
                    </div>
                
                    <div class="planArea">
                        @foreach ($database[2] as $data)
                        <div class="threeDaysPlanStick" id="{{$data->id}}">
                            <p class="planTime" >
                                {{date('y/m/d H:i',strtotime ($data -> startTime))}} ~ {{date('y/m/d H:i',strtotime ($data -> endTime))}}
                            </p>
                            <p class="planContent">{{$data -> plan}}</p>
                        </div
                        @endforeach
                    </div>
                </div>
                
            </div>

            <div class="addButtonArea">
                <button class="addButton" onclick="location.href = '/home/add'"><p>+</p></button>
            </div>
</div>
@endsection