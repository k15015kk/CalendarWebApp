@extends ('layouts.app')

@section ('content')
    <div class="container">
        <div class="formTitileArea">
            <h1 class="addPageTitle">Add Schedule</h1>
        </div>

        @if ($flag)
        <div class="alert alert-danger">
            <p class="alertMessage">入力不足です．</p>
        </div>
        @endif

        <div class="scheduleFormArea">
            <form action="/home/addSchedule" method="post">
                <div class="addContentArea">
                    <p class="formTitle planTitle">Plan</p>
                    <input type="text" name="plan" class="form-control"></div>
                </div>

                <div class="addContentArea">
                    <p class="formTitle startTitle">Start</p>
                    <input type="datetime-local" name="start" value="{{$year}}-{{str_pad($month, 2, 0, STR_PAD_LEFT)}}-{{str_pad($day, 2, 0, STR_PAD_LEFT)}}T00:00" class="form-control">
                </div>

                <div class="addContentArea">
                    <p class="formTitle endTitle">End</p>
                    <input type="datetime-local" name="end" value="{{$year}}-{{str_pad($month, 2, 0, STR_PAD_LEFT)}}-{{str_pad($day, 2, 0, STR_PAD_LEFT)}}T00:00"class="form-control">
                </div>

                <div class="addSubmit">
                    <input type="submit" value="Add " class="btn btn-primary">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                </div>
            </form>
        </div>
    </div>
@endsection