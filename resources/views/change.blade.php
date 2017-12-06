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
            <form action="changeSchedule" method="post">
                <div class="addContentArea">
                    <p class="formTitle planTitle">Plan</p>
                    <input type="text" name="plan" value="{{$plan}}" class="form-control">
                </div>

                <div class="addContentArea">
                    <p class="formTitle startTitle">Start</p>
                    <input type="datetime-local" name="start" value="{{$start}}" class="form-control">
                </div>

                <div class="addContentArea">
                    <p class="formTitle endTitle">End</p>
                    <input type="datetime-local" name="end" value="{{$end}}"  class="form-control">
                </div>

                <div class="addSubmit">
                    <input type="submit" value="Change" class="btn btn-primary">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" value="{{$id}}">

                </div>
            </form>
        </div>
    </div>
@endsection