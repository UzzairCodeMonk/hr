@extends('backend.master')
@section('page-title')
Dashboard
@endsection
@section('page-css')
<style>
    .aside {
        display: none !important;
    }

    .aside~.header,
    .aside~.main-content,
    .aside~.site-footer {
        margin-left: 0 !important;
    }

    .equal {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
    }

    .equal>[class*='col-'] {
        display: flex;
        flex-direction: column;
    }

</style>
@endsection
@section('content')

<div class="col-md-8 mx-auto">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col">
            <div class="">
                <h1 class="display-5">Hi {!!auth()->user()->personalDetail->name ?? '' !!}!</h1>
                <p class="display-6">Here's what's happening in Datakraf Solution Sdn. Bhd.</p>
            </div>

        </div>
        <div class="col">
            <img src="{{asset('images/dashboard-image.png')}}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row">
        @include('components.admin.panel',[
        'title' => ' 19 Total Employees ',
        'img' => asset('images/dashboard/employees.svg'),
        'link' => '#',
        'linkText' => 'View',
        'linkClass' => 'btn-primary'
        ])
        @include('components.admin.panel',[
        'title' => $leaveCount. ' new leave requests',
        'img' => asset('images/dashboard/requests.svg'),
        'link' => url('#'),
        'linkText' => 'View',
        'linkClass' => 'btn-primary'
        ])
        @include('components.admin.panel',[
        'title' => $payslipGenerated.' payslips generated',
        'img' => asset('images/dashboard/wage.svg'),
        'link' => url('#'),
        'linkText' => 'View',
        'linkClass' => 'btn-primary'
        ])
        <div class="col-md-3 col-lg-3 col-sm-6 col-xs-12">
            <div class="card p-30 pt-50 text-center" style="background-image:url({{asset('images/settings-bg.svg')}});background-size:cover">
                <div>
                    <img src="{{asset('images/settings.svg')}}" alt="" class="mb-5" height="150px">
                </div>
                <h5 class="">Configure this system</h5>
                <p class="text-light fs-12 mb-30"></p>
                <a href="" class="btn btn-round btn-xs btn-primary">Manage</a>
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
                            <option value="7">In 7 Days</option>
                            <option value="30">In 30 Days</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    @widget('absenteesWidget')
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Upcoming Events</h3>
                </div>
                <div class="card-body">
                    <table class="table table-card datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Hello</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
