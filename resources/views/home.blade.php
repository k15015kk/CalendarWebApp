@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
