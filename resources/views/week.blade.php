@extends ('layouts.app')

@section ('content')

    <div class="container">
            <div class="monthChooseArea">
                <div class="backButton">
                    <a href="#" class="backText">back</a>
                </div>
                <div class="nowMonth">
                    <h1 class="nowMonthText">Text</h1>
                </div>
                <div class="nextButton">
                    <a href="#" class="nextText">Next</a>
                </div>
            </div>

        <div class="weekDisplay">
            <div class="weeklyDateArea">
                <div class="weekDate monday">
                    <p class="date">01</p>
                    <p>Mon</p>
                </div>
                <div class="weekDate tuesday">
                    <p class="date">02</p>
                    <p>Tue</p>
                </div>
                <div class="weekDate wednesday">
                    <p class="date">03</p>
                    <p>Wed</p>
                </div>
                <div class="weekDate thursday">
                    <p class="date">04</p>
                    <p>Thu</p>
                </div>
                <div class="weekDate friday">
                    <p class="date">05</p>
                    <p>Fri</p>
                </div>
                <div class="weekDate saturday">
                    <p class="date">06</p>
                    <p>Sat</p>
                </div>
                <div class="weekDate sunday">
                    <p class="date">07</p>
                    <p>Sun</p>
                </div>
            </div>

            <div class="weeklyPlansArea">
                <div class="weekPlan mondayPlan">
                    <p class="weekPlanStick">テスト</p>
                    <p class="weekPlanStick">テスト</p>
                    <p class="weekPlanStick">テスト</p>
                </div>

                <div class="weekPlan tuesdayPlan">
                    <p class="weekPlanStick">テスト</p>
                    <p class="weekPlanStick">テスト</p>
                </div>

                <div class="weekPlan wednesdayPlan">
                    <p class="weekPlanStick">テスト</p>
                    <p class="weekPlanStick">テスト</p>
                </div>

                <div class="weekPlan thursdayPlan">
                    <p class="weekPlanStick">テスト</p>
                    <p class="weekPlanStick">テスト</p>
                    <p class="weekPlanStick">テスト</p>
                    <p class="weekPlanStick">テスト</p>
                </div>

                <div class="weekPlan fridayPlan">
                    <p class="weekPlanStick">テスト</p>
                    <p class="weekPlanStick">テスト</p>
                </div>

                <div class="weekPlan saturdayPlan">
                    <p class="weekPlanStick">テスト</p>
                </div>

                <div class="weekPlan sundayPlan">
                    <p class="weekPlanStick">テスト</p>
                    <p class="weekPlanStick">テスト</p>
                    <p class="weekPlanStick">テスト</p>
                </div>
            </div>
        </div>

    </div>

@endsection