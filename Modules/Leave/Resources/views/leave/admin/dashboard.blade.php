@extends('backend.master')
@section('page-title')
Dashboard
@endsection
@section('page-css')
<link rel="stylesheet" href="{{asset('css/no-admin-sidebar.css')}}">
{!! Charts::assets() !!}
@endsection
@section('content')

<div class="col-md-8 mx-auto">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col">
            <div class="">
                <h1 class="display-5">Leave Modules</h1>
                <p class="display-6">Here's the summary of employees leaves.</p>
            </div>
        </div>
        <div class="col mx-auto">
            <img src="{{asset('images/dashboard/requests.svg')}}" alt="" class="" height="400px">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Leave Applications By Month</h3>
                </div>
                <div class="card-body">
                    <div id="monthly">
                        {!! $monthly->render() !!}
                    </div>

                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Who's not in the office?</h3>
                    <div class="card-options">
                        <select name="" id="daysSelector" class="form-control">
                            <option value="7">This week</option>
                            <option value="30">This month</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    @widget('absenteesWidget')
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@section('page-js')

@endsection
